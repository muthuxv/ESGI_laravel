<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RechercheController extends Controller
{
    public function main(Request $request){
        if(!is_null($request->search)){
            $user = \DB::select('SELECT * from users WHERE pseudo LIKE ?', [$request->search]);
        }
        return view('main.recherche.recherche', ["user" => $user]);
    }
}
