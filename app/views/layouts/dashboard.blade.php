<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pre-text</title>
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
	<!-- <link rel="stylesheet" type="text/css" href="examples.css" /> -->

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>

	@yield('maps')
</head>
<body>
	
	<header class="header">
		<nav>
			<ul>
				<li><a href="{{ action('AdminController@index') }}">Home</a></li>
				<li><a href="{{ action('AdminController@logout') }}">Logout</a></li>
			</ul>
		</nav>
	</header>

	<div id="fullpage" class="w-section">
		@if(Sentry::check())
			<div class="active">
			estas logeado
			</div>
		@else
			<div class="in-active">
			no estas logeado
			</div>
		@endif

		@yield('content')
	</div>


	<footer class="footer">
		<p>Pretext &copy; 2015</p>
	</footer>
	
</body>
</html>