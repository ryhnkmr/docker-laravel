<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create_characters', function () {
    return view('create_characters');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\MyPagesController::class, 'mypage']);

Route::get('/mypage', 'MyPagesController@mypage'); //MyPagesController

Route::group(['middleware' => 'auth'], function(){
    Route::get("/mypage",function(){
        return view("/mypage");
    });
});

