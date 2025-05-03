<?php
// Database configuration
define('DB_SERVER', 'sql306.infinityfree.com'); // InfinityFree MySQL server
define('DB_USERNAME', ''); // Your database username
define('DB_PASSWORD', ''); // Your database password
define('DB_NAME', ''); // Your database name

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>