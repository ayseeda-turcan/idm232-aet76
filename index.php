<?php include 'includes/header.php'; ?>
<?php include 'includes/mock-data.php'; ?>

<main class="recipe-grid">
    <?php foreach ($recipes as $recipe): ?>
        <div class="recipe-card">
            <a href="recipe.php?id=<?php echo $recipe['id']; ?>">
                <img src="assets/images/<?php echo $recipe['image']; ?>" alt="<?php echo $recipe['title']; ?>">
                <h2><?php echo $recipe['title']; ?></h2>
            </a>
        </div>
    <?php endforeach; ?>
</main>

<?php include 'includes/footer.php'; ?>
