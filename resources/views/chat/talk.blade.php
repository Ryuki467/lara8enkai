@extends('layouts.default')
@section('title','chat.talk')
@include('layouts.menu.admin')
@section('content')
@if (session('success'))
<div class="alert alert-success" role="alert">{{session('success')}}</div>
@endif
<h1 class="page-header">{{$event->name}}</h1>
@foreach($event->chat as $chat)
    @if(Auth::user()->id == $chat->user_id)
    	<div class="bg-success" style="color: white; border-radius:10px; width:50%; padding:10px; margin-left: 50%;">
        		{{$chat->user->name}}<br>
        		{{$chat->body}}<br>
        		{{$chat->created_at->format('Y年m月d日H時i分')}}
    	</div><br>
    @else
    	<div class="bg-white" style="border-radius:10px; width:50%; padding:10px;">
    		{{$chat->user->name}}<br>
    		{{$chat->body}}<br>
    		{{$chat->created_at->format('Y年m月d日H時i分')}}
    	</div><br>
    @endif
@endforeach
<form action="{{route('admin.chat.store',$event->id)}}" method="post">
@csrf
<div style="border:solid 1px #DDDDDD; border-radius:10px;">
    <div class="form-group">
    	<div style="background-color: #FFFFBB; height: 40px;">投稿</div>
    	<div style="padding:10px; background-color: white;">
    		<label for="body">投稿</label>
        	<textarea id="textarea" class="form-control" name="body" required>{{old('body')}}</textarea><br>
        	<input type="submit" class="btn btn-secondary" style="background-color: #FFFFBB; color:black;" value="投稿">
    	</div>
		<input class="form-control" type="hidden" name="user_id" value="{{Auth::user()->id}}" required>
    </div>
</div>
</form>

@endsection