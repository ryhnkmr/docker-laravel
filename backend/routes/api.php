<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Character;
use App\Models\User;
// use Validator;

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

// post charのルーティング書く。
// 挿入処理を書いてみて、通ったらcontrollerに移行する。 Api controller '書き方例：CharactersController@store'
Route::post('/test', function (Request $request) {
    // キャラ生成
    $characters = Character::create([
        'user_id'=> $request->user_id,
        'name'=> $request->name,
        'hp'=>$request->hp,
        'ap'=>$request->ap,
        'dp'=>$request->dp,
        'thumnailURL'=>$request->thumnailURL,
        'pictoURL'=>$request->pictoURL,
    ]);
    return "ok";
});

// 画像合成用（クロスサイト対策）
Route::post('/picto', function (Request $request) {
    $result = "data:image/jpeg;base64," .base64_encode(file_get_contents($request->url)); 
    return $result;
});



use App\Events\AttackEvent;

Route::post('/battle', function (Request $request) {

    $battle = [
        'tern' => $request->tern,
        'first_flg' => $request->first_flg
    ];

    event(new AttackEvent($battle));
    Log::debug($battle);

    return $battle;
});
