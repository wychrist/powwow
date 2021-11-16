import { Request, Response, Router, NextFunction } from 'express'
import IndexController from './controller/api/IndexController'

// register api routes
const routes = [{
  method: 'get',
  route: '/base',
  controller: IndexController,
  action: 'indexAction'
}]

export default function setup (route: Router): void {
  routes.forEach((entry) => {
    route[entry.method](entry.route, (req: Request, res: Response, next: NextFunction) => {
      const result = (new (entry.controller as any)())[entry.action](req, res, next)

      if (result instanceof Promise) {
        result.then(result => result !== null && result !== undefined ? res.send(result) : undefined)
      } else if (result !== null && result !== undefined) {
        if (typeof result === 'object') {
          res.json(result)
        } else {
          res.send(result)
        }
      }
    })
  })
}
