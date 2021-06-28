<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventUserController extends Controller{
    function __construct(){
        $this->middleware('auth');
    }
    
    function store(Request $request,$id){
        $this->validate($request, eventuser::$rules);
        $eventusers = EventUser::all();
        $event = event::find($id);
        $join_flg = false;
        foreach($eventusers as $e){
            if($e->event_id == $id){
                if(Auth::id() == $e->user_id) $join_flg = true;
            }
        }
        if($join_flg){
            $request->session()->flash('error', __('イベントに参加済みです'));
            return redirect()->route('admin.event.show',$id);
        }else if(count($eventusers->where('event_id',$id)) >= $event->max_participant){
            $request->session()->flash('error', __('最大参加者数に到達しています'));
            return redirect()->route('admin.event.show',$id);
        }
        $eventuser = new eventuser([
            'event_id' => $request->input('event_id'),
            'user_id' => $request->input('user_id'),
        ]);
        if($eventuser->save()){
            $request->session()->flash('success', __('イベントに参加しました'));
        }else{
            $request->session()->flash('error', __('イベントの参加に失敗しました'));
        }
        
        return redirect()->route('admin.event.show',$id);
    }
    
    function destroy(Request $request){
        $eventuser = new EventUser;
        if($eventuser->where("event_id",$request->input('event_id'))->where("user_id",$request->input('user_id'))->delete()){
            $request->session()->flash('success', __('イベントから辞退しました'));
        }else{
            $request->session()->flash('error', __('イベントの辞退に失敗しました'));
        }
        
        return redirect()->route('admin.event.show',$request->input('event_id'));
    }
}
