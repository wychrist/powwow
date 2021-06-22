<?php

use App\Models\User;
use App\Services\Easybuilder\Parser;
use Illuminate\Support\Facades\Route;
use Modules\People\Entities\Person;
use Modules\People\Entities\PersonRelationship;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('test', function(){
    $parser = new Parser();
    return $parser->parse(Person::class)['relationships'];
});

require __DIR__.'/auth.php';
