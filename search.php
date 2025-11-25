<?php 
require_once 'includes/db_connect.php';
include 'includes/header.php'; 

$conn = getDBConnection();

// GET FILTERS
$search = isset($_GET['query']) ? trim($_GET['query']) : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$difficulty = isset($_GET['difficulty']) ? $_GET['difficulty'] : '';
$max_cook_time = isset($_GET['cook_time']) ? intval($_GET['cook_time']) : 0;

// BASE SQL
$sql = "SELECT r.recipe_id, r.recipe_name, r.recipe_name_pt2, r.description, r.category, r.difficulty, r.cook_time, 
        i.file_path AS hero_image
        FROM idm232_recipes_cleaned r
        LEFT JOIN recipe_images i ON i.recipe_id = r.recipe_id AND i.type = 'hero'
        WHERE 1=1";

$params = [];
$types = "";

// SEARCH FILTER
if (!empty($search)) {
    $sql .= " AND (r.recipe_name LIKE ? OR r.recipe_name_pt2 LIKE ? OR r.description LIKE ?)";
    $searchParam = "%$search%";
    $params[] = $searchParam;
    $params[] = $searchParam;
    $params[] = $searchParam;
    $types .= "sss";
}

// CATEGORY FILTER
if (!empty($category)) {
    $sql .= " AND r.category = ?";
    $params[] = $category;
    $types .= "s";
}

// DIFFICULTY FILTER
if (!empty($difficulty)) {
    $sql .= " AND r.difficulty = ?";
    $params[] = $difficulty;
    $types .= "s";
}

// COOK TIME FILTER
if ($max_cook_time > 0) {
    $sql .= " AND r.cook_time <= ?";
    $params[] = $max_cook_time;
    $types .= "i";
}

$sql .= " ORDER BY r.recipe_id DESC";

// PREPARE AND EXECUTE
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// GET ALL CATEGORY OPTIONS
$categoriesQuery = "SELECT DISTINCT category FROM idm232_recipes_cleaned WHERE category IS NOT NULL AND category != '' ORDER BY category";
$categories = $conn->query($categoriesQuery);
?>

<main style="flex: 1;">
<section class="search-results-page">
    <section class="intro">
        <h1>Our Recipes</h1>
        <p>Look through our digital recipe book to find inspiration for your next culinary wonder!</p>
    </section>

    <div class="search-header">
        <div class="search-container-inline">
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Search recipes..." value="<?php echo htmlspecialchars($search); ?>"/>
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="filter-container">
            <form action="search.php" method="GET">
                <?php if (!empty($search)): ?>
                    <input type="hidden" name="query" value="<?php echo htmlspecialchars($search); ?>">
                <?php endif; ?>

                <select name="category" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <?php while($cat = $categories->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($cat['category']); ?>" <?php echo ($category === $cat['category']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['category']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <select name="difficulty" onchange="this.form.submit()">
                    <option value="">All Difficulties</option>
                    <option value="easy" <?php echo ($difficulty === 'easy') ? 'selected' : ''; ?>>Easy</option>
                    <option value="medium" <?php echo ($difficulty === 'medium') ? 'selected' : ''; ?>>Medium</option>
                    <option value="hard" <?php echo ($difficulty === 'hard') ? 'selected' : ''; ?>>Hard</option>
                </select>

                <select name="cook_time" onchange="this.form.submit()">
                    <option value="">Any Cook Time</option>
                    <option value="15" <?php echo ($max_cook_time === 15) ? 'selected' : ''; ?>>Under 15 min</option>
                    <option value="30" <?php echo ($max_cook_time === 30) ? 'selected' : ''; ?>>Under 30 min</option>
                    <option value="45" <?php echo ($max_cook_time === 45) ? 'selected' : ''; ?>>Under 45 min</option>
                    <option value="60" <?php echo ($max_cook_time === 60) ? 'selected' : ''; ?>>Under 1 hour</option>
                </select>

                <button><a href="search.php<?php echo !empty($search) ? '?query=' . urlencode($search) : ''; ?>">Clear Filters</a></button>
            </form>
        </div>
    </div>

    <?php if ($result && $result->num_rows > 0): ?>
        <p class="results-count"><?php echo $result->num_rows; ?> recipe(s) found</p>
        
        <div class="recipe-grid">
            <?php while($recipe = $result->fetch_assoc()): ?>
                <article class="recipe-card">
                    <a href="recipe.php?id=<?php echo $recipe['recipe_id']; ?>">
                        <img src="<?php echo htmlspecialchars($recipe['hero_image']); ?>" alt="<?php echo htmlspecialchars($recipe['recipe_name']); ?>">
                        <div class="recipe-card-content">
                            <h2><?php echo htmlspecialchars($recipe['recipe_name']); ?></h2>
                            <?php if (!empty($recipe['recipe_name_pt2'])): ?>
                                <h3><?php echo htmlspecialchars($recipe['recipe_name_pt2']); ?></h3>
                            <?php endif; ?>
                            <p class="recipe-excerpt"><?php echo htmlspecialchars(substr($recipe['description'], 0, 100)) . '...'; ?></p>
                        </div>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="logo">
            <img src="assets/images/monkey_went_wrong.svg" alt="No results found">
        </div>
    <?php endif; ?>
</section>
</main>

<?php 
include 'includes/footer.php';
$stmt->close();
$conn->close(); 
?>
