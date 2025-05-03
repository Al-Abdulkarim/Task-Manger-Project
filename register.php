<?php
require_once 'includes/functions.php';
redirectIfLoggedIn();

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $confirm_password = trim($_POST["confirm_password"] ?? "");
    
    // Basic validation
    if (empty($username) || strlen($username) < 3) {
        $error_message = "Username must be at least 3 characters.";
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address.";
    } elseif (empty($password) || strlen($password) < 6) {
        $error_message = "Password must be at least 6 characters.";
    } elseif ($password != $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        if (registerUser($username, $email, $password)) {
            $success_message = "Registration successful! You can now <a href='login.php'>login</a>.";
            $username = $email = $password = $confirm_password = "";
        } else {
            $error_message = "Registration failed. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Task Manager</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Task Manager</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="container">
        <div class="form-container">
            <h2>Register</h2>
            
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            
            <div id="error-message" class="alert alert-danger" style="display: none;"></div>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateRegistrationForm()">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo htmlspecialchars($username ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($email ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                </div>
                
                <div class="form-group">
                    <input type="submit" class="btn" value="Register">
                </div>
                
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Task Manager</p>
        </div>
    </footer>
    
    <script src="assets/js/script.js"></script>
</body>
</html>