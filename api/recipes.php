<?php
require_once "../includes/db_connect.php";

header('Content-Type: application/json');

$conn = getDBConnection();

$sql = "SELECT r.recipe_id, r.recipe_name, r.recipe_name_pt2, r.description,
               r.category, r.difficulty, r.cook_time,
               i.file_path AS hero_image
        FROM idm232_recipes_cleaned r
        LEFT JOIN recipe_images i 
            ON r.recipe_id = i.recipe_id AND i.type = 'hero'
        ORDER BY r.recipe_id ASC";

$result = $conn->query($sql);

$recipes = [];

while ($row = $result->fetch_assoc()) {
    $recipes[] = $row;
}

echo json_encode([
    "count" => count($recipes),
    "recipes" => $recipes
]);

$conn->close();
?>
