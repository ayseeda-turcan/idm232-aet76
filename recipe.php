<?php 
require_once 'includes/db_connect.php';
include 'includes/header.php'; 

$conn = getDBConnection();

$recipe_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($recipe_id <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM idm232_recipes_cleaned WHERE recipe_id = ?");
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: index.php');
    exit;
}

$recipe = $result->fetch_assoc();
$stmt->close();

$img_stmt = $conn->prepare("SELECT type, file_path, step_number FROM recipe_images WHERE recipe_id = ? ORDER BY step_number ASC");
$img_stmt->bind_param("i", $recipe_id);
$img_stmt->execute();
$img_result = $img_stmt->get_result();

$images = [
    'hero' => '',
    'tools' => [],
    'ingredients' => '',
    'steps' => []
];

while ($row = $img_result->fetch_assoc()) {
    switch ($row['type']) {
        case 'hero':
            $images['hero'] = $row['file_path'];
            break;
        case 'tool':
            $images['tools'][] = $row['file_path'];
            break;
        case 'ingredients':
            $images['ingredients'] = $row['file_path'];
            break;
        case 'step':
            $images['steps'][] = $row['file_path'];
            break;
    }
}
$img_stmt->close();

$steps_raw = $recipe['steps'];
preg_match_all('/STEP\s+\d+\..*?(?=STEP\s+\d+\.|$)/s', $steps_raw, $matches);
$steps_text = $matches[0];

$tools_list = array_filter(array_map('trim', explode("\n", $recipe['kitchen_tools'])));
$ingredients_list = array_filter(array_map('trim', explode("\n", $recipe['ingredients'])));

?>

<main class="single-recipe">
    <h2><?php echo htmlspecialchars($recipe['recipe_name']); ?></h2>
    <h3><?php echo htmlspecialchars($recipe['recipe_name_pt2']); ?></h3>
    <p><?php echo htmlspecialchars($recipe['description']); ?></p>

    <!-- HERO IMAGE -->
    <?php if ($images['hero']): ?>
        <img src="<?php echo htmlspecialchars($images['hero']); ?>" 
            alt="<?php echo htmlspecialchars($recipe['recipe_name']); ?>" 
            class="recipe-hero">
    <?php endif; ?>

    <!-- TOOLS -->
    <?php if (!empty($tools_list) || !empty($images['tools'])): ?>
        <section>
            <h5>Useful Tools</h5>
            <?php if (!empty($images['tools'])): ?>
                <div class="tools-gallery">
                    <?php foreach ($images['tools'] as $tool_img): ?>
                        <img src="<?php echo htmlspecialchars($tool_img); ?>" alt="Tool image">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($tools_list)): ?>
                <ul>
                    <?php foreach ($tools_list as $tool): ?>
                        <li><?php echo htmlspecialchars($tool); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <!-- INGREDIENTS -->
    <?php if (!empty($ingredients_list) || $images['ingredients']): ?>
        <section class="ingredients-section">
            <h5>Ingredients</h5>
            <?php if ($images['ingredients']): ?>
                <img src="<?php echo htmlspecialchars($images['ingredients']); ?>" alt="Ingredients">
            <?php endif; ?>
            <?php if (!empty($ingredients_list)): ?>
                <ul>
                    <?php foreach ($ingredients_list as $ingredient): ?>
                        <li><?php echo htmlspecialchars($ingredient); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <!-- INSTRUCTION -->
    <?php if (!empty($steps_text) || !empty($images['steps'])): ?>
        <section class="instructions-section">
            <h5>Instructions</h5>
            <ol>
                <?php foreach ($steps_text as $idx => $step_text): ?>
                    <li class="step-item <?php echo !isset($images['steps'][$idx]) ? 'no-image' : ''; ?>">
                        <div class="step-text">
                            <?php echo nl2br(htmlspecialchars(trim($step_text))); ?>
                        </div>
                        <?php if (isset($images['steps'][$idx])): ?>
                            <img class="step-image" 
                                src="<?php echo htmlspecialchars($images['steps'][$idx]); ?>" 
                                alt="Step <?php echo $idx + 1; ?> image">
                        <?php endif; ?>
                    </li>
                    <hr>
                <?php endforeach; ?>
            </ol>
        </section>
    <?php endif; ?>

</main>

<?php 
include 'includes/footer.php';
$conn->close(); 
?>