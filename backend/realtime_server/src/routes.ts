// import { UserController } from "./controller/UserController";
import { AdminController } from './controller/AdminController'
import { IRoute } from './type/Interfaces'


/* const userRoutes = [
    {
        method: "get",
        route: "/users",
        controller: UserController,
        action: "all"
    }, {
        method: "get",
        route: "/users/:id",
        controller: UserController,
        action: "one"
    }, {
        method: "post",
        route: "/users",
        controller: UserController,
        action: "save"
    }, {
        method: "delete",
        route: "/users/:id",
        controller: UserController,
        action: "remove"
    }
]*/

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
    },
    {
        method: 'post',
        route: '/api/pusher/auth',
        controller: AdminController,
        action: 'testHash'
    }
];

export const Routes = [
    ...adminRoutes
];