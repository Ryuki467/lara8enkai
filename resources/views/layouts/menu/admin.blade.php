@section('menu')
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
	<div class="container">
		<div class="navbar-header">
    		<a href="{{route('home')}}" class="navbar-brand">宴会くん</a>
    	</div>
    	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" area-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{__('Toggle navigation')}}">
    		<span class="navbar-toggler-icon"></span>
    	</button>
    	<div class="collapse navbar-collapse" id="navbarSupportedContent">
    	   @if(isset(Auth::user()->name))
    		<ul class="navbar-nav mr-auto">
    			<li class="nav-item dropdown">
    				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">イベント</a>
    				<ul class="dropdown-menu">
    					<li><a href="{{route('admin.event.index')}}" class="nav-link">マイイベント一覧</a></li>
    					<li><a href="{{route('admin.event.create')}}" class="nav-link">新規登録</a></li>
    				</ul>
    			</li>
    			<li class="nav-item dropdown">
    				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">カテゴリ</a>
    				<ul class="dropdown-menu">
    					<li><a class="nav-link" href="{{route('admin.category.index')}}">一覧</a></li>
    					<li><a class="nav-link" href="{{route('admin.category.create')}}">新規登録</a></li>
    				</ul>
    			</li>
    		</ul>
    		<ul class="navbar-nav ml-auto">
    			<li class="navbar-text mr-3">ようこそ、{{Auth::user()->name}}</li>
    			<li class="nav-item dropdown">
    				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">管理</a>
    				<ul class="dropdown-menu">
    					<li><a href="{{route('admin.user.index')}}" class="nav-link">ユーザ一覧</a></li>
    					<li><a href="{{route('admin.user.edit')}}" class="nav-link">ユーザ編集</a></li>
    					<li><a href="{{route('logout')}}" class="nav-link">ログアウト</a></li>
    				</ul>
    			</li>
    		</ul>
    		@else
    		<ul class="navbar-nav mr-auto">
    			<li class="nav-item dropdown">
    				<a href="{{route('login')}}" class="nav-link">ログイン</a>
    			</li>
    			<li class="nav-item dropdown">
    				<a class="nav-link" href="{{route('register')}}">ユーザ登録</a>
    			</li>
    		</ul>
    		@endif
    	</div>
    </div>
</nav>
@endsection