<?php

namespace Modules\CongregateBackend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CongregateUi\Services\BreadcrumbService;

class BackendBaseController extends Controller
{

    protected function addBreadcrumb(string $label, string $path, bool $isActive = false) {
        BreadcrumbService::add($label, ($isActive)? '#': $path);
    }
}
