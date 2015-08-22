@extends('layouts.dashboard')

@section('content')


<section class="section">
	<div class="wrapper">
		
		<h2>Workshops</h2>
		
		<ul>
			<li><a href="{{ url('dashboard/workshops') }}">Ver todos</a></li>
			<li><a href="{{ url('dashboard/workshop/create') }}">Agregar</a></li>
		</ul>

		<h2>News</h2>
		
		<ul>
			<li><a href="{{ url('dashboard/news') }}">Ver todos</a></li>
			<li><a href="{{ url('dashboard/news/create') }}">Agregar</a></li>
		</ul>

	</div>
</section>


@stop