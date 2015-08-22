<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pre-text</title>
	<link rel="stylesheet" href="{{ asset('css/main.css') }}" />

	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fullPage.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/skrollr/0.6.27/skrollr.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>

	<script type="text/javascript" src="{{ asset('js/jquery.fullPage.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#fullpage').fullpage({
				sectionsColor: ['#f2f2f2', '#4BBFC3', '#7BAABE', 'whitesmoke', '#ccddff'],
				css3: true,
				onLeave: function(index, nextIndex, direction){
			        //leaving 1st section
			        if(index == 1){
			           $('.header').addClass('fixed');
			        }
			        //back to the 1st section
			        if(nextIndex == 1){
						$('.header').removeClass('fixed');
			        }
			    },
			    
			    afterResize: function(){
			        windowsHeight = $(window).height();
			    }
			});
		});

		


		
	</script>
	@yield('maps')
</head>
<body>
	
	<!-- HEADER -->
	<div id="header" class="header @if(Request::url() == 'http://pretexts.buro-desarrollo.org') animated_position @endif">
		<nav>
			<ul>
				<li><a href="{{ action('HomeController@index') }}">Home</a></li>
				<li><a href="{{ URL::to('about') }}">About</a></li>
				<li><a href="{{ action('HomeController@workshops') }}">Map</a></li>
				<li><a href="{{ URL::to('workshops') }}">Workshops</a></li>
				<li><a href="{{ URL::to('blog') }}">Blog</a></li>
				<li><a href="{{ URL::to('collaborators') }}">Collaborators</a></li>
				@if(!Sentry::check())
				<li><a href="{{ action('SentryController@index') }}">Login</a></li>
				@else
				<li><a href="{{ action('SentryController@logout') }}">Logout</a></li>
				@endif
			</ul>
		</nav>
	</div>
	 
	<!-- CONTENT -->
	<div id='fullpage' class="w-section">
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

	<!-- FOOTER -->
	<footer class="footer">
		<p>Pretext &copy; 2015</p>
	</footer>
</body>
</html>


