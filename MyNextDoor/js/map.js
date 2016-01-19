window.onload=function() {
	document.getElementById('hideMarkers').addEventListener("click", clearMarkers);
	document.getElementById("showMarkers").addEventListener("click", showMarkers);
	document.getElementById("deleteMarkers").addEventListener("click", deleteMarkers);
};

var map;
var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
var labelsIndex = 0;
var markers = [];

var initMap = function(){
	map = new google.maps.Map(document.getElementById('map1'), {
		center: {lat: 40.62624934866665,lng: -74.03578162193298},
		scaleControl: true,
		zoom: 13
	});
	var neighborhoodArray = [[
	{lat: 40.626969991232784,lng: -74.03553485870361},
	{lat: 40.626330777594895,lng: -74.03283655643463},
	{lat: 40.62338298713863,lng: -74.03403282165527},
	{lat: 40.624034443742254,lng: -74.03669357299805}
	],[
	{lat: 40.64538241694306, lng: -73.99566650390625},
	{lat: 40.64460091817221, lng: -73.99431467056274},
	{lat: 40.643347244780315, lng: -73.99425029754639},
	{lat: 40.64183303643054, lng: -73.99579524993896},
	{lat: 40.643135583312805, lng: -73.99802684783936}
	]];
	//neighborhood
	var neighborhoodName = 'A Zone';
	var neighborhoodlist = neighborhoodArray[0];
	var neighborhood = new google.maps.Polygon({
		paths: neighborhoodlist,
		strokeColor: '#65D9EF',
		strokeOpacity: 0.8,
		strokeWeight: 3,
		fillColor: '#65ceD9EF',
		fillOpacity: 0.35
	});
	neighborhood.setMap(map);
	neighborhood.addListener('click', function(event){
		var type = 'neighborhood';
		addMarker(event.latLng, map, type, neighborhoodName);
	});
	//2
	var neighborhoodName2 = 'B Zone';
	var neighborhoodlist2 = [
	{lat: 40.64538241694306, lng: -73.99566650390625},
	{lat: 40.64460091817221, lng: -73.99431467056274},
	{lat: 40.643347244780315, lng: -73.99425029754639},
	{lat: 40.64183303643054, lng: -73.99579524993896},
	{lat: 40.643135583312805, lng: -73.99802684783936}
	];

	var neighborhood2 = new google.maps.Polygon({
		paths: neighborhoodlist2,
		strokeColor: '#66D9EF',
		strokeOpacity: 0.8,
		strokeWeight: 3,
		fillColor: '#66D9EF',
		fillOpacity: 0.35
	});
	neighborhood2.setMap(map);
	neighborhood2.addListener('click', function(event){
		var type = 'neighborhood';
		addMarker(event.latLng, map, type, neighborhoodName2);
	});


	//block
	var blocklist = [
		[
		{lat: 40.626969991232784,lng: -74.03553485870361},
		{lat: 40.62626970590803,lng: -74.03579235076904},
		{lat: 40.62564270002633,lng: -74.0331369638443},
		{lat: 40.626330777594895,lng: -74.03283655643463}
		],
		[
		{lat: 40.62624934866665,lng: -74.03578162193298},
		{lat: 40.62563048556756,lng: -74.03314232826233},
		{lat: 40.62499533063458,lng: -74.0333890914917},
		{lat: 40.62559791366668,lng: -74.03609275817871}
		],
		[
		{lat: 40.62558162771025,lng: -74.03609275817871},
		{lat: 40.62491390007815,lng: -74.03336763381958},
		{lat: 40.624099589053145,lng: -74.03375387191772},
		{lat:40.62466960781309,lng: -74.03647899627686}
		],
		[
		{lat: 40.62460446305818,lng: -74.03650045394897},
		{lat: 40.62408330273138,lng: -74.03379678726196},
		{lat: 40.62338298713863,lng: -74.03403282165527},
		{lat: 40.624034443742254,lng: -74.03669357299805}
		]
		];

		var block0 = new google.maps.Polygon({
			paths: blocklist[0],
			strokeColor: '#FF0000',
			strokeOpacity: 0.8,
			strokeWeight: 1,
			fillColor: '#FF0000',
			fillOpacity: 0.35
		});
		block0.setMap(map);
		block0.addListener('click', function(event){
			var type = 'block';
			addMarker(event.latLng, map, type, neighborhoodName);
		});

		var block1 = new google.maps.Polygon({
			paths: blocklist[1],
			strokeColor: '#FF0000',
			strokeOpacity: 0.8,
			strokeWeight: 1,
			fillColor: '#FF0000',
			fillOpacity: 0.35
		});
		block1.setMap(map);
		block1.addListener('click', function(event){
			var type = 'block';
			addMarker(event.latLng, map, type, neighborhoodName);
		});

		var block2 = new google.maps.Polygon({
			paths: blocklist[2],
			strokeColor: '#FF0000',
			strokeOpacity: 0.8,
			strokeWeight: 1,
			fillColor: '#FF0000',
			fillOpacity: 0.35
		});
		block2.setMap(map);
		block2.addListener('click', function(event){
			var type = 'block';
			addMarker(event.latLng, map, type, neighborhoodName);
		});

		var block3 = new google.maps.Polygon({
			paths: blocklist[3],
			strokeColor: '#FF0000',
			strokeOpacity: 0.8,
			strokeWeight: 1,
			fillColor: '#FF0000',
			fillOpacity: 0.35
		});
		block3.setMap(map);
		block3.addListener('click', function(event){
			var type = 'block';
			addMarker(event.latLng, map, type, neighborhoodName);
		});

		var geocoder = new google.maps.Geocoder();

		document.getElementById('submit').addEventListener('click',function(){
			geocodeAddress(geocoder,map);
		});
		function geocodeAddress(geocoder,resultsMap){
			var address = document.getElementById('address').value;
			geocoder.geocode({'address':address}, function(results,status){
				if(status === google.maps.GeocoderStatus.OK){
					resultsMap.setCenter(results[0].geometry.location);
					var marker = new google.maps.Marker({
						map: resultsMap,
						//draggable:true,
						position: results[0].geometry.location
					});
					attachSecretMessage(marker);
				}else{
					alert('Geocode was not successful for the following reason: ' + status);
				}
			});

		}

		google.maps.event.addListener(map,'click', function(event){
			var type = 'map';
			addMarker(event.latLng, map, type, neighborhoodName);
		});

		//var mylocation = {lat: 40.6476789,lng: -73.99904300000003}; 
		//addMarker(mylocation, map);
}

