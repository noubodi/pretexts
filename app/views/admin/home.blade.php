@extends('layouts.admin')

@section('content')



<div class="section">
	<div class="wrapper">
	
		<a href="{{ action('AdminWorkshopController@getIndex') }}" class="btn">Workshops</a>

		<img src="{{ asset('img/pretexts.png') }}" alt="Pre-Texts">
	</div>
</div>

@stop