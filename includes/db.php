<?php
require_once 'config.php';

// Create database connection - using a single connection
$GLOBALS['conn'] = null;

function connectDB() {
    if ($GLOBALS['conn'] === null) {
        $GLOBALS['conn'] = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
        // Check connection
        if ($GLOBALS['conn']->connect_error) {
            die("Connection failed: " . $GLOBALS['conn']->connect_error);
        }
    }
    
    return $GLOBALS['conn'];
}

// Close database connection
function closeDB() {
    if ($GLOBALS['conn'] !== null) {
        $GLOBALS['conn']->close();
        $GLOBALS['conn'] = null;
    }
}
?>