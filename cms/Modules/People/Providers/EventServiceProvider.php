<?php

namespace Modules\People\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider  as ServiceProvider;
use Modules\People\Listeners\HandleSchemaString;
use Nuwave\Lighthouse\Events\BuildSchemaString;
use App\Events\Api\User\{
    Created as UserCreated
};

use Modules\People\Listeners\{
    User\Created as UserCreatedHandler
};

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        BuildSchemaString::class => [
            HandleSchemaString::class
        ],
        UserCreated::class  => [
            UserCreatedHandler::class
        ]
    ];
}
