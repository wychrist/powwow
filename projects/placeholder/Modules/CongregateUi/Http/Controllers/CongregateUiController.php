<?php

namespace Modules\CongregateUi\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CongregateUi\Services\BreadcrumbService;
use Modules\CongregateUi\Services\MenuService;
use Modules\CongregateUi\Services\MenuItemService;

class CongregateUiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $firstChild = new MenuItemService('First', '#', null, true);
        MenuService::addToMenu($firstChild);

        $firstChild->addChild('Child child 1', 'c1');
        $firstChild->addChild('Child child 2', 'c2');
        $firstChild->addChild('Child child 3', 'c3')
            ->addChild('Child Child 3 child 1', 'c31')
            ->addChild('Child Child 3 Child 1 child', 'c31');

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
