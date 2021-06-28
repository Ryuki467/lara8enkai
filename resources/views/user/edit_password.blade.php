@extends('layouts.default')
@section('title', 'User.editPassword')
@include('layouts.menu.admin')
@section('content')
<h1 class="page-header">ユーザ編集</h1>
<form action="{{route('admin.user.update.password')}}" method="post">
@method('PUT')
@csrf
<div class="form-group row">
	<label for="password" class="col-md-4 col-form-label text-md-right">{{__('現在のパスワード')}}</label>
	<div class="col-md-6">
		<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="current_password" required>
		@error('current_password')
			<span class="invalid-feedback" role="alert">
				<strong>{{$message}}</strong>
			</span>
		@enderror
	</div>
</div>
<div class="form-group row">
	<label for="password" class="col-md-4 col-form-label text-md-right">{{__('新しいパスワード')}}</label>
	<div class="col-md-6">
		<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
		@error('password')
			<span class="invalid-feedback" role="alert">
				<strong>{{$message}}</strong>
			</span>
		@enderror
	</div>
</div>
<div class="form-group row">
	<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{__('新しいパスワード（確認）')}}</label>
	<div class="col-md-6">
		<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
	</div>
</div>
<div class="form-group row mb-0">
	<div class="col-md-6 offset-md-4">
		<button type="submit" class="btn btn-primary">{{__('更新')}}</button>
	</div>
</div>
</form>
@endsection