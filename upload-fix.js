const ftp = require("basic-ftp");
const fs = require("fs");
const path = require("path");

const HOST = "ftpupload.net";
const USER = "if0_42046336";
const PASS = "EDeHczr2VUP9M6";
const LOCAL = "C:/xampp/htdocs/evas-beauty-hub/";

async function main() {
  const client = new ftp.Client();
  client.ftp.verbose = false;

  try {
    await client.access({ host: HOST, user: USER, password: PASS, port: 21 });
    console.log("Connected!");

    // Go to htdocs
    await client.ensureDir("/htdocs");
    await client.cd("/htdocs");
    console.log("In /htdocs");

    // Create api directory FIRST
    await client.ensureDir("api");
    await client.cd("/htdocs");

    // Upload api files
    console.log("Uploading API files...");
    const apiFiles = ["create-order.php", "get-orders.php", "intasend-payment.php"];
    for (const f of apiFiles) {
      const local = path.join(LOCAL, "api", f);
      if (fs.existsSync(local)) {
        await client.uploadFrom(local, `api/${f}`);
        console.log(`  ✓ api/${f}`);
      }
    }

    // Upload database.sql
    console.log("\nUploading database.sql...");
    await client.uploadFrom(path.join(LOCAL, "database.sql"), "database.sql");
    console.log("  ✓ database.sql");

    // Upload deploy-infinityfree.php checker
    const deployCheck = path.join(LOCAL, "deploy-infinityfree.php");
    if (fs.existsSync(deployCheck)) {
      await client.uploadFrom(deployCheck, "deploy-infinityfree.php");
      console.log("  ✓ deploy-infinityfree.php");
    }

    // Upload .htaccess for clean URLs and security
    const htaccess = `RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.html [QSA,L]

# Security: Block access to sensitive files
<FilesMatch "^\.">
  Order allow,deny
  Deny from all
</FilesMatch>

<FilesMatch "(database\.sql|db-config\.php|mpesa-config\.php)$">
  Order allow,deny
  Deny from all
</FilesMatch>
`;
    const tmpFile = "C:/xampp/htdocs/evas-beauty-hub/.htaccess";
    fs.writeFileSync(tmpFile, htaccess);
    await client.uploadFrom(tmpFile, ".htaccess");
    console.log("  ✓ .htaccess");

    console.log("\n✅ Fix upload complete!");
    console.log("🔗 http://evas-beauty-hub.infinityfreeapp.com");
    console.log("🔧 Checker: http://evas-beauty-hub.infinityfreeapp.com/deploy-infinityfree.php");

  } catch (err) {
    console.error("Error:", err.message);
  } finally {
    client.close();
  }
}

main();
