<?php
require_once 'includes/functions.php';
redirectIfNotLoggedIn();
$tasks = getUserTasks($_SESSION["id"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Task Manager</title>
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
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
        
        <?php if (isset($_GET["success"])): ?>
            <div class="alert alert-success">
                <?php 
                    switch ($_GET["success"]) {
                        case "add": echo "Task added successfully!"; break;
                        case "update": echo "Task updated successfully!"; break;
                        case "delete": echo "Task deleted successfully!"; break;
                    }
                ?>
            </div>
        <?php endif; ?>
        
        <div class="task-list">
            <h3>Your Tasks</h3>
            
            <?php if (empty($tasks)): ?>
                <p>You don't have any tasks yet. <a href="add_task.php">Add a task</a> to get started.</p>
            <?php else: ?>
                <?php foreach ($tasks as $task): ?>
                    <div class="task-item">
                        <div class="task-info">
                            <h3><?php echo htmlspecialchars($task["title"]); ?></h3>
                            <p><?php echo htmlspecialchars($task["description"]); ?></p>
                            <div class="task-meta">
                                <span class="status-<?php echo $task["status"]; ?>">
                                    Status: <?php echo ucfirst(str_replace('_', ' ', $task["status"])); ?>
                                </span>
                                <span>Due: <?php echo date("M d, Y", strtotime($task["due_date"])); ?></span>
                            </div>
                        </div>
                        <div class="task-actions">
                            <a href="edit_task.php?id=<?php echo $task["id"]; ?>" class="btn">Edit</a>
                            <button onclick="confirmDelete(<?php echo $task["id"]; ?>)" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <a href="add_task.php" class="btn btn-success">Add New Task</a>
    </div>
    
    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Task Manager</p>
        </div>
    </footer>
    
    <script src="assets/js/script.js"></script>
</body>
</html>