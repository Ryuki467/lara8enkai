<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller{
    function __construct(){
        $this->middleware('auth');
    }
    
    public function talk(Request $request,$id){
        $event = Event::find($id);
        $chats = Chat::all();
        $eventusers = EventUser::all();
        $join_flg = true;
        foreach($eventusers as $e){
            if($e->event_id == $id){
                if(Auth::id() == $e->user_id) $join_flg = false;
            }
        }
        if($join_flg){
            $request->session()->flash('error', __('イベントに参加していません'));
            return redirect()->route('admin.event.show',$id);
        }
        return view('chat.talk',compact('event','chats'));
    }
    
    function store(Request $request, $id){
        $request->merge(['event_id' => $id]);
        $this->validate($request,Chat::$rules);
        $eventusers = EventUser::all();
        $join_flg = true;
        foreach($eventusers as $e){
            if($e->event_id == $id){
                if(Auth::id() == $e->user_id) $join_flg = false;
            }
        }
        if(empty(Event::find($id))){
            $request->session()->flash('error', __('投稿に失敗しました'));
            return redirect()->route('home');
        }else if($join_flg){
            $request->session()->flash('error', __('投稿に失敗しました'));
            return redirect()->route('home');
        }
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
        
        return redirect()->route('admin.chat.talk',$id);
    }
}
