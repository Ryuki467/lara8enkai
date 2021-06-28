@extends('layouts.default')
@section('title','event.edit')
@include('layouts.menu.admin')
@section('content')
<h1 class="page-header">イベント編集</h1>
@if(count($errors)>0)
<ul class="alert alert-danger" role="alert">
@foreach($errors->all() as $error)
	<li>{{$error}}</li>
@endforeach
</ul>
@endif
<form action="{{route('admin.event.update',$event->id)}}" method="post">
@method('PUT')
@csrf
<div class="form-group">
	<label for="name">イベント名</label>
	<input class="form-control" type="text" name="name" value="{{old('name',$event->name)}}" required>
</div>
<div class="form-group">
	<label for="detail">イベント概要</label>
	<textarea id="textarea" class="form-control" name="detail" required>{{old('detail',$event->detail)}}</textarea>
</div>
<div class="form-group">
	<label for="max_participant">最大参加者数</label>
	<input class="form-control" type="text" name="max_participant" value="{{old('max_participant',$event->max_participant)}}" required>
</div>
<div class="form-group">
	<label for="category">カテゴリ</label>
	<select class="form-control" id="category" name="category_id" required>
@foreach($categories as $category)
	<option value="{{$category->id}}">{{$category->name}}</option>
@endforeach
	</select>
</div>
<div class="form-group">
	<label for="user">ユーザ</label>
	<select class="form-control" id="user" name="user_id" required>
@foreach($users as $user)
	<option value="{{$user->id}}">{{$user->name}}</option>
@endforeach
	</select>
</div>
<div class="form-group">
	<input class="form-control" type="hidden" name="my_id" value="{{Auth::user()->id}}" required>
</div>
<input type="submit" class="btn btn-primary" value="更新">
</form>
@endsection