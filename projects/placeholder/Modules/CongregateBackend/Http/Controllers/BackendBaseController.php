<?php

namespace Modules\CongregateBackend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CongregateUi\Services\BackendMenuService;
use Modules\CongregateUi\Services\BreadcrumbService;
use Modules\CongregateUi\Services\MenuItem;
use Modules\CongregateUi\Services\MenuService;

class BackendBaseController extends Controller
{

    protected function addBreadcrumb(string $label, string $path, bool $isActive = false)
    {
        BreadcrumbService::add($label, ($isActive) ? '#' : $path);
        BackendMenuService::setup(function (MenuItem $menu) {
            $menu->addChild('Dashboard', ['backend-index'], 'fas fa-tachometer-alt');
        });
    }
}
