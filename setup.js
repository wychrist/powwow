const fs = require('fs')
const https = require('https')
const devtoolsDir = __dirname + '/backend/devtools'

if (fs.existsSync('.env.example') && !fs.existsSync('.env')) {
    fs.copyFileSync('.env.example', '.env')
}

if (!fs.existsSync(devtoolsDir)){
    fs.mkdirSync(devtoolsDir);
    fs.mkdirSync(`${devtoolsDir}/adminer`);
}

/* const file = fs.createWriteStream(`${devtoolsDir}/adminer/index.php`);
https.get('https://www.adminer.org/latest-en.php', function(response) {
  response.pipe(file);
});*/