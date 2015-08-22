@extends('layouts.default')

@section('maps')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script>

var locations = [
  @foreach($workshops as $workshop)
  [{{ $workshop->latitude }}, {{ $workshop->longitude }}],
  @endforeach
];


function initialize() {

  var bounds = new google.maps.LatLngBounds();
  var myLatlng = new google.maps.LatLng(42.3778986,-71.1164562);

  var mapOptions = {
    zoom: 16,
    center: myLatlng
  }

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  for (i = 0; i < locations.length; i++) {  
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][0], locations[i][1]),
      map: map
    });

    bounds.extend(marker.position);

  }

  map.fitBounds(bounds);

}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
@stop


@section('content')

	<div id="map-canvas" style="width:100%; height:600px;"></div>

	@foreach($workshops as $workshop)
    <div>
		{{ $workshop->title }}
		{{ $workshop->latitude }}
		{{ $workshop->longitude }}
    </div>
    <a href="{{ action('WorkshopController@edit', $workshop->id) }}">Editar</a>
	@endforeach

@stop