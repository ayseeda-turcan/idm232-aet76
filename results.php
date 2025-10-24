<?php include 'includes/header.php'; ?>
<?php include 'includes/mock-data.php'; ?>

<section class="search-results-page">
    <div class="search-header">
        <h1>Search Results</h1>
        <p class="search-query">Showing results for: <strong>"chicken"</strong></p>
        
        <div class="search-container-inline">
            <form action="results.php">
                <input type="text" name="q" placeholder="Search recipes..." value="chicken" />
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <p class="results-count"><?php echo count($recipes); ?> recipes found</p>
    
    <div class="recipe-grid">
        <?php foreach ($recipes as $recipe): ?>
            <article class="recipe-card">
                
                <a href="recipe.php?id=<?php echo htmlspecialchars($recipe['id']); ?>">
                    <img src="assets/images/<?php echo htmlspecialchars($recipe['image']); ?>" 
                        alt="<?php echo htmlspecialchars($recipe['title']); ?>">

                    <div class="recipe-card-content">
                        <h2><?php echo htmlspecialchars($recipe['title']); ?></h2>
                        <p class="recipe-excerpt">
                            <?php
                            $instructions = is_array($recipe['description']) 
                                ? implode(' ', $recipe['description']) 
                                : $recipe['description'];
                            echo htmlspecialchars(substr($instructions, 0, 100)) . '...';
                            ?>
                        </p>
                    </div>
                </a>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
