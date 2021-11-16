import { NextFunction, Request, Response } from 'express'

export class IndexController {
  indexAction (request: Request, response: Response, next: NextFunction) {
    response.send('Hello from express')
  }
}
