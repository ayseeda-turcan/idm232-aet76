<?php include 'includes/header.php'; ?>
<?php include 'includes/mock-data.php'; ?>

<?php
$id = $_GET['id'] ?? 1; // Default to first recipe if no ID is given
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
    <h2><?php echo $current['title']; ?></h2>
    <img 
        src="assets/images/<?php echo $recipe['image']; ?>" 
        alt="<?php echo $recipe['title']; ?>" 
        class="recipe-image"
    />

    <?php
        $imagePath = 'assets/images/' . $current['image']; // adapt to your variables
        echo "<p>Image URL: $imagePath</p>";
        echo "<p>File exists? " . (file_exists($imagePath) ? 'YES' : 'NO') . "</p>";
    ?>
    
    <section>
        <h3>Ingredients</h3>
        <p><?php echo $current['ingredients']; ?></p>
    </section>

    <section>
        <h3>Instructions</h3>
        <p><?php echo $current['instructions']; ?></p>
    </section>
    
    <?php else: ?>
    <p>Recipe not found.</p>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
