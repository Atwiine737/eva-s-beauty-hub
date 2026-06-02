const ftp = require("basic-ftp");
const fs = require("fs");
const path = require("path");

const HOST = "ftpupload.net";
const USER = "if0_42046336";
const PASS = "EDeHczr2VUP9M6";

async function upload() {
  const client = new ftp.Client();
  client.ftp.verbose = false;
  try {
    await client.access({ host: HOST, user: USER, password: PASS, secure: false });
    console.log("Connected!");
    await client.cd("/htdocs");

    // Upload HTML + CSS
    await client.uploadFrom("index.html", "index.html");
    console.log("Uploaded: index.html");
    await client.uploadFrom("style.css", "style.css");
    console.log("Uploaded: style.css");

    // Upload product images to root
    const files = fs.readdirSync(".");
    let count = 0;
    for (const f of files) {
      if (f.endsWith(".jpeg") && fs.statSync(f).isFile()) {
        await client.uploadFrom(f, f);
        count++;
        process.stdout.write(".");
      }
    }
    console.log(` Uploaded ${count} images to root`);

    // Upload background images to images/
    await client.ensureDir("images");
    for (const f of ["body-bg.jpg", "hero-bg.jpg", "products-bg.jpg"]) {
      const localPath = path.join("images", f);
      if (fs.existsSync(localPath)) {
        await client.uploadFrom(localPath, "images/" + f);
        console.log("Uploaded: images/" + f);
      }
    }

    console.log("Done!");
  } catch (err) {
    console.error("Error:", err.message);
  }
  client.close();
}
upload();
