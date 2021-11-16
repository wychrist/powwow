import * as express from 'express'
import BaseSetup from './modules/base/base_api_routes'

// import { ApiRoutes } from './api_routes'

const router = express.Router()

BaseSetup(router)

export default router
