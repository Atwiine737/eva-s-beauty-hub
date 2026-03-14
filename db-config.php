<?php
// Database configuration for XAMPP
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'evas_beauty_hub');

/**
 * Establish database connection
 */
function get_db_connection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create database if not exists
    $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
    if ($conn->query($sql) !== TRUE) {
        die("Error creating database: " . $conn->error);
    }

    $conn->select_db(DB_NAME);
    return $conn;
}

// Global connection instance
$conn = get_db_connection();
?>
