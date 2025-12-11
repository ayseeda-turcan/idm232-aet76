<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg" sizes="32x32" href="../assets/images/idm232_monkey_login.svg">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/idm232_monkey_login.svg">

    <title>ChimpChow</title>
    <script defer src="assets/script.js"></script>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$is_logged_in = isset($_SESSION['user_id']);
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
?>

<header class="site-header">
    <div class="navbar">
        <div class="logo">
            <a href="index.php"><img src="assets/images/monkey_logo.svg" alt="Logo Of ChimpChow"></a>
        </div>

        <div class="menu-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

        <div class="nav-links">
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="all-recipes.php">Recipes</a></li>
                    <li><a href="surprise.php">Surprise Me</a></li>
                    <li><a href="help.php">Help</a></li>
                </ul>
            </nav>
        </div>

        <div class="monkey-login">
            <?php if ($is_logged_in): ?>
                <button class="login-button">
                    <a href="logout.php">Log Out<img src="assets/images/idm232_monkey_login.svg" alt="Logout"></a>
                </button>
            <?php else: ?>
                <button class="login-button">
                    <a href="login.php">Log In<img src="assets/images/idm232_monkey_login.svg" alt="Login"></a>
                </button>
            <?php endif; ?>
        </div>
    </div>
</header>

