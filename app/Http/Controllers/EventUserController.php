<?php

namespace App\Http\Controllers;

use App\Models\EventUser;
use Illuminate\Http\Request;

class EventUserController extends Controller{
    function __construct(){
        $this->middleware('auth');
    }
    
    function store(Request $request){
        $this->validate($request, eventuser::$rules);
        $eventuser = new eventuser([
            'event_id' => $request->input('event_id'),
            'user_id' => $request->input('user_id'),
        ]);
        if($eventuser->save()){
            $request->session()->flash('success', __('イベントに参加しました'));
        }else{
            $request->session()->flash('error', __('イベント参加に失敗しました'));
        }
        
        return redirect()->route('admin.event.index');
    }
}
