// A $( document ).ready() block.
var locations = [
	["Bondi Beach", -33.890542, 151.274856, 4],
	["Coogee Beach", -33.923036, 151.259052, 5],
	["Cronulla Beach", -34.028249, 151.157507, 3],
	["Manly Beach", -33.80010128657071, 151.28747820854187, 2],
	["Maroubra Beach", -33.950198, 151.259302, 1],
];
$(document).ready(function () {
	$(".select2").select2({});
});
if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(setPosition);
} else {
	alert("Geolocation is not supported by this browser.");
}
function setPosition(position) {
	$("#curr_lat").val(position.coords.latitude);
	$("#curr_lng").val(position.coords.longitude);
	initMap();
}

function getDirection(start, end) {
	console.log($("#curr_lat").val());
	directionsDisplay = new google.maps.DirectionsRenderer();
	var myOptions = {
		mapTypeId: google.maps.MapTypeId.ROADMAP,
	};
	map = new google.maps.Map(document.getElementById("map"), myOptions);
	directionsDisplay.setMap(map);
	var directionsService = new google.maps.DirectionsService();
	var start = `${$("#curr_lat").val()}, ${$("#curr_lng").val()}`;
	var end = "-6.2008406, 106.7987143";
	var request = {
		origin: start,
		destination: end,
		travelMode: google.maps.DirectionsTravelMode.DRIVING,
	};
	directionsService.route(request, function (response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay.setDirections(response);
			var myRoute = response.routes[0];
			var txtDir = "";
			console.log(myRoute);
			txtDir +=
				"Jarak Tempuh Dari Lokasi Anda <b>" +
				myRoute.legs[0].distance.text +
				" </b><br/>";
			for (var i = 0; i < myRoute.legs[0].steps.length; i++) {
				txtDir += myRoute.legs[0].steps[i].instructions + "<br />";
			}
			document.getElementById("directions").innerHTML = txtDir;
		}
	});
}

function initMap() {
	var map = new google.maps.Map(document.getElementById("map"), {
		zoom: 10,
		center: new google.maps.LatLng(-33.92, 151.25),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
	});

	var infowindow = new google.maps.InfoWindow();

	var marker, i;
	var image = `${base_url}assets/frontend/images/it_service/location_icon_map_cont.png`;
	for (i = 0; i < locations.length; i++) {
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map,
			icon: image,
		});

		google.maps.event.addListener(
			marker,
			"click",
			(function (marker, i) {
				return function () {
					infowindow.setContent(locations[i][0]);
					infowindow.open(map, marker);
				};
			})(marker, i)
		);
	}
	// var image = "images/it_service/location_icon_map_cont.png";

	// var beachMarker = new google.maps.Marker({
	//   position: { lat: -6.2008406, lng: 106.7987143 },
	//   map: map,
	//   icon: image,
	// });
}
