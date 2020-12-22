<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoomController;
use App\Models\Team;

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

Route::post('/teams', function (Request $request) {
    // Eloquent モデル
    // $teams = new Team;
    // $books->item_name =    $request->item_name;
    // $books->item_number =  $request->item_number;
    // $books->item_amount =  $request->item_amount;
    // $books->published =    $request->published;
    // $books->save();   //「/」ルートにリダイレクト 
    return redirect('/');
    $team = Team::create([
    //     'name' => $request->name,
    //     'user_id' => $request->user_id,
    ]);
});

Route::get('/home', function () {
    return view('index');
});


Route::get('/', function () {
    return view('index');
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


