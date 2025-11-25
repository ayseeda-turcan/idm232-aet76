<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

require_once 'includes/db_connect.php';
include 'includes/header.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        $error = 'Please fill in all fields.';
    } else {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT user_id, email, password, first_name FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                // LOGIN SUCCESSFUL
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['first_name'];
                
                header('Location: index.php');
                exit;
            } else {
                $error = 'Invalid email or password.';
            }
        } else {
            $error = 'Invalid email or password.';
        }
        
        $stmt->close();
        $conn->close();
    }
}
?>

<main class="help">
    <h1>Log In to ChimpChow</h1>
    
    <?php if ($error): ?>
        <p style="color: #d76500; text-align: center; padding: 1rem; background-color: #fef3e8; border-radius: 10px;">
            <?php echo htmlspecialchars($error); ?>
        </p>
    <?php endif; ?>
    
    <form action="login.php" method="POST" style="max-width: 400px; margin: 2rem auto;">
        <input type="email" name="email" placeholder="Email" required 
            style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; border-radius: 20px; border: 1px solid #ccc; font-size: 1rem;">
        
        <input type="password" name="password" placeholder="Password" required 
            style="width: 100%; padding: 0.8rem; margin-bottom: 1.5rem; border-radius: 20px; border: 1px solid #ccc; font-size: 1rem;">
        
        <button type="submit" style="width: 100%; background-color: var(--button-color); color: var(--background-color); border: none; border-radius: 20px; padding: 0.8rem; font-size: 1rem; cursor: pointer; font-weight: 500;">
            Log In
        </button>
    </form>
    
    <p style="text-align: center; margin-top: 1.5rem; font-size: 1rem;">
        Don't have an account? <a href="register.php" style="color: #d76500; text-decoration: none; font-weight: 500;">Sign up here</a>
    </p>
</main>

<?php include 'includes/footer.php'; ?>