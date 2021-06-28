@extends('layouts.default')
@section('title','Category.create')
@include('layouts.menu.admin')
@section('content')
<h1 class="page-header">カテゴリ新規登録</h1>
@if(count($errors)>0)
<ul class="alert alert-danger" role="alert">
@foreach($errors->all() as $error)
	<li>{{$error}}</li>
@endforeach
</ul>
@endif
<form action="{{route('admin.category.store')}}" method="post">
@csrf
<div class="form-group">
	<label for="name">カテゴリ名</label>
	<input class="form-control" type="text" name="name" value="{{old('name')}}" required>
</div>
<input type="submit" class="btn btn-primary" value="登録">
</form>
@endsection