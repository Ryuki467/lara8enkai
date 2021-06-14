<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Event;
use Illuminate\Http\Request;

class ChatController extends Controller{
    function __construct(){
        $this->middleware('auth');
    }
    
    public function talk($id){
        $event = Event::find($id);
        $chats = Chat::all();
        return view('chat.talk',compact('event','chats'));
    }
    
    function store(Request $request, $id){
        $request->merge(['event_id' => $id]);
        $this->validate($request,Chat::$rules);
        $chat = new chat([
            'user_id' => $request->input('user_id'),
            'event_id' => $id,
            'body' => $request->input('body'),
        ]);
        if($chat->save()){
            $request->session()->flash('success', __('投稿しました'));
        }else{
            $request->session()->flash('error', __('投稿に失敗しました'));
        }
        
        return redirect()->route('admin.event.index');
    }
}
