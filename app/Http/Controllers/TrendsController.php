<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Abonnement;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class TrendsController extends Controller
{
    public function trends(Request $request) {
        if(isset($request->post)){
            $isPost = $request->post;
        }else{
            $isPost = false;
        }
<<<<<<< HEAD
        $users = User::all();
        return view('main.trends', ['isPost' => $isPost, 'users' => $users]);
=======
        $user = Auth::id();
        $usersabonnement = Abonnement::select('abonnement')->where('abonne', $user)->get();
        $displayPost = [];
        foreach($usersabonnement as $userAbonnement)
        {   
            $userabo = User::find($userAbonnement->abonnement);
            foreach($userabo->posts as $post){
                if(isset($post->post_media[0])){
                    $path = $post->post_media[0]->medium->path;
                }else{
                    $path = null;
                }
                array_push($displayPost, ["idPost" => $post->id,"user" => $userabo->pseudo ,"id" => $userabo->id,"text" => $post->text, "path" => $path, "postedAt" => $post->posterA->toDateTimeString(), "imgP" => $userabo->medium->path]);
            }
        }
        usort($displayPost, function ($item1, $item2) {
            return $item2['postedAt'] <=> $item1['postedAt'];
        });
        return view('main.trends', ['isPost' => $isPost, 'posts' => $displayPost]);
>>>>>>> 7799567c5f1099bc658c52ee4841717866fd0653
    }
}
