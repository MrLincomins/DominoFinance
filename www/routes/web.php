<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\AccountController;
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
//Route::get('/', function () {
//    return view('main');
//});
//
//Route::post('/', [SearchController::class, 'search']);


Route::get('/', function () {
    return view('main');
});

Route::post('/account/registration', [AccountController::class, 'registration']);


Route::get('/account', function () {
    return view('account');
});
Route::get('/games', function () {
    return view('games');
});
Route::get('/wiki', function () {
    return view('wiki');
});


Route::post('/main', [SearchController::class, 'search']);

