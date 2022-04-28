<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Abonnement;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function posted(Request $request){
        $id = Auth::id();
        $user = User::where('pseudo', $request->pseudo)-> first();
        $isfollowing = Abonnement::where('abonne', $id)->where('abonnement', $user->id)->exists();
        $nbabonnement = Abonnement::where('abonne', $user->id)->count();
        $nbabonne = Abonnement::where('abonnement', $user->id)->count();
        return view('main.users.posted',['user' => $request->pseudo, 'isfollowing' => $isfollowing, 'id'=> $id, 'nbabonnement' => $nbabonnement, 'nbabonne' => $nbabonne]);
    }
    public function comments(Request $request){
        $id = Auth::id();
        $user = User::where('pseudo', $request->pseudo)-> first();
        $isfollowing = Abonnement::where('abonne', $id)->where('abonnement', $user->id)->exists();
        $nbabonnement = Abonnement::where('abonne', $user->id)->count();
        $nbabonne = Abonnement::where('abonnement', $user->id)->count();
        return view('main.users.comments',['user' => $request->pseudo, 'isfollowing' => $isfollowing, 'id'=> $id, 'nbabonnement' => $nbabonnement, 'nbabonne' => $nbabonne]);
    }
    public function liked(Request $request){
        $id = Auth::id();
        $user = User::where('pseudo', $request->pseudo)-> first();
        $isfollowing = Abonnement::where('abonne', $id)->where('abonnement', $user->id)->exists();
        $nbabonnement = Abonnement::where('abonne', $user->id)->count();
        $nbabonne = Abonnement::where('abonnement', $user->id)->count();
        return view('main.users.liked',['user' => $request->pseudo, 'isfollowing' => $isfollowing, 'id'=> $id, 'nbabonnement' => $nbabonnement, 'nbabonne' => $nbabonne]);
    }

    public function follow(Request $request)
    {
        
        $user = User::where('pseudo', $request->pseudo)-> first();

        if($user->id == Auth::id())
        {
            abort(404);
        }
        $abonnement = New Abonnement;
        $abonnement->abonnement = $user->id;
        $abonnement->abonne = Auth::id();
        
        $abonnement->save();
        return redirect(route('user', $user->pseudo))->with('msg', 'Vous suivez ' . $user->pseudo . ' maintenant !');
    }

    public function unfollow(Request $request)
    {
        $user = User::where('pseudo', $request->pseudo)-> first();
        $user_id = $user->id;

        Abonnement::where('abonne', Auth::id())->where('abonnement', $user_id)->delete();
        return redirect(route('user', $user->pseudo));
    }
}
