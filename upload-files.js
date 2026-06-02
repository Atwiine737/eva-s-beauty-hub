const ftp = require("basic-ftp");

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
    await client.ensureDir("/htdocs");
    await client.uploadFrom("index.html", "index.html");
    console.log("Uploaded: index.html");
    await client.uploadFrom("style.css", "style.css");
    console.log("Uploaded: style.css");
    console.log("Done!");
  } catch (err) {
    console.error(err);
  }
  client.close();
}
upload();
