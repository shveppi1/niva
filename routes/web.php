<?php

/** @var \Illuminate\Routing\Router $router */

use App\Http\Controllers\StaticController;
use \App\Http\Controllers\HelpsController;
use \App\Http\Controllers\GuardController;
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
        ->get('/family', [HelpsController::class, 'helpsClub'])->middleware('isClubUser')->name('helps-club');
    $router
        ->get('/{id}', [HelpsController::class, 'helpsDetail'])->name('help-detail');
});


$router->get('/check/{code}', [GuardController::class, 'checkHash'])->name('check_code');
$router->get('/addcode/{code}', [GuardController::class, 'addHash'])->name('add_code');
