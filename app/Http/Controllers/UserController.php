<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Medium;
use App\Models\PostMedia;
use App\Models\Post;
use App\Models\Abonnement;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function posted(Request $request){
        $user = User::where('pseudo', $request->pseudo)->first();
        $displayPost = [];
        foreach($user->posts as $post){
            if(isset($post->post_media[0])){
                $path = $post->post_media[0]->medium->path;
            }else{
                $path = null;
            }
            array_push($displayPost, ["idPost" => $post->id,"id" => $user->id,"text" => $post->text, "path" => $path, "postedAt" => $post->posterA->toDateTimeString(), "imgP" => $user->medium->path]);
        }
        usort($displayPost, function ($item1, $item2) {
            return $item2['postedAt'] <=> $item1['postedAt'];
        });
        $id = Auth::id();
        $user = User::where('pseudo', $request->pseudo)-> first();
        $isfollowing = Abonnement::where('abonne', $id)->where('abonnement', $user->id)->exists();
        $nbabonnement = Abonnement::where('abonne', $user->id)->count();
        $nbabonne = Abonnement::where('abonnement', $user->id)->count();
        return view('main.users.posted',['user' => $request->pseudo, 'posts' => $displayPost, 'isfollowing' => $isfollowing, 'id'=> $id, 'nbabonnement' => $nbabonnement, 'nbabonne' => $nbabonne]);
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

    public function getAbonnements(Request $request)
    {
        $user = User::where('pseudo', $request->pseudo)-> first();
        $displayAbonnements = [];
        $abonnements = Abonnement::where('abonne', $user->id)->get();
        
        foreach($abonnements as $abonnement)
        {
            $userabonnement = User::where('id', $abonnement->abonnement)-> first();
            array_push($displayAbonnements, ["pseudo" => $userabonnement->pseudo]);
        }

        return view('main.users.abonnementList', ['user' => $user->pseudo, 'abonnements' => $displayAbonnements]);
    }

    public function getAbonnes(Request $request)
    {
        $user = User::where('pseudo', $request->pseudo)-> first();
        $displayAbonnes = [];
        $abonnes = Abonnement::where('abonnement', $user->id)->get();
        
        foreach($abonnes as $abonne)
        {
            $userabonne = User::where('id', $abonne->abonne)-> first();
            array_push($displayAbonnes, ["pseudo" => $userabonne->pseudo]);
        }

        return view('main.users.abonneList', ['user' => $user->pseudo, 'abonnes' => $displayAbonnes]);
    }
}
