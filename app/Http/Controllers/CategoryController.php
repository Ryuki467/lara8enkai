<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller{
    function __construct(){
        $this->middleware('auth');
    }
    
    function index(){
        $categories = Category::sortable()->simplePaginate(5);
        return view('category.index', compact('categories'));
    }
    
    function create(){
        return view('category.create');
    }
    
    function store(Request $request){
        $this->validate($request, Category::$rules);
        $category = new Category([
            'name' => $request->input('name'),
        ]);
        if($category->save()){
            $request->session()->flash('success', __('カテゴリを新規登録しました'));
        }else{
            $request->session()->flash('error', __('カテゴリの新規登録に失敗しました'));
        }
        
        return redirect()->route('admin.category.index');
    }
    
    function edit($id){
        $category = Category::find($id);
        return view('category.edit',compact('category'));
    }
    
    function update(Request $request, $id){
        $this->validate($request, Category::$rules);
        $category = Category::find($id);
        $category->name = $request->input('name');
        if($category->save()){
            $request->session()->flash('success', __('カテゴリを更新しました'));
        }else{
            $request->session()->flash('error', __('カテゴリの更新に失敗しました'));
        }
        
        return redirect()->route('admin.category.index');
    }
    
    function destroy(Request $request, $id){
        $events = Event::all();
        $using_flg = false;
        foreach($events as $event){
            if($id == $event["category_id"]) $using_flg = true;
        }
        if($using_flg){
            $request->session()->flash('error', __('このカテゴリは削除できません'));
            return redirect()->route('admin.category.index');
        }
        $category = new Category;
        if($category->destroy($id)){
            $request->session()->flash('success', __('カテゴリを削除しました'));
        }else{
            $request->session()->flash('error', __('カテゴリの削除に失敗しました'));
        }
        
        return redirect()->route('admin.category.index');
    }
}
