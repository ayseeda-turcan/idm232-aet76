<?php include 'includes/header.php'; ?>
<?php include 'includes/mock-data.php'; ?>

<main class="home-layout">

<!-- LEFT COLUMN -->
    <section class="main-content">
        <?php foreach ($recipes as $recipe): ?>
        <article class="recipe-preview">
            <a href="recipe.php?id=<?php echo $recipe['id']; ?>">
                <img src="assets/images/<?php echo $recipe['image']; ?>" alt="<?php echo $recipe['title']; ?>">
                <h2><?php echo $recipe['title']; ?></h2>
            </a>
            <p class="preview-text">
            <?php echo substr($recipe['instructions'], 0, 100); ?>...
            </p>
        </article>
        <?php endforeach; ?>
    </section>


<!-- RIGHT COLUMN -->
    <aside class="sidebar">
        <div class="search-container">
            <form action="search.php" method="get">
                <input type="text" name="q" placeholder="Search recipes..." />
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

<?php include 'includes/footer.php'; ?>
