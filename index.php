<?php 
require_once 'includes/db_connect.php';
include 'includes/header.php'; 

$conn = getDBConnection();

$sql = "SELECT r.recipe_id, r.recipe_name, r.recipe_name_pt2, r.description, r.category, r.difficulty, r.cook_time,
        ri.file_path AS hero_image
        FROM idm232_recipes_cleaned r
        LEFT JOIN recipe_images ri 
        ON r.recipe_id = ri.recipe_id AND ri.type = 'hero'
        ORDER BY r.recipe_id DESC
        LIMIT 6";

$result = $conn->query($sql);
?>

<section class="intro">
    <h1>From Our Kitchen to Yours</h1>
    <p>What started as a small recipe journal has grown into a library of home-cooked favorites. 
       Each recipe is tested, loved, and shared to make your time in the kitchen easier and more rewarding.</p>
    <p>Scroll through our latest creations, search by ingredients, or explore hidden gems you might not have tried yet.</p>
</section>

<main class="home-layout">

    <!-- LEFT COLUMN -->
    <section class="main-content">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($recipe = $result->fetch_assoc()): ?>
                <article class="recipe-card">
                    <a href="recipe.php?id=<?php echo $recipe['recipe_id']; ?>">
                        <img src="<?php echo htmlspecialchars($recipe['hero_image'] ?? 'assets/images/placeholder.png'); ?>" 
                             alt="<?php echo htmlspecialchars($recipe['recipe_name']); ?>">
                        <h2><?= htmlspecialchars($recipe['recipe_name']) ?></h2>
                        <h3><?= htmlspecialchars($recipe['recipe_name_pt2']) ?></h3>
                        <p class="preview-text"><?= htmlspecialchars($recipe['description']) ?></p>
                        <h4><a href="recipe.php?id=<?= $recipe['recipe_id'] ?>">Read More</a></h4>
                    </a>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No recipes found.</p>
        <?php endif; ?>
    </section>

    <!-- RIGHT COLUMN -->
    <aside class="sidebar">
        <div class="search-container">
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Search recipes..." required />
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="social-icons">
            <a href="#"><img src="assets/images/instagram.png" alt="Instagram"></a>
            <a href="#"><img src="assets/images/facebook.png" alt="Facebook"></a>
            <a href="#"><img src="assets/images/twitter.png" alt="Twitter"></a>
        </div>
    </aside>
</main>

<?php 
include 'includes/footer.php';
$conn->close(); 
?>