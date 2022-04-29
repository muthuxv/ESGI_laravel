<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Medium;
use App\Models\PostMedia;
use App\Models\Post;
use App\Models\Commentaire;
use App\Models\Like;
use Carbon\Carbon;

class PostController extends Controller
{
    public function create(){
        return view('main.post.create');
    }
    public function validCreate(Request $request){
        $request->validate([
            'text' => ['required', 'string', 'max:255'],
            'filesPost' => ['mimes:jpg,jpeg,png,gif,mp4,mp3'],
        ]);
        /*AJout du post en base*/
        $mytime = Carbon::now();
        $post = new Post;
        $post->text = $request->text;
        $post->posterA = $mytime->toDateTimeString();
        $post->id_user = Auth::id();
        $post->save();
        if(!is_null($request->filesPost)){
            /* ajout du fichier sur le serv*/ 
            $user = User::find(Auth::id());
            $path = Storage::disk('publicUser')->put('users/' . $user->pseudo, $request->filesPost);
            /*Ajout du média dans la base*/
            $media = new Medium;
            $media->path = $path;
            $media->save();
            /*Ajout postmedia en base*/
            $PostMedia = new PostMedia;
            $PostMedia->id_post = $post->id;
            $PostMedia->id_media = $media->id;
            $PostMedia->save();    
        }

        return redirect()->route('trends', ['post' => 1]);
    }
    public function delete(Request $request){
        $post = Post::find($request->id);
        if($post->id_user != Auth::id()){
            abort(404);
        }
        $postMedia = PostMedia::where('id_post',$post->id)->first();
        if(!is_null($postMedia)){
            \DB::delete('DELETE from PostMedia WHERE id_post = ?', [$post->id]);
        }
        $post->delete();
        return redirect()->route('trends', ['post' => 2]);
    }
    public function post(Request $request){
        $post = Post::find($request->id);
        if(is_null($post)){
            abort(404);
        }
        $user = User::find($post->id_user);
        $comments = $post->commentaires;
        $displayComments = [];
        foreach($comments as $comment){
            $send = User::find($comment->id_user);
            $tbl = ["idCom" => $comment->id,"text" => $comment->texte, "sendAt" => $comment->posterA, "id" => $send->id , "pseudo" => $send->pseudo, "path" => $user->medium->path];
            array_push($displayComments, $tbl);
        }
        if(isset($post->post_media[0])){
            $path = $post->post_media[0]->medium->path;
        }else{
            $path = null;
        }
        $displayPost = ["idPost" => $post->id,"id" => $user->id,"text" => $post->text, "path" => $path, "postedAt" => $post->posterA->toDateTimeString(), "imgP" => $user->medium->path];
        
        return view('main.post.post', ['user' => $user->pseudo,'id' => $request->id, 'post' => $displayPost,"comments" => $displayComments]);
    }
    public function comment(Request $request){
        $mytime = Carbon::now();
        $comment = new Commentaire;
        $comment->texte = $request->text;
        $comment->posterA = $mytime->toDateTimeString();
        $comment->id_post = $request->id;
        $comment->id_user = Auth::id();
        $comment->save();

        return redirect()->route('post', ['id' => $request->id]);
    }

    public function deleteCom(Request $request){
        $comment = Commentaire::find($request->id);
        if($comment->id_user != Auth::id()){
            abort(404);
        }
        $id = $comment->id_post;
        $comment->delete();
        return redirect()->route('post', ['id' => $id]);
    }

    public function like(Request $request){
        $like = Like::where('id_user', Auth::id())->where('id_post', $request->id)->first();
        $post = Post::find($request->id);
        if(is_null($like)){
            $like = new Like;
            $like->id_post = $request->id;
            $like->id_user = Auth::id();
            $like->save();
        }else{
            \DB::delete('DELETE from `Like` WHERE id_user = ? AND id_post = ?', [Auth::id(), $request->id]);
        }
        return redirect()->route('user', ['pseudo' => $post->user->pseudo]);
    }
}
