<?php
/**
 * Eva's Beauty Hub - InfinityFree Deployment Checker
 * Upload this file to your InfinityFree hosting and run it
 * to verify your deployment is working correctly.
 */

echo "<!DOCTYPE html><html><head><title>Deployment Check</title>";
echo "<style>body{font-family:Arial;padding:20px;max-width:800px;margin:auto}";
echo ".pass{color:green;font-weight:bold}.fail{color:red;font-weight:bold}";
echo ".warn{color:orange;font-weight:bold}h1{color:#6B2FA0}";
echo "table{width:100%;border-collapse:collapse}td,th{border:1px solid #ddd;padding:8px;text-align:left}";
echo "th{background:#6B2FA0;color:white}</style></head><body>";
echo "<h1>Eva's Beauty Hub - Deployment Check</h1>";

// PHP Version
echo "<h2>1. PHP Environment</h2><table>";
echo "<tr><td>PHP Version</td><td>" . phpversion() . "</td>";
echo "<td>" . (version_compare(phpversion(), "7.0", ">=") ? "<span class='pass'>OK</span>" : "<span class='fail'>Needs PHP 7.0+</span>") . "</td></tr>";

echo "<tr><td>MySQLi Extension</td><td>" . (extension_loaded("mysqli") ? "Loaded" : "NOT LOADED") . "</td>";
echo "<td>" . (extension_loaded("mysqli") ? "<span class='pass'>OK</span>" : "<span class='fail'>Required</span>") . "</td></tr>";

echo "<tr><td>cURL Extension</td><td>" . (extension_loaded("curl") ? "Loaded" : "NOT LOADED") . "</td>";
echo "<td>" . (extension_loaded("curl") ? "<span class='pass'>OK</span>" : "<span class='fail'>Required for M-Pesa</span>") . "</td></tr>";

echo "<tr><td>JSON Extension</td><td>" . (extension_loaded("json") ? "Loaded" : "NOT LOADED") . "</td>";
echo "<td>" . (extension_loaded("json") ? "<span class='pass'>OK</span>" : "<span class='fail'>Required</span>") . "</td></tr>";
echo "</table>";

// Database check
echo "<h2>2. Database Connection</h2>";
$db_host = getenv('DB_HOST') ?: "sqlXXX.infinityfree.com"; // REPLACE with your InfinityFree MySQL host
$db_user = getenv('DB_USER') ?: "if0_XXXXXXX"; // REPLACE
$db_pass = getenv('DB_PASS') ?: "your_password";
$db_name = getenv('DB_NAME') ?: "if0_XXXXXXX_evas_beauty";

echo "<table>";
echo "<tr><td>DB Host</td><td>" . htmlspecialchars($db_host) . "</td><td><span class='warn'>UPDATE NEEDED</span></td></tr>";

$conn = @new mysqli($db_host, $db_user, $db_pass);
if ($conn->connect_error) {
    echo "<tr><td>Connection</td><td colspan='2'><span class='fail'>FAILED: " . htmlspecialchars($conn->connect_error) . "</span></td></tr>";
} else {
    echo "<tr><td>Connection</td><td colspan='2'><span class='pass'>Connected Successfully</span></td></tr>";
    
    // Check database
    $result = $conn->select_db($db_name);
    if ($result) {
        echo "<tr><td>Database " . htmlspecialchars($db_name) . "</td><td colspan='2'><span class='pass'>Found</span></td></tr>";
        
        // Check tables
        $tables = $conn->query("SHOW TABLES");
        if ($tables && $tables->num_rows > 0) {
            echo "<tr><td>Tables</td><td colspan='2'>";
            while ($row = $tables->fetch_array()) {
                echo "✓ " . $row[0] . "<br>";
            }
            echo "</td></tr>";
        } else {
            echo "<tr><td>Tables</td><td colspan='2'><span class='warn'>No tables found. Import database.sql</span></td></tr>";
        }
    } else {
        echo "<tr><td>Database " . htmlspecialchars($db_name) . "</td><td colspan='2'><span class='fail'>Not Found. Create it in cPanel</span></td></tr>";
    }
    $conn->close();
}
echo "</table>";

// File structure
echo "<h2>3. File Structure</h2><table>";
$files = ["index.html","style.css","db-config.php","mpesa-config.php","mpesa-payment.php","mpesa-callback.php","api/create-order.php","api/get-orders.php","database.sql"];
foreach ($files as $file) {
    $exists = file_exists(__DIR__ . "/" . $file);
    echo "<tr><td>/" . $file . "</td><td>" . ($exists ? "✓ Found" : "✗ Missing") . "</td>";
    echo "<td>" . ($exists ? "<span class='pass'>OK</span>" : "<span class='fail'>Missing</span>") . "</td></tr>";
}
echo "</table>";

echo "<h2>4. Next Steps</h2>";
echo "<ol>";
echo "<li><strong>Register</strong> at <a href='https://infinityfree.net'>InfinityFree.net</a></li>";
echo "<li><strong>Create account</strong> and go to control panel</li>";
echo "<li><strong>Create a MySQL database</strong> (copy the host, username, password)</li>";
echo "<li><strong>Import <code>database.sql</code></strong> into phpMyAdmin</li>";
echo "<li><strong>Upload all files</strong> via FTP (use FileZilla)</li>";
echo "<li><strong>Update <code>db-config.php</code></strong> with InfinityFree DB credentials</li>";
echo "<li><strong>Update <code>mpesa-config.php</code></strong> with live IntaSend keys when ready</li>";
echo "<li><strong>Visit your site</strong> and test the deployment</li>";
echo "</ol>";

echo "<hr><p style='color:#888'>Eva's Beauty Hub - Deployment Checker</p>";
echo "</body></html>";
?>
