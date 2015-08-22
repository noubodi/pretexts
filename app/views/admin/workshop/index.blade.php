@extends('layouts.admin')

@section('content')

<div class="section">
	<div class="wrapper">
		<h2>Workshop List</h2>
		
		<table width="100%">
			<tr>
				<th>Title</th>
			</tr>
		@foreach ($workshops as $workshop)
			<tr>
				<td>{{ $workshop->title }}</td>
				<td>{{ link_to_action('AdminWorkshopController@getEdit', 'Edit', $workshop->id) }}</td>
				<td>{{ link_to_action('AdminWorkshopController@getDelete', 'Delete', $workshop->id) }}</td>
			</tr>
		@endforeach
		</table>
	</div>
</div>

@stop