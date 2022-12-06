<?php

namespace Modules\CongregateUi\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CongregateUi\Services\BreadcrumbService;
use Modules\CongregateUi\Services\MenuService;
use Modules\CongregateUi\Services\MenuItem;

class CongregateUiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $menu = MenuService::getMainMenu();

        $menu->addChild('Root 1', '1');
        $menu->addChild('Root 2', '2')->addChild('Root 2, Child 1', '2.1');
        $menu->addChild('Congregate UI', ['congregateui']);
        $menu->addChild('Root 3', '3')
            ->addChild('Root 3 child 1', '3.1')
            ->addChild('Root 3 Child 1 child 1', ['congregateui']);

        return view('congregateui::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('congregateui::create');
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
        return view('congregateui::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('congregateui::edit');
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
