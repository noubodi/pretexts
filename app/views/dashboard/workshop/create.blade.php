@extends('layouts.dashboard')

@section('maps')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>

<script>
function initialize() {
	var myLatlng = new google.maps.LatLng(42.3778986,-71.1164562);
	var marker;
	var mapOptions = {
	    zoom: 16,
	    center: myLatlng
	}

  	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  	google.maps.event.addListener(map, 'click', function(event) {
	   placeMarker(event.latLng);
	});

	var input = (document.getElementById('pac-input'));

	map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
	var autocomplete = new google.maps.places.Autocomplete(input);
	autocomplete.bindTo('bounds', map);

	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		var place = autocomplete.getPlace();
		map.setCenter(place.geometry.location);
	});


	function placeMarker(location) {
		if(marker) {
	    	marker.setPosition(location);
	    	updateMarker();

		} else {
			marker = new google.maps.Marker({
		      position: location,
		      draggable:true,
		      map: map
		    });

		    updateMarker();

   			google.maps.event.addListener(marker, 'drag', function(event) {
				updateMarker();
			});
		}
	}

	function updateMarker() {
		document.getElementById("latitude").value = marker.getPosition().lat();
		document.getElementById("longitude").value = marker.getPosition().lng();
	}

}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
@stop

@section('content')

<div class="section">
	<div class="wrapper">

	<h2>Create Workshop</h2>

	{{ Form::open(array('action' => 'WorkshopController@postCreate')) }}

	{{ Form::label('title','Title') }}
	{{ Form::text('title', null) }}

	{{ Form::label('content','Content') }}
	{{ Form::textarea('content', null) }}
	
	{{ Form::text('controls', '', array('id' => 'pac-input' , 'class' => 'controls', 'placeholder' => 'Search Box') ) }}
	<div id="map-canvas" class="edit-canvas-map"></div>

	{{ Form::hidden('latitude',  'Latitude',array('id' => 'latitude') ) }}
	{{ Form::hidden('longitude', 'Longitude', array('id' => 'longitude') ) }}
	
	<div class="btn-submit">
	{{ Form::submit('create') }}
	</div>

	{{ Form::close() }}

	</div>
</div>


@stop