//Dynamicly add Markers
function addMarker(location, map, type, markername){
	var marker = new google.maps.Marker({
		position: location,
		label: labels[labelsIndex++ % labels.length],
		draggable:true,
		map: map
	});
	map.panTo(location);// Change the center of the map

	attachSecretMessage(marker,type, markername);
	markers.push(marker);
}

//Set the map on all markers in the array
function setMapOnAll(map){
	for(var i=0;i<markers.length;i++)
		markers[i].setMap(map);
}

//Remove the markers from the map, but still keep them in th array
function clearMarkers(){
	setMapOnAll(null);
}

//Show any markers currently in the array
function showMarkers(){
	setMapOnAll(map);
}

function deleteMarkers(){
	clearMarkers();
	markers = [];
	labelsIndex = 0;
}


function attachSecretMessage(marker, type, markername){
	var lat1 = marker.getPosition().lat().toString();
	var lng1 = marker.getPosition().lng().toString();
	var locationMessage = 'latitude:' + lat1 + '<br>' + 'longitude:' + lng1 + '<br>';
	var infowindow = new google.maps.InfoWindow();
	var geocoder = new google.maps.Geocoder();
	var location = {lat: marker.getPosition().lat(), lng: marker.getPosition().lng()};
	geocoder.geocode({'location': location}, function(results, status) {
		if(type == 'map'){
			locationMessage = locationMessage + 'address:' + results[0].formatted_address;
		}
		else if(type == 'neighborhood'){
			locationMessage = '<h1>' + markername +'</h1><br>' + 
				locationMessage + 'address:' + results[0].formatted_address;
		}
		else if(type == 'block'){
			locationMessage = '<h1>' + markername +'</h1><br>' + '<h2>This is a block which belongs to "' + markername 
				+ '</h2><br>' +
				locationMessage + 'address:' + results[0].formatted_address;
		}

		document.getElementById("myAddress").value=results[0].formatted_address;

		infowindow.setContent(locationMessage);
		infowindow.open(map, marker);
	});            


	marker.addListener('click', function() {
		infowindow.open(marker.get('map'), marker);
	});
	marker.addListener('dragend',function(){
		locationMessage = 'latitude:' + marker.getPosition().lat() + '<br>' + 'longitude:' + marker.getPosition().lng();
		var location = {lat: marker.getPosition().lat(), lng: marker.getPosition().lng()};
		geocoder.geocode({'location': location}, function(results, status) {
			locationMessage = locationMessage + '<br>address:' +results[0].formatted_address
				infowindow.setContent(locationMessage);
			infowindow.open(map, marker);
		});
	});
}

