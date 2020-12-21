<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Character;
use App\Models\User;
use App\Models\Room;

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
    $character = Character::create([
        'user_id' => $request->user_id,
        'name' => $request->name,
        'hp' => $request->hp,
        'ap' => $request->ap,
        'dp' => $request->dp,
        'thumnailURL' => $request->thumnailURL,
        'pictoURL' => $request->pictoURL,
    ]);
    return $character;
});

// 画像合成用（クロスサイト対策）
Route::post('/picto', function (Request $request) {
    $result = "data:image/jpeg;base64," . base64_encode(file_get_contents($request->url));
    return $result;
});

Route::post('/store_picto', function (Request $request) {
    $picto = $request->picto_url;
    $picto = base64_decode($picto);
    $file_name = date("Ymd-His") . "-" . ($request->user_id) . ".png";
    Storage::disk('public_uploads')->put($file_name, $picto);
    return 'img/picto_img/'.$file_name ;
});



use App\Events\AttackEvent;
use App\Events\RoomCreated;
use App\Events\Player2Joined;

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
    $player1 = $room->users->first();
    $player2 = User::find($request->user_id);
    
    event(new Player2Joined($room, $player1, $player2));

    return $room;
});

Route::post('share_battle_info', function(Request $request) {
    
    event(new ShareBattleInfo($request->battle_info, $request->room_id));

    return $request;
});
