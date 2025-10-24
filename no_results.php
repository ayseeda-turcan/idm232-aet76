<?php include 'includes/header.php'; ?>
<?php include 'includes/mock-data.php'; ?>

<main style="flex: 1;">
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

    <div class="logo">
        <img src="assets/images/monkey_went_wrong.svg" alt="Logo Of ChimpChow">
    </div>
</section>
</main>
<?php include 'includes/footer.php'; ?>
