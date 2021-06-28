@extends('layouts.default')

@section('title','Home.index')

@include('layouts.menu.admin')

@section('content')
@if (session('success'))
<div class="alert alert-success" role="alert">{{session('success')}}</div>
@elseif(session('error'))
<div class="alert alert-danger" role="alert">{{session('error')}}</div>
@endif
<h1 class="page-header">イベント一覧</h1>
<table class="table table-striped" cellpadding="0" cellspacing="0">
<tr>
	<th scope="col">{{__('ID')}}</th>
	<th scope="col">{{__('イベント名')}}</th>
	<th scope="col">{{__('最大参加人数')}}</th>
	<th scope="col">{{__('現在の参加者数')}}</th>
	<th scope="col">{{__('詳細')}}</th>
	<th scope="col">{{__('カテゴリ')}}</th>
	<th scope="col">{{__('主催ユーザ名')}}</th>
	<th scope="col">{{__('最終更新時刻')}}</th>
	<th scope="col">アクション</th>
</tr>
@foreach($events as $event)
<tr>
	<td>{{$event->id}}</td>
	<td>{{$event->name}}</td>
	<td>{{$event->max_participant}}</td>
	<td>{{count($event->eventuser)}}</td>
	<td>{{$event->detail}}</td>
	<td>{{$event->category->name}}</td>
	<td>{{$event->user->name}}</td>
	<td>{{$event->updated_at->format('Y年m月d日H時i分')}}</td>
@if(isset(Auth::user()->name))
	<td class="actions text-nowrap">
		<a class="btn btn-primary" href="{{route('admin.event.show',$event->id)}}">表示</a>
    </td>
@else
	<td class="actions text-nowrap">
		<a class="btn btn-primary" href="{{route('show',$event->id)}}">表示</a>
    </td>
@endif
</tr>
@endforeach
</table>
<div class="paginator">
	<ul class="pagination justify-content-center">
		{{$events->links()}}
	</ul>
</div>
@endsection