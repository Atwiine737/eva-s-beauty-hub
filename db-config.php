<?php
// Database configuration for InfinityFree
define('DB_HOST', 'sql212.infinityfree.com');
define('DB_USER', 'if0_42046336');
define('DB_PASS', 'EDeHczr2VUP9M6');
define('DB_NAME', 'if0_42046336_evas_beauty');
define('DB_PORT', 3306);

/**
 * Establish database connection
 */
function get_db_connection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Global connection instance
$conn = get_db_connection();
?>
