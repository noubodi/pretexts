@extends('layouts.dashboard')

@section('maps')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>

<script>
function initialize() {
	var myLatlng = new google.maps.LatLng({{ $workshop->latitude }},{{ $workshop->longitude }});
	var marker;
	var mapOptions = {
	    zoom: 16,
	    center: myLatlng
	}

  	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	var input = (document.getElementById('pac-input'));

	map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
	var autocomplete = new google.maps.places.Autocomplete(input);
	autocomplete.bindTo('bounds', map);

	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		var place = autocomplete.getPlace();
		map.setCenter(place.geometry.location);
	});

	marker = new google.maps.Marker({
      position: new google.maps.LatLng( {{ $workshop->latitude }} , {{ $workshop->longitude }}),
      draggable:true,
      map: map
    });
	
	google.maps.event.addListener(marker, 'drag', function(event) {
		updateMarker();
	});

	google.maps.event.addListener(map, 'click', function(event) {
	   placeMarker(event.latLng);
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

	<h2>Edit Workshop</h2>

	{{ Form::open(array('action' => 'WorkshopController@postEdit')) }}
	

	{{ Form::hidden('id', $workshop->id ) }}

	{{ Form::label('title','Title') }}
	{{ Form::text('title', $workshop->title ) }}

	{{ Form::label('content','Content') }}
	{{ Form::textarea('content', $workshop->content ) }}
	
	{{ Form::label('place','Place') }}
	{{ Form::text('controls', '', array('id' => 'pac-input' , 'class' => 'controls', 'placeholder' => 'Search Box') ) }}
	<div id="map-canvas" class="edit-canvas-map"></div>

	{{ Form::hidden('latitude', $workshop->latitude,  array('id' => 'latitude') ) }}
	{{ Form::hidden('longitude', $workshop->longitude, array('id' => 'longitude') ) }}
	
	<div class="btn-submit">
	{{ Form::submit('edit') }}
	</div>

	{{ Form::close() }}

	</div>
</div>


@stop