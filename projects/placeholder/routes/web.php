<?php

use App\Cms\Page;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsletterController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IndexController::class, 'indexAction'])->name('index');

// contact us
Route::get('/contact-us', [ContactController::class, 'indexAction'])->name('contact_us_form');
Route::post('/contact-us', [ContactController::class, 'handleAction'])->name('contact_us_submitted');

// newsletter
Route::post('/newsletter-do-subscribe', [NewsletterController::class, 'handleAction'])->name('newsletter_subscribe');

Route::get('/menu', function () {
    $menu = require_once(app_root_dir('content/data/menus/home_menu.php'));
    return $menu->toArray();
});

// @todo this suppose to be under "backend/..."
// this is the original dashboard Laravel provides
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// sanctum
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});



require __DIR__ . '/auth.php';
