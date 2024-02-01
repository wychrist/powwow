<?php

use App\Http\Controllers\Api\V1\OnlineContactApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::resource('online-contacts', OnlineContactApiController::class);
    Route::get('me', function (Request $request) {
        return [
            'user' => auth('sanctum')->user(),
            'success' => true
        ];
    });
})->middleware('auth:sanctum');

Route::get('/time', function (Request $request) {
    return ['ts' => time()];
});
