<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $events = event::with(['EventUser'])->sortable()->simplePaginate(5);
        return view('home', compact('events'));
    }
    
    public function show($id){
        $event = Event::find($id);
        return view('event.show',compact('event'));
    }
}
