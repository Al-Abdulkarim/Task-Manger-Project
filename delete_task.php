<?php
require_once 'includes/functions.php';
redirectIfNotLoggedIn();

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("location: dashboard.php");
    exit;
}

$task_id = $_GET["id"];

if (deleteTask($task_id, $_SESSION["id"])) {
    header("location: dashboard.php?success=delete");
} else {
    header("location: dashboard.php?error=delete");
}
exit;
?>