var map;
var myCenter=new google.maps.LatLng(51.508742,-0.120850);

function initialize()
{
	var mapProp = {
		center:myCenter,
		zoom:5,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

	google.maps.event.addListener(map, 'click', function(event) {
		placeMarker(event.latLng);
	});
}

function placeMarker(location) {
	var marker = new google.maps.Marker({
		position: location,
		map: map,
	});
	var infowindow = new google.maps.InfoWindow({
		content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
	});
	infowindow.open(map,marker);
}

google.maps.event.addDomListener(window, 'load', initialize);
