// import { UserController } from "./controller/UserController";
import { ApplicationController } from './controller/ApplicationController'
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
        route: '/admin/applications',
        controller: AdminController,
        action: 'getApplications'
    },
    {
        method: 'post',
        route: '/admin/applications',
        controller: AdminController,
        action: 'createApplication'
    }
];

const applicationRoutes: IRoute[] = [
    {
        method: 'get',
        route: '/applications',
        controller: ApplicationController,
        action: 'get'
    },
    {
        method: 'post',
        route: '/applications',
        controller: ApplicationController,
        action: 'create'
    }
];

export const Routes = [
    // ...userRoutes,
    ...applicationRoutes,
    ...adminRoutes
];