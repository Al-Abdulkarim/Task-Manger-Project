<?php
require_once 'includes/functions.php';
redirectIfNotLoggedIn();

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $due_date = trim($_POST["due_date"] ?? "");
    
    if (empty($title)) {
        $error_message = "Task title is required.";
    } elseif (empty($due_date)) {
        $error_message = "Due date is required.";
    } else {
        if (addTask($_SESSION["id"], $title, $description, $due_date)) {
            header("location: dashboard.php?success=add");
            exit;
        } else {
            $error_message = "Failed to add task. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task - Task Manager</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Task Manager</h1>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="add_task.php">Add Task</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="container">
        <div class="form-container">
            <h2>Add New Task</h2>
            
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            
            <div id="error-message" class="alert alert-danger" style="display: none;"></div>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateTaskForm()">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($title ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4"><?php echo htmlspecialchars($description ?? ''); ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Due Date</label>
                    <input type="date" name="due_date" id="due_date" class="form-control" value="<?php echo htmlspecialchars($due_date ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Add Task">
                    <a href="dashboard.php" class="btn">Cancel</a>
                </div>
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