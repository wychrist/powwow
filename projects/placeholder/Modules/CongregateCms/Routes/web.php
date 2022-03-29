<?php

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

use Modules\CongregateCms\Http\Controllers\PostsController;
use Modules\CongregateCms\Http\Controllers\PageController;

if (config()->get('congregatecms.register_posts_endpoint', true)) {
    Route::prefix(config()->get('congregatecms.posts_endpoint', 'posts'))->group(function () {
        Route::get('/', [PostsController::class, 'indexAction'])->name('congregatecms.latest_posts');
        Route::get('/{id}', [PostsController::class, 'serveAction'])->name('congregatecms.a_posts');
    });
}

if (config()->get('congregatecms.register_pages_endpoint', true)) {
    Route::prefix(config()->get('congregatecms.pages_endpoint', 'pages'))->group(function () {
        Route::get('/{id}', [PageController::class, 'indexAction'])->name('congregatecms.a_page');
    });
}
