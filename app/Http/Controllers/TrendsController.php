<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TrendsController extends Controller
{
    public function trends(Request $request) {
        if(isset($request->post)){
            $isPost = $request->post;
        }else{
            $isPost = false;
        }
        $users = User::all();
        return view('main.trends', ['isPost' => $isPost, 'users' => $users]);
    }
}
