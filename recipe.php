<?php include 'includes/header.php'; ?>
<?php include 'includes/mock-data.php'; ?>

<?php
$id = $_GET['id'] ?? 1; 
$current = null;

foreach ($recipes as $recipe) {
    if ($recipe['id'] == $id) {
    $current = $recipe;
        break;
    }
}
?>

<main class="single-recipe">
    <?php if ($current): ?>

        <h2><?php echo htmlspecialchars($current['title']); ?></h2>
        <h3><?php echo htmlspecialchars($current['title2']); ?></h3>
        <h4><?php echo htmlspecialchars($current['description']); ?></h4>


        <img 
            src="assets/images/<?php echo htmlspecialchars($current['image']); ?>" 
            alt="<?php echo htmlspecialchars($current['title']); ?>" 
            class="recipe-image" />

        <section>
            <h5>Useful Tools</h5>
            <ul>
                <?php 
                if (is_array($current['tools'])) {
                    foreach ($current['tools'] as $tool) {
                        echo '<li>' . htmlspecialchars($tool) . '</li>';
                    }
                } else {
                    echo '<li>' . htmlspecialchars($current['tools']) . '</li>';
                }
                ?>
            </ul>
        </section>

        <section>
            <h5>Ingredients</h5>
            <ul>
                <?php 
                if (is_array($current['ingredients'])) {
                    foreach ($current['ingredients'] as $ingredient) {
                        echo '<li>' . htmlspecialchars($ingredient) . '</li>';
                    }
                } else {
                    echo '<li>' . htmlspecialchars($current['ingredients']) . '</li>';
                }
                ?>
            </ul>
        </section>

        <section>
            <h5>Instructions</h5>
            <ul>
                <?php 
                if (is_array($current['instructions'])) {
                    foreach ($current['instructions'] as $step) {
                        echo '<li>' . htmlspecialchars($step) . '</li>';
                    }
                } else {
                    echo '<li>' . htmlspecialchars($current['instructions']) . '</li>';
                }
                ?>
            </ul>
        </section>

    <?php else: ?>
        <p>Recipe not found.</p>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>

