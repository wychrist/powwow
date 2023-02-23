<?php

use Illuminate\Support\Facades\Route;
use Modules\CongregateBackend\Http\Controllers\AssetController;
use Modules\CongregateBackend\Http\Controllers\TableController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix(config('congregatebackend.backend_segment_uri', 'backend'))->middleware('auth')->group(function () {
    Route::get('/', 'CongregateBackendController@index')->name('backend-index');
    Route::get('/settings', 'CongregateBackendController@setting')->name('settings-general');

    // just for example
    Route::get('/table-json/example', [TableController::class, 'exampleAction'])->name('table-json-index');

    Route::get('/table-json/{tableModel}', [TableController::class, 'indexAction'])->name('table-json-index');
});

if (config('env') != 'production') {
    /**
     * Make sure to publish your public assets when going live
     */
    Route::get('congregatebackend/{path?}', [AssetController::class, 'serveAction'])->where('path', '(.*)');
}
