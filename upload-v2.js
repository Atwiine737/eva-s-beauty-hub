const ftp = require("basic-ftp");
const fs = require("fs");
const path = require("path");

const HOST = "ftpupload.net";
const USER = "if0_42046336";
const PASS = "EDeHczr2VUP9M6";
const LOCAL = "C:/xampp/htdocs/evas-beauty-hub/";

const EXCLUDE_DIRS = ["node_modules", ".git", ".firebase", ".zencoder", ".zenflow", "screenshots", "test-results"];
const EXCLUDE_FILES = [
  "generate-report.js", "take-screenshots.js", "take-more-screenshots.js",
  "add-screenshots-to-report.js", "upload-to-infinityfree.js", "upload-v2.js",
  "package.json", "package-lock.json", "deploy.log", "deploy2.log",
  ".gitignore", ".gitattributes", ".env", ".firebaserc", "firebase.json",
  "README_FIREBASE.md", "COURSEWORK_GUIDE.md",
];
const IMG_EXT = [".jpeg", ".jpg", ".png", ".gif", ".webp", ".ico"];

async function uploadDir(client, localDir, remoteDir) {
  await client.ensureDir(remoteDir);
  const entries = fs.readdirSync(localDir, { withFileTypes: true });

  for (const entry of entries) {
    const localPath = path.join(localDir, entry.name);
    const remotePath = remoteDir ? `${remoteDir}/${entry.name}` : entry.name;

    if (entry.isDirectory()) {
      if (EXCLUDE_DIRS.includes(entry.name)) continue;
      if (entry.name.startsWith(".")) continue;
      process.stdout.write(`\n[DIR] ${remotePath}`);
      await uploadDir(client, localPath, remotePath);
    } else if (entry.isFile()) {
      if (EXCLUDE_FILES.includes(entry.name)) continue;
      if (entry.name.startsWith(".")) continue;
      const ext = path.extname(entry.name).toLowerCase();
      if (![".php", ".html", ".css", ".js", ".json", ".sql", ".md", ...IMG_EXT].includes(ext)) continue;

      try {
        await client.uploadFrom(localPath, remotePath);
        process.stdout.write(".");
      } catch (e) {
        process.stdout.write(`x`);
        console.log(`\n  Failed: ${remotePath} - ${e.message}`);
      }
    }
  }
}

async function main() {
  const client = new ftp.Client();
  client.ftp.verbose = false;

  try {
    console.log("Connecting to InfinityFree...");
    await client.access({ host: HOST, user: USER, password: PASS, port: 21 });
    console.log("Connected!");

    await client.cd("/htdocs");
    console.log("Uploading files to /htdocs...\n");

    await uploadDir(client, LOCAL, "");

    console.log("\n\n✅ Upload complete!");
    console.log("🔗 http://evas-beauty-hub.infinityfreeapp.com");
  } catch (err) {
    console.error("\nError:", err.message);
  } finally {
    client.close();
  }
}

main();
