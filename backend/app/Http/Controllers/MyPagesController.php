<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPagesController extends Controller
{
    //mypage
    public function mypage(){
        return view('mypage');
    }
}
