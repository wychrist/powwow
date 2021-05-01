const fs = require("fs");
const https = require("https");
const devtoolsDir = __dirname + "/devtools";
const file = fs.createWriteStream(`${devtoolsDir}/adminer/index.php`);
const url = "https://www.adminer.org/latest-en.php"

function fetchFile(url) {
  https.get(url, function (response) {
    if (response.statusCode === 302) {
      const url = (response.headers.location.indexOf("http") != -1)
        ? response.headers.location
        : `https://www.adminer.org/${response.headers.location}`;
        fetchFile(url)
    } else {
      response.pipe(file);
    }
  });
}

if (fs.existsSync(".env.example") && !fs.existsSync(".env")) {
  fs.copyFileSync(".env.example", ".env");
}

if (!fs.existsSync(devtoolsDir)) {
  fs.mkdirSync(devtoolsDir);
  fs.mkdirSync(`${devtoolsDir}/adminer`);
}


fetchFile(url);