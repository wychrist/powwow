<?php

namespace Modules\CongregateBackend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CongregateUi\Services\MenuService;
use Modules\CongregateUi\Services\MenuItem;

class CongregateBackendController extends BackendBaseController
{

    public function __construct()
    {
        // $this->addBreadcrumb("Backend", "backend");
        $backendMenu = MenuService::getMainMenu();
        $backendMenu->addChild('Dashboard', ['backend-index'], 'fas fa-tachometer-alt');

        $settingsMenu = $backendMenu->addChild('Settings', icon: 'fa-solid fa-screwdriver-wrench');
        $settingsMenu->addChild('General', ['settings-general']);
        $settingsMenu->addChild('Api Settings');

        $backendMenu->addChild('Root 3', 'r3')
            ->addChild('Root 3, Child 1', 'r3.1');
        $backendMenu->addChild('Root 4', 'r4');
        $backendMenu->addChild('Root 5', 'r5')
            ->addChild('Root 5, Child 1', 'r5.1')
            ->addChild('Root 5, Child 1.1', 'r5.1.1')
            ->addChild('Root 5, Child 1.1.1', 'r5.1.1.1');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->addBreadcrumb("Dashboard", "", true);
        return view('congregatebackend::index');
    }

    public function setting()
    {
        $this->addBreadcrumb("Settings", "", true);
        return view('congregatebackend::setting');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('congregatebackend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('congregatebackend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('congregatebackend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
