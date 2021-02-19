const fs = require('fs')

if (fs.existsSync('.env.example') && !fs.existsSync('.env')) {
    fs.copyFileSync('.env.example', '.env')
}
