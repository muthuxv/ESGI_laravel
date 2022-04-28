<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrendsController extends Controller
{
    public function trends(Request $request) {
        if(isset($request->post)){
            $isPost = $request->post;
        }else{
            $isPost = false;
        }
        return view('main.trends', ['isPost' => $isPost]);
    }
}
