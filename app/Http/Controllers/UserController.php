<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Medium;
use App\Models\PostMedia;
use App\Models\Post;
use App\Models\Abonnement;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            $cLike = 0;
            foreach($post->likes as $like){
                $cLike++;
            }
            array_push($displayPost, ["idPost" => $post->id,"like" => $cLike,"id" => $user->id,"text" => $post->text, "path" => $path, "postedAt" => $post->posterA->toDateTimeString(), "imgP" => $user->medium->path]);
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

        $userSend = User::where("pseudo", $request->pseudo)->first();
        $comments = $userSend->commentaires;
        $displayComments = [];
        foreach($comments as $comment){
            $tbl = ["idCom" => $comment->id,"text" => $comment->texte, "sendAt" => $comment->posterA, "id" => $userSend->id , "pseudo" => $userSend->pseudo, "path" => $userSend->medium->path];
            array_push($displayComments, $tbl);
        }

        return view('main.users.comments',['comments' => $displayComments, 'user' => $request->pseudo, 'isfollowing' => $isfollowing, 'id'=> $id, 'nbabonnement' => $nbabonnement, 'nbabonne' => $nbabonne]);
    }
    public function liked(Request $request){
        $user = User::where("pseudo", $request->pseudo)->first();
        $displayPost = [];
        foreach($user->likes as $like){
            $post = Post::find($like->id_post);
            if(isset($post->post_media[0])){
                $path = $post->post_media[0]->medium->path;
            }else{
                $path = null;
            }
            $cLike = 0;
            foreach($post->likes as $like){
                $cLike++;
            }
            array_push($displayPost, ["idPost" => $post->id,"like" => $cLike,"id" => $user->id,"text" => $post->text, "path" => $path, "postedAt" => $post->posterA->toDateTimeString(), "imgP" => $user->medium->path]);
        }
        usort($displayPost, function ($item1, $item2) {
            return $item2['postedAt'] <=> $item1['postedAt'];
        });
        $id = Auth::id();
        $user = User::where('pseudo', $request->pseudo)-> first();
        $isfollowing = Abonnement::where('abonne', $id)->where('abonnement', $user->id)->exists();
        $nbabonnement = Abonnement::where('abonne', $user->id)->count();
        $nbabonne = Abonnement::where('abonnement', $user->id)->count();


        return view('main.users.liked',['user' => $request->pseudo, 'posts' => $displayPost, 'isfollowing' => $isfollowing, 'id'=> $id, 'nbabonnement' => $nbabonnement, 'nbabonne' => $nbabonne]);
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

    public function profile(){
        $user = User::find(Auth::id());
        return view('main.users.profile',["user" => $user]);
    }

    public function changeProfile(Request $request){
        $request->validate([
            'profile' => ['required', 'mimes:jpg,jpeg,png,gif'],
        ]);
        $user = User::find(Auth::id());
        $path = Storage::disk('publicUser')->put('users/' . $user->pseudo, $request->profile);
        /*Ajout du média dans la base*/
        $media = new Medium;
        $media->path = $path;
        $media->save();
        $user->id_media = $media->id;
        $user->save();
        return redirect(route('profile'));
    }
}
