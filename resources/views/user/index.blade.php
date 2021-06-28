@extends('layouts.default')
@section('title','User.index')
@include('layouts.menu.admin')
@section('content')
@if (session('success'))
<div class="alert alert-success" role="alert">{{session('success')}}</div>
@endif
<h1 class="page-header">ユーザ一覧</h1>
<table class="table table-striped" cellpadding="0" cellspacing="0">
<tr>
	<th scope="col">{{__('id')}}</th>
	<th scope="col">{{__('name')}}</th>
	<th scope="col">{{__('email')}}</th>
	<th scope="col">{{__('created_at')}}</th>
	<th scope="col">{{__('updated_at')}}</th>
</tr>
@foreach($users as $user)
<tr>
	<td>{{$user->id}}</td>
	<td>{{$user->name}}</td>
	<td>{{$user->email}}</td>
	<td>{{$user->created_at->format('Y年m月d日H時i分')}}</td>
	<td>{{$user->updated_at->format('Y年m月d日H時i分')}}</td>
</tr>
@endforeach
</table>
<div class="paginator">
	<ul class="pagination justify-content-center">
		{{$users->links()}}
	</ul>
</div>
@endsection