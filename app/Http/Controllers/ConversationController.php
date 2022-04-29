<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ConversationController extends Controller
{
    //
    public function conversation(Request $request) {

        $convs = \DB::select('SELECT * from conversation WHERE id_user1 = ? OR id_user2 = ?', [Auth::id(),Auth::id()]);
        $display = [];
        foreach($convs as $conv){
            if($conv->id_user1 == Auth::user()->id){
                $user = User::find($conv->id_user2);
            }else{
                $user = User::find($conv->id_user1);
            }
            $tbl = ["id" => $conv->id, "pseudo" => $user->pseudo, "path" => $user->medium->media];
            array_push($display, $tbl);
        }

        return view('main.conversation',['convs'=>$display]);
        
    }


    public function convUser(Request $request) {
        $user = User::where('pseudo', $request->pseudo)->first();
        $conv = \DB::select('SELECT * from conversation WHERE id_user1 = ? AND id_user2 = ? OR id_user1 = ? AND id_user2 = ?', [Auth::id(),$user->id,$user->id,Auth::id()]);
        if(empty($conv))
        {   
            $conv=new Conversation;
            $conv->id_user1=Auth::id();
            $conv->id_user2=$user->id;
            $conv->save();
        }else{

            $conv = Conversation::find($conv[0]->id);
        }
        
        return redirect()->route('formconv',['id'=>$conv->id]);
        
    }

    public function formconv(Request $request){
    
        $messages = Message::where('id_conversation',$request->id)->get();
       
        //verif si conv existe
        $conv=Conversation::find($request->id);
        if(is_null($conv)){
            abort(404);
        }
        //verif si user est dans la conv
        $conv2 = \DB::select('SELECT * from conversation WHERE id = ? AND id_user1 = ? OR id_user2 = ?', [$request->id, Auth::id(), Auth::id()]);
        if(empty($conv2)){
            abort(404);
        }
        

        return view('main.formconv',['messages'=>$messages,'id'=>$request->id,'conv'=>$conv]);

        
    }

    public function post(Request $request)
    {
        $conversation = Conversation::where('id', $request->id)->first();

        if(is_null($conversation))
        {
            abort(404);
        }

        $message= new Message;
        $message->text=$request->message;
        $message->createAt=Carbon::now()->timestamp;
        $message->id_user=Auth::id();
        $message->id_conversation=$conversation->id;
        $message->save();
        return redirect()->route('formconv',['id'=>$request->id]);
        
    }

    public function newConv(Request $request){

        $messages = Message::where('id_conversation',$request->id)->get();
       
        
        //verif si user est dans la conv
        $conv2 = \DB::select('SELECT * from conversation WHERE id = ? AND id_user1 = ? OR id_user2 = ?', [$request->id, Auth::id(), Auth::id()]);
        if(empty($conv2)){
            abort(404);
        }

        return view('main.formconv',['messages'=>$messages,'id'=>$request->id]);
    }

}
