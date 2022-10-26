<?php

/** @var \Illuminate\Routing\Router $router */

use App\Http\Controllers\StaticController;
use \App\Http\Controllers\HelpsController;
use \App\Http\Controllers\GuardController;
use \App\Http\Controllers\ApsController;
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


Route::get('/', [StaticController::class, 'index'])->name('main');

$router->group(['prefix' => 'helps', 'middleware' => []], function () use ($router) {
    $router
        ->get('/', [HelpsController::class, 'helps'])->name('helps');
    $router
        ->get('/family', [HelpsController::class, 'helpsClub'])->name('helps-club');
    $router
        ->get('/{id}', [HelpsController::class, 'helpsDetail'])->name('help-detail');
});


$router->post('/check-hash', [GuardController::class, 'checkHash'])->name('check_hash');
$router->post('/addcode', [GuardController::class, 'addHash'])->name('add_code');
$router->post('/check-code', [GuardController::class, 'checkCode'])->name('check_code');
$router->post('/get-map', [ApsController::class, 'getMap'])->name('getmap');
$router->post('/get-gallery', [ApsController::class, 'getGallery'])->name('getgallery');

/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/


require __DIR__.'/auth.php';
