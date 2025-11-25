<?php
require_once 'includes/db_connect.php';

$conn = getDBConnection();

$sql = "SELECT recipe_id FROM idm232_recipes_cleaned ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $recipe = $result->fetch_assoc();
    header("Location: recipe.php?id=" . $recipe['recipe_id']);
    exit;
} else {
    header("Location: index.php");
    exit;
}

$conn->close();
?>

