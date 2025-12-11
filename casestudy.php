<?php 
include 'includes/header.php'; 
?>
<main class="casestudy">
    <h1>ChimpChow - Case Study</h1>
    <img src="assets/images/monkey_logo.svg" alt="ChimpChow Logo">

    <h2>Overview</h2>

    <p>This project is a recipe discovery website. 
        The goal was to create an intuitive, visually appealing platform where users can browse, 
        filter, and explore recipes. The site includes a custom PHP + MySQL 
        backend, recipe filtering, image handling, and detailed recipe pages.</p>

    <h2>Context and Challenge</h2>
        <h3>Background</h3>

            <p>This project was completed as part of a web development course assignment where the objective 
                was to design and build a database-driven website.</p>

        <h3>The Problem</h3>

            <p>Food websites often feel overwhelming, cluttered, or rely on intrusive ads. Many recipe 
                databases make simple tasks like filtering by category or cook time unnecessarily 
                complicated. My goal was to create a modern alternative where users could quickly 
                discover recipes that match their various needs.</p>

        <h3>Goals & Objectives</h3>

            <ul>
                <li>Build a PHP-based recipe website using a MySQL database.</li>
                <li>Allow users to filter recipes by search, category, difficulty, and cook time.</li>
                <li>Create an organized way to store multiple image types (hero, gallery, step images).</li>
                <li>Design pages that are simple, responsive, and visually consistent.</li>
                <li>Ensure the system is easy to manage and update.</li>
            </ul>

        <h3>My Role</h3>

            <p>I was responsible for the UX design, UI design, frontend implementation (HTML/CSS), 
                backend development (PHP), database design, image processing, and deployment to my university’s hosting server.</p>


    <h2>Process and Insight</h2>

        <ol>
            <li><h3>Audience</h3></li>

            <p>The target user is someone cooking at home who wants simple navigation and quick filtering:</p>
            <ul>
                <li>Students cooking on a budget</li>
                <li>Busy users with limited time</li>
                <li>People browsing for inspiration</li>
            </ul>

            <p>Insights:</p>
            <ul>
                <li>Users don’t want to read long recipe intros, they want structure and clarity.</li>
                <li>Strong visuals are essential; users judge recipes by their images first.</li>
                <li>Filters need to be visible and simple to update or change.</li>
            </ul>

            <li><h3>Information Architecture</h3></li>

            <p>I mapped the main content structure:</p>
            <ul>
                <li>Homepage</li>
                <li>All Recipes Page</li>
                <li>Search Results Page</li>
                <li>Individual Recipe Page</li>
                <li>Surprise Me Page</li>
                <li>Log In and Register Pages</li>

            </ul>

            <p>Database tables included:</p>
            <ul>
                <li>idm232_recipes_cleaned – main recipe data</li>
                <li>recipe_images – hero and gallery images</li>
            </ul>

            <li><h3>Wireframes</h3></li>
            <p>Rough wireframes were created to organize:</p>
            <ul>
                <li>Recipe card layout</li>
                <li>Homepage design</li>
                <li>Individual ecipe detail structure</li>
                </ul>
            <p>These guided the HTML layout before styling.</p>

            <li><h3>Visual Design</h3></li>

            <p>I designed a clean, accessible visual system:</p>
            <ul>
                <li>Soft neutral color palette</li>
                <li>Large food imagery</li>
                <li>Rounded recipe cards</li>
                <li>Simple typography with clear hierarchy</li>
                <li>Consistent spacing system</li>
                <li>Responsive grid for mobile + desktop</li>
            </ul>

            <li><h3>Development</h3></li>
            <h4>Frontend (HTML/CSS)</h4>
            <ul>
                <li>Built components: recipe cards, filter bar, grid layout.</li>
                <li>Ensured responsive behavior using CSS grid and flexbox.</li>
                <li>Styled the recipe gallery and metadata badges.</li>
            </ul>

            <h4>Backend (PHP)</h4>
            <ul>
                <li>Structured code with include files.</li>
                <li>Built filtering logic using SQL prepared statements.</li>
                <li>Created random recipe logic.</li>
                <li>Created user log in and register methods.</li>
            </ul>

            <h4>Database</h4>
            <p>Designed for scalability:</p>
            <ul>
                <li>One-to-many relationship for recipes → images</li>
                <li>Image type definitions (hero, gallery, step)</li>
                <li>Cleaned and validated data to avoid broken links</li>
            </ul>

            <h4>Image Handling</h4>
            <ul>
                <li>Dynamically loaded hero images on cards</li>
                <li>Gallery images pull automatically on the recipe page</li>
            </ul>
        </ol>

    <h2>The Solution</h2>
        <p>The finished recipe website is a clean platform built from scratch.</p>

        <h3>Key Features</h3>
            <ul>
                <li>Dynamic Filtering: Users can filter by category, difficulty, cook time, and search.</li>
                <li>Random Recipe Generator: “Surprise Me” takes users to a random recipe.</li>
                <li>Fully Responsive Layout: Works on desktop and mobile.</li>
                <li>Hero Image System: Each recipe displays a hero image and a gallery.</li>
                <li>Structured Recipe Page: Ingredients, steps, and instructions are easy to read.</li>
            </ul>
            
            <!-- Recipe grid
            Filter bar
            Recipe page (hero + gallery)
            Surprise Me output -->

    <h2>The Results</h2>
        <p>This project shows the full process of creating a working web product.</p>

        <h3>Success Metrics</h3>
            <ul>
                <li>Fully functional PHP website hosted on Drexel’s servers</li>
                <li>Clean database design that can scale</li>
                <li>Fast filtering & search</li>
                <li>Clear information hierarchy</li>
            </ul>

        <h3>Lessons Learned</h3>
            <ul>
                <li>Hosting environments often differ from local machines, file paths must be relative.</li>
                <li>Image handling requires thoughtful database architecture.</li>
                <li>Simple UX decisions (like visible filters) greatly improve navigation.</li>
                <li>Testing real data early prevents broken layouts later in the process.</li>
            </ul>

        <h3>Future Improvements</h3>
            <ul>
                <li>Add recipe submissions</li>
                <li>Add favoriting</li>
                <li>Implement pagination for larger recipe collections</li>
                <li>Add accessibility improvements</li>
            </ul>
</main>

<?php 
include 'includes/footer.php';
?>
