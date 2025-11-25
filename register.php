<?php
session_start();

// If already logged in, redirect to home
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

require_once 'includes/db_connect.php';
include 'includes/header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    
    // VALIDATION
    if (empty($email) || empty($password) || empty($confirm_password) || empty($first_name)) {
        $error = 'Please fill in all required fields.';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        $conn = getDBConnection();
        
        // CHECK EMAIL IF IT EXISTS
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error = 'An account with this email already exists.';
        } else {
            // HASH PASSWORD AND INPUTS
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (email, password, first_name, last_name) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $email, $hashed_password, $first_name, $last_name);
            
            if ($stmt->execute()) {
                $success = 'Registration successful! You can now log in.';
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
        
        $stmt->close();
        $conn->close();
    }
}
?>

<main class="help">
    <h1>Create Your ChimpChow Account</h1>
    
    <?php if ($error): ?>
        <p style="color: #d76500; text-align: center; padding: 1rem; background-color: #fef3e8; border-radius: 10px;">
            <?php echo htmlspecialchars($error); ?>
        </p>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <p style="color: #606C38; text-align: center; padding: 1rem; background-color: #e8f3e8; border-radius: 10px;">
            <?php echo htmlspecialchars($success); ?>
        </p>
    <?php endif; ?>
    
    <form action="register.php" method="POST" style="max-width: 400px; margin: 2rem auto;">
        <input type="text" name="first_name" placeholder="First Name *" required 
            style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; border-radius: 20px; border: 1px solid #ccc; font-size: 1rem;">
        
        <input type="text" name="last_name" placeholder="Last Name (Optional)" 
            style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; border-radius: 20px; border: 1px solid #ccc; font-size: 1rem;">
        
        <input type="email" name="email" placeholder="Email *" required 
            style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; border-radius: 20px; border: 1px solid #ccc; font-size: 1rem;">
        
        <input type="password" name="password" placeholder="Password (min 6 characters) *" required 
            style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; border-radius: 20px; border: 1px solid #ccc; font-size: 1rem;">
        
        <input type="password" name="confirm_password" placeholder="Confirm Password *" required 
            style="width: 100%; padding: 0.8rem; margin-bottom: 1.5rem; border-radius: 20px; border: 1px solid #ccc; font-size: 1rem;">
        
        <button type="submit" style="width: 100%; background-color: var(--button-color); color: var(--background-color); border: none; border-radius: 20px; padding: 0.8rem; font-size: 1rem; cursor: pointer; font-weight: 500;">
            Sign Up
        </button>
    </form>
    
    <p style="text-align: center; margin-top: 1.5rem; font-size: 1rem;">
        Already have an account? <a href="login.php" style="color: #d76500; text-decoration: none; font-weight: 500;">Log in here</a>
    </p>
</main>

<?php include 'includes/footer.php'; ?>