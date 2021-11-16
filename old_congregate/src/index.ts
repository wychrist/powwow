import 'reflect-metadata'
import env from './setup_env'
import { createConnection } from 'typeorm'
import * as express from 'express'
import * as bodyParser from 'body-parser'
import { Request, Response } from 'express'
import { Routes } from './routes'
import Api from './setup_api'

const cors = require('cors')

createConnection().then(async connection => {
  // create express app
  const app = express()

  app.use(cors())
  app.use(bodyParser.json())

  // api routes
  app.use('/api/v1', Api)

  // register express routes from defined application routes
  Routes.forEach(route => {
    (app as any)[route.method](route.route, (req: Request, res: Response, next: Function) => {
      const result = (new (route.controller as any)())[route.action](req, res, next)
      if (result instanceof Promise) {
        result.then(result => result !== null && result !== undefined ? res.send(result) : undefined)
      } else if (result !== null && result !== undefined) {
        res.json(result)
      }
    })
  })

  // start express server
  app.listen(env.CP_CONGREGATE_PORT)

  console.log(`Express server has started on port ${env.CP_CONGREGATE_PORT}. Open http://localhost:${env.CP_CONGREGATE_PORT}`)
}).catch(error => console.log(error))
