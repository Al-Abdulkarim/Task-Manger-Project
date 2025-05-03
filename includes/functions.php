<?php
require_once 'db.php';

// Function to register a new user
function registerUser($username, $email, $password) {
    $conn = connectDB();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if (!$stmt) return false;
    
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    $result = $stmt->execute();
    $stmt->close();
    
    return $result;
}

// Function to authenticate a user
function loginUser($username, $password) {
    $conn = connectDB();
    
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? LIMIT 1");
    if (!$stmt) return false;
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;
            
            $stmt->close();
            return true;
        }
    }
    
    $stmt->close();
    return false;
}

// Function to get all tasks for a user
function getUserTasks($user_id) {
    $conn = connectDB();
    $tasks = array();
    
    $stmt = $conn->prepare("SELECT id, title, description, status, due_date FROM tasks WHERE user_id = ? ORDER BY due_date ASC");
    if (!$stmt) return $tasks;
    
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
    
    $stmt->close();
    return $tasks;
}

// Function to add a new task
function addTask($user_id, $title, $description, $due_date) {
    $conn = connectDB();
    
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, title, description, due_date) VALUES (?, ?, ?, ?)");
    if (!$stmt) return false;
    
    $stmt->bind_param("isss", $user_id, $title, $description, $due_date);
    $result = $stmt->execute();
    $stmt->close();
    
    return $result;
}

// Function to update a task
function updateTask($task_id, $user_id, $title, $description, $status, $due_date) {
    $conn = connectDB();
    
    $stmt = $conn->prepare("UPDATE tasks SET title = ?, description = ?, status = ?, due_date = ? WHERE id = ? AND user_id = ?");
    if (!$stmt) return false;
    
    $stmt->bind_param("ssssis", $title, $description, $status, $due_date, $task_id, $user_id);
    $result = $stmt->execute();
    $stmt->close();
    
    return $result;
}

// Function to delete a task
function deleteTask($task_id, $user_id) {
    $conn = connectDB();
    
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
    if (!$stmt) return false;
    
    $stmt->bind_param("ii", $task_id, $user_id);
    $result = $stmt->execute();
    $stmt->close();
    
    return $result;
}

// Function to get a single task
function getTask($task_id, $user_id) {
    $conn = connectDB();
    
    $stmt = $conn->prepare("SELECT id, title, description, status, due_date FROM tasks WHERE id = ? AND user_id = ? LIMIT 1");
    if (!$stmt) return false;
    
    $stmt->bind_param("ii", $task_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $task = $result->fetch_assoc();
        $stmt->close();
        return $task;
    }
    
    $stmt->close();
    return false;
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
}

// Redirect functions
function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header("location: login.php");
        exit;
    }
}

function redirectIfLoggedIn() {
    if (isLoggedIn()) {
        header("location: dashboard.php");
        exit;
    }
}
?>