<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;


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

use App\Events\Battle;

Route::get('/room', function () {

    event(new Battle);
    return view('test');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'home']);
    Route::get('/create_characters', function () {
        return view('create_characters');
    });
    
    Route::resource('rooms', RoomController::class);
});


