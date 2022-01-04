<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StaticController;
use App\Http\Controllers\ParserController;
use App\Http\Controllers\SerialsController;
use App\Http\Controllers\BronController;
use App\Http\Controllers\TestController;
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


Route::get('/', [StaticController::class, 'index']);
Route::get('/parse/{id}', [ParserController::class, 'index']);
Route::get('/auto_parse', [ParserController::class, 'auto_parse']);
Route::get('/tmdb', [ParserController::class, 'tmdb']);
Route::get('/searchSerialTmdb/{name}', [ParserController::class, 'tmdb_searchSerial']);
Route::get('/setTmdbSource/{id}', [ParserController::class, 'setTmdbSource']);
Route::get('/tmdb_test', [ParserController::class, 'tmdb_test']);
Route::get('/test', [TestController::class, 'index']);


Route::get('/serials', [SerialsController::class, 'index']);
Route::get('/serial/{slug}', [SerialsController::class, 'detail'])->name('serial-detail');

Route::get('/get_update', [BronController::class, 'index']);
