<?php
require_once 'includes/functions.php';
redirectIfLoggedIn();

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");
    
    if (empty($username) || empty($password)) {
        $error_message = "Please enter both username and password.";
    } else {
        if (loginUser($username, $password)) {
            header("location: dashboard.php");
            exit;
        } else {
            $error_message = "Invalid username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Task Manager</title>
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
            <h2>Login</h2>
            
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            
            <div id="error-message" class="alert alert-danger" style="display: none;"></div>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateLoginForm()">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo htmlspecialchars($username ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                
                <div class="form-group">
                    <input type="submit" class="btn" value="Login">
                </div>
                
                <p>Don't have an account? <a href="register.php">Register here</a>.</p>
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