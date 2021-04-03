import { AdminController } from './controller/AdminController'
import { ApplicationController } from './controller/ApplicationController';
import { IRoute } from './type/Interfaces'



const appRoutes: IRoute[] = [
    {
        method: 'get',
        route: '/api/app/:key',
        controller: ApplicationController,
        action: 'get'
    },
    {
        method: 'post',
        route: '/api/app/:key/trigger',
        controller: ApplicationController,
        action: 'trigger'
    }
];

const adminRoutes: IRoute[] = [
    {
        method: 'get',
        route: '/api/admin/applications',
        controller: AdminController,
        action: 'getApplications'
    },
    {
        method: 'get',
        route: '/api/admin/applications/:id',
        controller: AdminController,
        action: 'getAnApplication'
    },
    {
        method: 'post',
        route: '/api/admin/applications',
        controller: AdminController,
        action: 'createApplication'
    },
    {
        method: 'put',
        route: '/api/admin/applications/:id',
        controller: AdminController,
        action: 'updateApplication'
    },
    {
        method: 'delete',
        route: '/api/admin/applications/:id',
        controller: AdminController,
        action: 'deleteApplication'
    },
    {
        method: 'put',
        route: '/api/admin/applications/restore/:id',
        controller: AdminController,
        action: 'restoreApplication'
    }
];

export const Routes = [
    ...adminRoutes,
    ...appRoutes,
];