<?php
/**
 * Eva's Beauty Hub - Database Installer
 * Visit this file ONCE to set up your database tables.
 * Delete this file after successful installation.
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('mysql.connect_timeout', 10);
ini_set('default_socket_timeout', 10);

echo "<!DOCTYPE html><html><head><title>Installing...</title>";
echo "<style>body{font-family:Arial;padding:40px;max-width:600px;margin:auto}h1{color:#6B2FA0}.ok{color:green}.fail{color:red}</style></head><body>";
echo "<h1>Eva's Beauty Hub - Database Setup</h1>";
echo "<p>Connecting to database...</p>";
ob_flush();
flush();

require_once 'db-config.php';
echo "<p class='ok'>✓ Database connected successfully</p>";
ob_flush();
flush();

$sql_file = __DIR__ . '/database.sql';
if (!file_exists($sql_file)) {
    echo "<p class='fail'>✗ database.sql not found!</p>";
    echo "</body></html>";
    exit;
}

$sql = file_get_contents($sql_file);
// Remove CREATE DATABASE and USE statements (InfinityFree assigns the database)
$sql = preg_replace('/CREATE DATABASE\s+IF NOT EXISTS\s+\w+;/i', '', $sql);
$sql = preg_replace('/USE\s+\w+;/i', '', $sql);
$sql = trim($sql);
if ($conn->multi_query($sql)) {
    echo "<p class='ok'>✓ SQL executed successfully</p>";
    do {
        if ($result = $conn->store_result()) $result->free();
    } while ($conn->next_result());
} else {
    echo "<p class='fail'>✗ Error: " . $conn->error . "</p>";
}

// Verify tables
echo "<h2>Verifying tables:</h2>";
$tables = ['orders', 'order_items', 'products'];
foreach ($tables as $table) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    if ($result && $result->num_rows > 0) {
        echo "<p class='ok'>✓ Table '$table' exists</p>";
    } else {
        echo "<p class='fail'>✗ Table '$table' missing</p>";
    }
}

echo "<hr><p><strong>Next:</strong> Visit <a href='index.html'>index.html</a> to verify the site works.</p>";
echo "<p style='color:#888'>Delete this install.php file after setup.</p>";
echo "</body></html>";
$conn->close();
?>
