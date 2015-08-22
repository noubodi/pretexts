@extends('layouts.dashboard')

@section('content')

<div class="section">
	<div class="wrapper">
		<h3>Workshops</h3>
		
		@foreach ($workshops as $workshop)
			<div>
				<h2>{{ $workshop->title }}</h2>
				<a href="{{ action('WorkshopController@edit', $workshop->id) }}">Edit</a>
				<a href="{{ action('WorkshopController@delete', $workshop->id) }}">Delete</a>
			</div>
		@endforeach

	</div>
</div>

@stop