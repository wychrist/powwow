<?php

namespace Modules\Security\Http\Controllers;

use App\City;
use App\Company;
use App\Content;
use App\Product;
use App\Subsidiary;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\People\Entities\Person;
use Modules\Security\Entities\Dashboard;
use Modules\Security\Entities\Permission;
use Modules\Security\Entities\Role;
use Modules\Security\Services\Security;

class SecurityController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        $user = User::first();

        // $user->setMetadataInt('total_points', 31, true);
        //$user->save();

        return $user->getMetadataAsKeyValue();
        return company()->roles;
        $dashboard = new Dashboard([
            'name' => 'Staff Dashboard'
        ]);

        $staffRole = Role::where('alias', 'staff')->first();

        $dashboard->save();
        $dashboard->roles()->attach($staffRole);

        return view('security::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('security::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('security::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('security::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
