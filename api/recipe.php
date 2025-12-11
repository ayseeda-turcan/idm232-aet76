<?php
require_once "../includes/db_connect.php";

header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid or missing recipe ID"]);
    exit;
}

$recipe_id = intval($_GET['id']);
$conn = getDBConnection();

$sql = "SELECT * FROM idm232_recipes_cleaned WHERE recipe_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$recipeResult = $stmt->get_result();

if ($recipeResult->num_rows === 0) {
    http_response_code(404);
    echo json_encode(["error" => "Recipe not found"]);
    exit;
}

$recipe = $recipeResult->fetch_assoc();

$sql2 = "SELECT file_path, type FROM recipe_images WHERE recipe_id = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $recipe_id);
$stmt2->execute();
$imagesResult = $stmt2->get_result();

$images = [];
while ($row = $imagesResult->fetch_assoc()) {
    $images[] = $row;
}

echo json_encode([
    "data" => [
        "recipe" => $recipe,
        "images" => $images
    ]
]);

$conn->close();
?>
