@section('menu')
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
	<div class="container">
		<div class="navbar-header">
    		<a href="{{route('home')}}" class="navbar-brand">宴会くん</a>
    	</div>
    	<button class="navbar-toggler" type="button" data-toggle="collapse" 
    	data-target=#navbarSupportedContent" area-controls="navbarSupportedContent" 
    	aria-expanded="false" aria-label="{{__('Toggle navigation')}}">
    		<span class="navbar-toggler-icon"></span>
    	</button>
    	<div class="collapse navbar-collapse" id="navbarSupportedContent">
    		<ul class="navbar-nav mr-auto">
    			<li class="nav-item dropdown">
    				<a href="{{route('login')}}" class="nav-link">ログイン</a>
    			</li>
    			<li class="nav-item dropdown">
    				<a class="nav-link" href="{{route('register')}}">ユーザ登録</a>
    			</li>
    		</ul>
    	</div>
    </div>
</nav>
@endsection