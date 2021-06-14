<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller{
    function __construct(){
        $this->middleware('auth');
    }
    
    function index(){
        $events = event::with(['EventUser'])->sortable()->simplePaginate(5);
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
            $request->session()->flash('success', __('顧客を新規登録しました'));
        }else{
            $request->session()->flash('error', __('顧客の新規登録に失敗しました'));
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
        $event->name = $request->input('name');
        if($event->save()){
            $request->session()->flash('success', __('商品を更新しました'));
        }else{
            $request->session()->flash('error', __('商品の更新に失敗しました'));
        }
        
        return redirect()->route('admin.event.index');
    }
}
