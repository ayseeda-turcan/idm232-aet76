<?php include 'includes/header.php'; ?>
<?php include 'includes/mock-data.php'; ?>

<section class="intro">
        <h1>From Our Kitchen to Yours</h1>
        <p>What started as a small recipe journal has grown into a library of home-cooked favorites. 
        Each recipe is tested, loved, and shared to make your time in the kitchen easier and more rewarding.
        </p></br>
        <p>Scroll through our latest creations, search by ingredients, or explore hidden gems you might not have tried yet.</p>
</section>

<main class="home-layout">
<!-- LEFT COLUMN -->
    <section class="main-content">
        <?php foreach ($recipes as $recipe): ?>
        <article class="recipe-card">
            <a href="recipe.php?id=<?php echo $recipe['id']; ?>">
                <img src="assets/images/<?php echo $recipe['image']; ?>" alt="<?php echo $recipe['title']; ?>">
                <h2><?= htmlspecialchars($recipe['title']) ?></h2>
            </a>
            
            <h3><?= htmlspecialchars($recipe['title2']) ?></h3>

            <p class="preview-text">
                <?= htmlspecialchars($recipe['description']) ?>
            </p>
            <h4><a href="recipe.php?id=<?= $recipe['id'] ?>">Read More</a><h4>

        </article>
        <?php endforeach; ?>

    </section>


<!-- RIGHT COLUMN -->
    <aside class="sidebar">
        <div class="search-container">
            <form action="no_results.php">
                <input type="text" name="q" placeholder="Search recipes..." />
                <a href="results.php"><button type="submit">Search</button></a>
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
