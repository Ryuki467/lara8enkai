@extends('layouts.default')
@section('title','event.create')
@include('layouts.menu.admin')
@section('content')
<h1 class="page-header">イベント新規登録</h1>
@if(count($errors)>0)
<ul class="alert alert-danger" role="alert">
@foreach($errors->all() as $error)
	<li>{{$error}}</li>
@endforeach
</ul>
@endif
<form action="{{route('admin.event.store')}}" method="post">
@csrf
<div class="form-group">
	<label for="name">イベント名</label>
	<input class="form-control" type="text" name="name" value="{{old('name')}}" required>
</div>
<div class="form-group">
	<label for="detail">イベント概要</label>
	<textarea id="textarea" class="form-control" type="text" name="detail" required>{{old('detail')}}</textarea>
</div>
<div class="form-group">
	<label for="max_participant">最大参加者数</label>
	<input class="form-control" name="max_participant" value="{{old('max_participant')}}" required>
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
	@if($user->id == Auth::user()->id)
		<option value="{{$user->id}}" selected="selected">{{$user->name}}</option>
	@else
		<option value="{{$user->id}}">{{$user->name}}</option>
	@endif
@endforeach
	</select>
</div>
<input type="submit" class="btn btn-primary" value="登録">
</form>
@endsection