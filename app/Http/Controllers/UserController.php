<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Medium;
use App\Models\PostMedia;
use App\Models\Post;

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
        return view('main.users.posted',['user' => $request->pseudo, 'posts' => $displayPost]);
    }
    public function comments(Request $request){
        return view('main.users.comments',['user' => $request->pseudo]);
    }
    public function liked(Request $request){
        return view('main.users.liked',['user' => $request->pseudo]);
    }
}
