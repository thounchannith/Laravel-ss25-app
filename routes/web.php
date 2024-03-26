<?php

use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoomController;
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
//    return view('welcome');
//});

Route::controller(DashboardController::class)->group(function (){
    Route::get('/', 'index');
});

Route::controller(RoomController::class)->group(function (){
    Route::get('/room', 'index');
    Route::get('/room/create', 'create');
    Route::post('room/save', 'save');

    Route::get('room/edit/{id}', 'edit');
    Route::post('room/update', 'update');
    Route::any('room/search', 'search');
    Route::get('/room/deactivate/{id}', 'deactivate');

});

Route::controller(AuthController::class)->group(function (){
    Route::get('login', 'index')->name('login');
    Route::post('login/postLogin', 'postLogin')->name('post.login');
});
