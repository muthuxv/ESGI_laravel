<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RechercheController extends Controller
{
    public function main(Request $request){
        $user = null;
        if(!is_null($request->search)){
            $user = User::orWhere('pseudo', 'like', '%' . $request->search . '%')->get();
        }
        return view('main.recherche.recherche', ["user" => $user]);
    }
}
