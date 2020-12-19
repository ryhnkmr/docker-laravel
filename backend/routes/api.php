<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Events\AttackEvent;

Route::post('/battle',function(Request $request){

    $battle = [
       'tern'=> $request->tern,
       'first_flg'=> $request->first_flg
    ];

    event(new AttackEvent($battle));
    Log::debug($battle);

    return $battle;
});
