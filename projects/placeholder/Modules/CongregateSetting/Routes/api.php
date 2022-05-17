<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Kpama\Easybuilder\Lib\Api\RouteBuilder;
use Modules\CongregateSetting\Entities\Setting;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/congregatesetting', function (Request $request) {
    return $request->user();
});


RouteBuilder::generate(model: Setting::class, slug: 'congregate-settings', forEachRoute: function($route) {
    $route->prefix('v1');
});
