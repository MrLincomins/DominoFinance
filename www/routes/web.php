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


Route::get('/games/toystore', function () {
    return view('toystore');
});

Route::get('/games/toystore', function () {
    return view('toystore');
});


Route::get('/investorsimulator', function () {
    return view('investorSimulator');
});

Route::get('/companyman', function () {
    return view('compman');
});

Route::get('/finansequest', function () {
    return view('finanseQuest');
});

Route::get('/whatcostmore', function () {
    return view('whatCostMore');
});


Route::post('/account/registration', [AccountController::class, 'registration']);
Route::post('/account/login', [AccountController::class, 'login']);


Route::get('/account', function () {
    return view('account');
});
Route::get('/account/logout', [AccountController::class, 'endSession']);
Route::get('/games', function () {
    return view('games');
});
Route::get('/wiki', function () {
    return view('wiki');
});


