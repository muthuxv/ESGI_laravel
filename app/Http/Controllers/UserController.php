<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function posted(Request $request){
        return view('main.users.posted',['user' => $request->pseudo]);
    }
    public function comments(Request $request){
        return view('main.users.comments',['user' => $request->pseudo]);
    }
    public function liked(Request $request){
        return view('main.users.liked',['user' => $request->pseudo]);
    }
}
