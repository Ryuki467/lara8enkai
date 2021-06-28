<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		@yield('metaIcon')
		<title>@yield('title')</title>
		<link href="{{asset('css/app.css')}}" rel="stylesheet">
		<link href="{{asset('css/style.css')}}" rel="stylesheet">
		@yield('css')
		<script src="{{asset('js/app.js')}}"></script>
	</head>
	<body>
		@yield('menu')
		<div class="container-fluid mt-3">
			<div class="row">
				<div class="col-sm-10 main mx-auto">
					@yield('content')
				</div>
			</div>
		</div>
		@yield('script')
	</body>
</html>