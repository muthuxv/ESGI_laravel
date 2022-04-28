<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Medium;
use App\Models\PostMedia;
use App\Models\Post;
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
}
