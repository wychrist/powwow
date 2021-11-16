import { NextFunction, Request, Response } from 'express'

export default class IndexConroller {
  public indexAction (_req: Request, res: Response, _next: NextFunction): void {
    res.json({
      hello: 'From base module'
    })
  }
}
