import { config } from 'dotenv'
import { existsSync } from 'fs'
import { join } from 'path'

const envFilePath = join(__dirname, '../.env')

if (existsSync(envFilePath)) {
  config({
    path: envFilePath
  })
} else {
  console.error(`.env file not found as: ${envFilePath}`)
}

export default process.env
