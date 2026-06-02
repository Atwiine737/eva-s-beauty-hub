const ftp = require("basic-ftp");
const fs = require("fs");
const path = require("path");

const CONFIG = {
  host: "ftpupload.net",
  user: "if0_42046336",
  password: "EDeHczr2VUP9M6",
  port: 21,
};

const LOCAL = "C:/xampp/htdocs/evas-beauty-hub/";
const REMOTE = "/htdocs/";

const EXCLUDE = [
  "node_modules", ".git", ".firebase", ".zencoder", ".zenflow", "screenshots",
  "generate-report.js", "take-screenshots.js", "take-more-screenshots.js",
  "add-screenshots-to-report.js", "upload-to-infinityfree.js",
  "package.json", "package-lock.json", "deploy.log", "deploy2.log",
  ".firebaserc", "firebase.json", "README_FIREBASE.md",
  "AGENTS.md", "IMPLEMENTATION_SUMMARY.md", "MPESA_SETUP.md", "QUICK_REFERENCE.md",
  "FLOWCHART.md", "PROJECT_SYNOPSIS.md", "deploy-infinityfree.php",
];

const ALLOWED_FILES = [
  "index.html", "style.css", "db-config.php", "mpesa-config.php",
  "mpesa-payment.php", "mpesa-callback.php", "mpesa-tester.html",
  "database.sql", "COURSEWORK_GUIDE.md",
];

async function upload() {
  const client = new ftp.Client();
  client.ftp.verbose = false;

  try {
    console.log("Connecting to InfinityFree FTP...");
    await client.access(CONFIG);
    console.log("Connected!");

    // Go to htdocs
    await client.ensureDir(REMOTE);
    console.log("In /htdocs/");

    // Delete existing files first
    try {
      const list = await client.list();
      for (const item of list) {
        if (item.name !== "." && item.name !== "..") {
          try {
            if (item.isDirectory) {
              await client.removeDir(item.name);
              console.log(`  Removed dir: ${item.name}`);
            } else {
              await client.remove(item.name);
              console.log(`  Removed: ${item.name}`);
            }
          } catch (e) {
            console.log(`  Skipped ${item.name}: ${e.message}`);
          }
        }
      }
    } catch (e) {
      console.log("Could not clean remote: " + e.message);
    }

    // Ensure directories exist
    await client.ensureDir("api");
    await client.ensureDir("images");

    // Upload root files
    console.log("\nUploading root files...");
    const rootFiles = fs.readdirSync(LOCAL).filter(f => {
      const full = path.join(LOCAL, f);
      if (fs.statSync(full).isDirectory()) return false;
      if (EXCLUDE.includes(f)) return false;
      if (f.startsWith(".")) return false;
      return true;
    });

    let count = 0;
    for (const file of rootFiles) {
      try {
        await client.uploadFrom(path.join(LOCAL, file), file);
        count++;
        process.stdout.write(".");
      } catch (e) {
        console.log(`\n  Failed ${file}: ${e.message}`);
      }
    }
    console.log(` ${count} files uploaded to root`);

    // Upload api files
    console.log("Uploading API files...");
    const apiFiles = fs.readdirSync(path.join(LOCAL, "api"));
    for (const file of apiFiles) {
      if (file.endsWith(".php") || file.endsWith(".json")) {
        await client.uploadFrom(path.join(LOCAL, "api", file), `api/${file}`);
        process.stdout.write(".");
      }
    }
    console.log(" done");

    // Upload images
    console.log("Uploading images...");
    const imgFiles = fs.readdirSync(path.join(LOCAL, "images"));
    for (const file of imgFiles) {
      if (file.endsWith(".jpeg") || file.endsWith(".jpg") || file.endsWith(".png") || file.endsWith(".gif")) {
        await client.uploadFrom(path.join(LOCAL, "images", file), `images/${file}`);
        process.stdout.write(".");
      }
    }
    console.log(" done");

    console.log("\n\n✅ Upload complete!");
    console.log(`🔗 Visit: http://evas-beauty-hub.infinityfreeapp.com`);

  } catch (err) {
    console.error("FTP Error:", err);
  } finally {
    client.close();
  }
}

upload();
