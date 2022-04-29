<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Abonnement;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class TrendsController extends Controller
{
    public function trends(Request $request) {
        if(isset($request->post)){
            $isPost = $request->post;
        }else{
            $isPost = false;
        }
        $user = Auth::id();
        $usersabonnement = Abonnement::select('abonnement')->where('abonne', $user)->get();
        $displayPost = [];
        $abonnementLikedPost = [];
        foreach($usersabonnement as $userAbonnement)
        {   
            $userabo = User::find($userAbonnement->abonnement);
            $likes = Like::where('id_user', $userabo->id)->get();

            foreach($likes as $likedpost)
            {
                $liked=Post::where('id', $likedpost->id_post)-> first();
                $userliked=User::find($liked->id_user);
                if(isset($liked->post_media[0])){
                    $path = $liked->post_media[0]->medium->path;
                }else{
                    $path = null;
                }
                $cLike = 0;
                foreach($liked->likes as $like){
                    $cLike++;
                }
                array_push($abonnementLikedPost, ["idPost" => $liked->id, "user" => $userliked->pseudo ,"id" => $userabo->id,"text" => $liked->text, "like" => $cLike, "path" => $path, "postedAt" => $liked->posterA->toDateTimeString(), "imgP" => $userabo->medium->path]);

            }
            foreach($userabo->posts as $post){
                if(isset($post->post_media[0])){
                    $path = $post->post_media[0]->medium->path;
                }else{
                    $path = null;
                }
                $cLike = 0;
                foreach($post->likes as $like){
                    $cLike++;
                }
                array_push($displayPost, ["idPost" => $post->id,"user" => $userabo->pseudo ,"id" => $userabo->id,"text" => $post->text, "like" => $cLike, "path" => $path, "postedAt" => $post->posterA->toDateTimeString(), "imgP" => $userabo->medium->path]);
            }
        }
        $allPost = array_unique(array_merge($abonnementLikedPost, $displayPost), SORT_REGULAR);
        usort($allPost, function ($item1, $item2) {
            return $item2['postedAt'] <=> $item1['postedAt'];
        });
        return view('main.trends', ['isPost' => $isPost, 'posts' => $allPost]);
    }
}
