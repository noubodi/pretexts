@extends('layouts.default')

@section('content')


<div class="section">
	<div class="wrapper">
		<h3>Workshops</h3>
		
		@foreach ($workshops as $workshop)
			<div>
				<h2>{{ $workshop->title }}</h2>
				<p>{{ $workshop->content }}</p>
			</div>
		@endforeach

	</div>
</div>

@stop