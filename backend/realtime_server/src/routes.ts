import { UserController } from "./controller/UserController";
import { ApplicationController } from './controller/ApplicationController'


const userRoutes = [
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
]

const applicationRoutes = [
    {
        method: 'post',
        route: '/applications',
        controller: ApplicationController,
        action: 'create'
    }
];

export const Routes = [
    ...userRoutes,
    ...applicationRoutes
];