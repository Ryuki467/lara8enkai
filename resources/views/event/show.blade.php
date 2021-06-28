@extends('layouts.default')
@section('title','event.show')
@include('layouts.menu.admin')
@section('content')
@if (session('success'))
<div class="alert alert-success" role="alert">{{session('success')}}</div>
@elseif(session('error'))
<div class="alert alert-danger" role="alert">{{session('error')}}</div>
@endif
<h1 class="page-header">イベント表示</h1>
<table class="table" cellpadding="0" cellspacing="0">
<tr bgcolor="#DDDDDD">
	<th>{{__('ID')}}</th>
	<th>{{__('イベント名')}}</th>
	<th>{{__('最大参加人数')}}</th>
	<th>{{__('現在の参加者数')}}</th>
	<th>{{__('カテゴリ')}}</th>
	<th>{{__('主催ユーザ名')}}</th>
	<th>{{__('最終更新時刻')}}</th>
</tr>
<tr>
	<td>{{$event->id}}</td>
	<td>{{$event->name}}</td>
	<td>{{$event->max_participant}}</td>
	<td>{{count($event->eventuser)}}</td>
	<td>{{$event->category->name}}</td>
	<td>{{$event->user->name}}</td>
	<td>{{$event->updated_at->format('Y年m月d日H時i分')}}</td>
</tr>
</table>

<div style="border:solid; border-color:blue; border-radius:5px; width: 100%; height: 100px;">
<div style="padding:10px; background-color: blue; color:white; height: 50%">現在の参加者</div>
<div style="margin:10px;">{{count($event->eventuser)}}</div>
</div>
<br>
@if(empty(Auth::user()->name))
<div class="text-center">                                
	<a class="btn btn-primary" href="{{route('admin.event.show',$event->id)}}">ログインする</a>
</div>
@endif
@if(isset(Auth::user()->name))
<h3>イベント参加者</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
<tr style="#DDDDDD">
	<th>{{__('id')}}</th>
	<th>{{__('ユーザ名')}}</th>
	<th>{{__('登録日時')}}</th>
</tr>
@if(!empty($event->eventuser))
<?php $Join_flg = false; ?>
@foreach($event->eventuser as $eventuser)
<tr>
	<td>{{$eventuser->user_id}}</td>
	<td>{{$eventuser->user->name}}</td>
	<td>{{$eventuser->created_at}}</td>
</tr>
@if(Auth::user()->id == $eventuser->user_id)
<?php $Join_flg = true; ?>
@endif
@endforeach
</table>
@endif
@if(! $Join_flg)
<form action="{{route('admin.eventuser.store',$event->id)}}" method="post">
@csrf
<div class="form-group">
	<input class="form-control" type="hidden" name="event_id" value="{{$event->id}}" required>
</div>
<div class="form-group">
	<input class="form-control" type="hidden" name="user_id" value="{{Auth::user()->id}}" required>
</div>
<div class="text-center">
<input type="submit" class="btn btn-primary" value="このイベントに参加する">
</div>
</form>
@else                                                   
<div class="text-center" style="display: table; margin: 0 auto;">                                
	<a class="btn btn-primary" style="display: table-cell;" href="{{route('admin.chat.talk',$event->id)}}">チャットに参加する</a>                             
	<form method="post" style="display: table-cell;" action="{{route('admin.eventuser.destroy',$event->id)}}">
        {{ csrf_field() }}
        <input type="hidden" name="event_id" value="{{ $event->id }}" class="btn btn-danger">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" class="btn btn-danger">
        <input type="submit" style="color:white; background-color: red; border-color: red;" value="このイベントから辞退する" class="btn">
    </form>
</div>        
@endif                                           
@endif 
@endsection