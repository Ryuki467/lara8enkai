@extends('layouts.default')
@section('title', 'User.edit')
@include('layouts.menu.admin')
@section('content')
<h1 class="page-header">ユーザ編集</h1>
@if(session('success'))
<div class="alert alert-success" role="alert">{{session('success')}}</div>
@endif
<form action="{{route('admin.user.update')}}" method="post">
@method('PUT')
@csrf
<div class="form-group row">
	<label for="name" class="col-md-4 col-form-label text-md-right">{{__('Name')}}</label>
	<div class="col-md-6">
		<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name',$user->name)}}" required autocomplete="name" autofocus>
		@error('name')
			<span class="invalid-feedback" role="alert">
				<strong>{{$message}}</strong>
			</span>
		@enderror
	</div>
</div>
<div class="form-group row">
	<label for="email" class="col-md-4 col-form-label text-md-right">{{__('E-MailAddress')}}</label>
	<div class="col-md-6">
		<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email',$user->email)}}" required autocomplete="email" autofocus>
		@error('email')
			<span class="invalid-feedback" role="alert">
				<strong>{{$message}}</strong>
			</span>
		@enderror
	</div>
</div>
<div class="form-group row">
	<div class="col-md-6 offset-md-4">
		<button type="button" class="btn btn-light"><a href="{{route('admin.user.edit.password')}}">{{__('パスワード変更')}}</a></button>
	</div>
</div>
<div class="form-group row mb-0">
	<div class="col-md-6 offset-md-4">
		<button type="submit" class="btn btn-primary">{{__('更新')}}</button>
	</div>
</div>
</form>
@endsection