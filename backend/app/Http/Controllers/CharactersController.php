<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;
use Validator;

class CharactersController extends Controller
{
    //キャラテーブル挿入
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
            'hp' => 'required',
            'ap' => 'required',
            'dp' => 'required',
            'thumnailURL' => 'required',
            'pictoURL' => 'required'
        ]);
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/create_characters')
                ->withInput()
                ->withErrors($validator);
        }
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
    }
}
