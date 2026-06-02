const ftp = require("basic-ftp");
const fs = require("fs");
const path = require("path");

async function upload() {
  const client = new ftp.Client();
  client.ftp.verbose = false;
  try {
    await client.access({
      host: "ftpupload.net",
      user: "if0_42046336",
      password: "EDeHczr2VUP9M6",
      secure: false,
    });
    console.log("Connected!");

    await client.cd("/htdocs");
    await client.uploadFrom("index.html", "index.html");
    console.log("Uploaded: index.html");
    await client.uploadFrom("style.css", "style.css");
    console.log("Uploaded: style.css");

    await client.ensureDir("images");
    await client.cd("/htdocs");

    const imageDir = "C:/xampp/htdocs/evas-beauty-hub/images";
    const files = fs.readdirSync(imageDir);
    for (const file of files) {
      const ext = path.extname(file).toLowerCase();
      if ([".jpeg", ".jpg", ".png", ".gif", ".webp"].includes(ext)) {
        const localPath = path.join(imageDir, file);
        await client.uploadFrom(localPath, "images/" + file);
      }
    }
    console.log("Uploaded all " + files.length + " images");

    console.log("Done!");
  } catch (err) {
    console.error(err);
  }
  client.close();
}
upload();
