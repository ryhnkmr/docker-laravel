<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Character;
use App\Models\Room;
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
Route::post('/api/user/{{Auth::user()->id}}/characters', function (Request $request) {

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
use App\Events\RoomCreated;
Route::post('/rooms/{id}/attack',function($id, Request $request){

    Log::debug($id);
    $battle = [
       'info'=> $request->info,
       'player1'=> $request->player1,
       'player2'=> $request->player2,
    ];

    event(new AttackEvent($battle, $id));
    return $battle;
});

Route::post('rooms', function(Request $request) {
    $room = Room::create($request->all());
    $room->users()->attach($request->user_id);
    $characters = User::find($request->user_id)->teams->first()->characters;

    event(new RoomCreated($room, $characters));
    
    return $room;
});

Route::post('rooms/join', function(Request $request) {
    $room = Room::where([['can_join_flg', true], ['id', $request->room_id]])->first();
    
    return $room;
});
