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

Route::post('/test', function (Request $request) {
    // $user = Auth::user();
    
    // $user = User::find($id);
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
// Route::post('/test', function (Request $request) {
//     // キャラ生成
//     $characters = new Character;
//     $characters->user_id = Auth::user();
//     $characters->name = $request->name;
//     $characters->hp = $request->hp;
//     $characters->ap = $request->ap;
//     $characters->dp = $request->dp;
//     $characters->thumnailURL = $request->thumnailURL;
//     $characters->pictoURL = $request->pictoURL;
//     $characters->save();
//     return "ok";
// });

// post charのルーティング書く。
// 挿入処理を書いてみて、通ったらcontrollerに移行する。 Api controller '書き方例：CharactersController@store'
Route::post('/user/{{Auth::user()->id}}/characters', function (Request $request) {
    //キャラテーブル挿入
    // $validator = Validator::make($request->all(), [
    //     'user_id' => 'required',
    //     'name' => 'required',
    //     'hp' => 'required',
    //     'ap' => 'required',
    //     'dp' => 'required',
    //     'thumnailURL' => 'required',
    //     'pictoURL' => 'required'
    // ]);
    // //バリデーション:エラー 
    // if ($validator->fails()) {
    //     return redirect('/create_characters')
    //         ->withInput()
    //         ->withErrors($validator);
    // }
    // キャラ生成
    $characters = new Character;
    $characters->user_id = $request->user_id;
    $characters->name = $request->name;
    $characters->hp = $request->hp;
    $characters->ap = $request->ap;
    $characters->dp = $request->dp;
    $characters->thumnailURL = $request->thumnailURL;
    $characters->pictoURL = $request->pictoURL;
    $characters->save();
    return redirect('/create_characters');
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
