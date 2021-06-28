<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\User;
use App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller{
    function __construct(){
        $this->middleware('auth');
    }
    
    function index(){
        $events = event::with(['EventUser'])->where("user_id",Auth::id())->sortable()->simplePaginate(5);
        return view('event.index', compact('events'));
    }
    
    function create(){
        $categories = Category::all();
        $users = User::all();
        return view('event.create',compact('categories','users'));
    }
    
    function store(Request $request){
        $this->validate($request, event::$rules);
        $event = new event([
            'name' => $request->input('name'),
            'detail' => $request->input('detail'),
            'max_participant' => $request->input('max_participant'),
            'category_id' => $request->input('category_id'),
            'user_id' => $request->input('user_id'),
        ]);
        if($event->save()){
            $request->session()->flash('success', __('イベントを新規登録しました'));
        }else{
            $request->session()->flash('error', __('イベントの新規登録に失敗しました'));
        }
        
        return redirect()->route('admin.event.index');
    }
    
    public function show($id){
        $event = Event::find($id);
        return view('event.show',compact('event'));
    }
    
    function edit($id){
        $event = event::find($id);
        $categories = Category::all();
        $users = User::all();
        return view('event.edit',compact('event','categories','users'));
    }
    
    function update(Request $request, $id){
        $this->validate($request, event::$rules);
        $event = event::find($id);
        if($event->user_id != $request->input('my_id')){
            $request->session()->flash('error', __('管理しているイベントのみが編集可能です'));
            return redirect()->route('admin.event.index');
        }else if(count($event->eventuser) > $request->input('max_participant')){
            $request->session()->flash('error', __('現在の参加者数よりも少なくすることはできません'));
            return redirect()->route('admin.event.index');
        }
        $event->name = $request->input('name');
        $event->detail = $request->input('detail');
        $event->max_participant = $request->input('max_participant');
        $event->category_id = $request->input('category_id');
        $event->user_id = $request->input('user_id');
        if($event->save()){
            $request->session()->flash('success', __('イベントを更新しました'));
        }else{
            $request->session()->flash('error', __('イベントの更新に失敗しました'));
        }
        
        return redirect()->route('admin.event.index');
    }
    
    function destroy(Request $request, $id){
        $event = event::find($id);
        if($event->user_id != Auth::id()){
            $request->session()->flash('error', __('管理しているイベントのみが削除可能です'));
            return redirect()->route('admin.event.index');
        }else if(count($event->eventuser) != 0){
            $request->session()->flash('error', __('参加者のいるイベントは削除できません'));
            return redirect()->route('admin.event.index');
        }
        $event = new Event;
        if($event->destroy($id)){
            $request->session()->flash('success', __('イベントを削除しました'));
        }else{
            $request->session()->flash('error', __('イベントの削除に失敗しました'));
        }
        
        return redirect()->route('admin.event.index');
    }
}
