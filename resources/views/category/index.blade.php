@extends('layouts.default')
@section('title','Category.index')
@include('layouts.menu.admin')
@section('content')
@if (session('success'))
<div class="alert alert-success" role="alert">{{session('success')}}</div>
@elseif(session('error'))
<div class="alert alert-danger" role="alert">{{session('error')}}</div>
@endif
<h1 class="page-header">カテゴリ一覧</h1>
<table class="table table-striped" cellpadding="0" cellspacing="0">
<tr>
	<th scope="col">{{__('ID')}}</th>
	<th scope="col">{{__('カテゴリ名')}}</th>
	<th scope="col">{{__('最終更新時刻')}}</th>
	<th scope="col">アクション</th>
</tr>
@foreach($categories as $category)
<tr>
	<td>{{$category->id}}</td>
	<td>{{$category->name}}</td>
	<td>{{$category->updated_at->format('Y年m月d日H時i分')}}</td>
	<td class="actions text-nowrap">
		<a class="btn btn-primary" href="{{route('admin.category.edit',$category->id)}}">編集</a>
        <a class="btn" style="color:white; background-color: red; border-color: red;" href="{{route('admin.category.destroy',$category->id)}}">削除</a>
    </td>
</tr>
@endforeach
</table>
<div class="paginator">
	<ul class="pagination justify-content-center">
		{{$categories->links()}}
	</ul>
</div>
@endsection