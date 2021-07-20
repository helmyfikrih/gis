// A $( document ).ready() block.
var user_lat = "";
var user_lng = "";
var locations = [["Ragunan", -6.311416722862261, 106.82029851602512]];
var geocoder = null;
var map = null;
var customerMarker = null;
var gmarkers = [];
var closest = [];
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
	user_lat = position.coords.latitude;
	user_lng = position.coords.longitude;
	initMap(user_lat, user_lng);
}

function getDirection(start, end) {
	$("#directions").html("");
	$('#tabMap a[href="#direction"]').trigger('click');
	var myOptions = {
		mapTypeId: google.maps.MapTypeId.ROADMAP,
	};
	var map = new google.maps.Map(document.getElementById("map"), myOptions);
	// var map = new google.maps.Map(document.getElementById("map"), {
	// 	zoom: 12,
	// 	center: { lat: -6.353525, lng: 106.831629 },
	// });

	var directionsService = new google.maps.DirectionsService();
	var directionsRenderer = new google.maps.DirectionsRenderer({
		draggable: true,
		map: map,
		panel: document.getElementById("directions"),
	});

	directionsRenderer.addListener("directions_changed", function () {
		// computeTotalDistance(directionsRenderer.getDirections());
	});
	// var myLatLng32 = new google.maps.LatLng({lat: -6.168428, lng: 106.827406});

	displayRoute(start, end, directionsService, directionsRenderer);

	// console.log($("#curr_lat").val());
	// directionsDisplay = new google.maps.DirectionsRenderer();
	// var myOptions = {
	// 	mapTypeId: google.maps.MapTypeId.ROADMAP,
	// };
	// map = new google.maps.Map(document.getElementById("map"), myOptions);
	// directionsDisplay.setMap(map);
	// var directionsService = new google.maps.DirectionsService();
	// var start = `${$("#curr_lat").val()}, ${$("#curr_lng").val()}`;
	// var end = "-6.2008406, 106.7987143";
	// var request = {
	// 	origin: start,
	// 	destination: end,
	// 	travelMode: google.maps.DirectionsTravelMode.DRIVING,
	// };
	// directionsService.route(request, function (response, status) {
	// 	if (status == google.maps.DirectionsStatus.OK) {
	// 		directionsDisplay.setDirections(response);
	// 		var myRoute = response.routes[0];
	// 		var txtDir = "";
	// 		console.log(myRoute);
	// 		txtDir +=
	// 			"Jarak Tempuh Dari Lokasi Anda <b>" +
	// 			myRoute.legs[0].distance.text +
	// 			" </b><br/>";
	// 		for (var i = 0; i < myRoute.legs[0].steps.length; i++) {
	// 			txtDir += myRoute.legs[0].steps[i].instructions + "<br />";
	// 		}
	// 		document.getElementById("directions").innerHTML = txtDir;
	// 	}
	// });
}

function displayRoute(origin, destination, service, display) {
	service.route(
		{
			origin: origin,
			destination: destination,
			travelMode: "DRIVING",
			avoidTolls: true,
		},
		function (response, status) {
			if (status === "OK") {
				display.setDirections(response);
			} else {
				alert("Could not display directions due to: " + status);
			}
		}
	);
}

function computeTotalDistance(result) {
	var total = 0;
	var myroute = result.routes[0];
	for (var i = 0; i < myroute.legs.length; i++) {
		total += myroute.legs[i].distance.value;
	}
	total = total / 1000;
	document.getElementById("total").innerHTML = total + " km";
}

function initMap(user_lat = null, user_lng = null, data = null) {
	$("#directions").html("");
	geocoder = null;
	map = null;
	customerMarker = null;
	gmarkers = [];
	closest = [];
	map = new google.maps.Map(document.getElementById("map"), {
		zoom: 10,
		center: new google.maps.LatLng(user_lat, user_lng),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
	});

	var user_marker = new google.maps.MarkerImage(
		`${base_url}assets/frontend/images/it_service/user_position.png`,
		null /* size is determined at runtime */,
		null /* origin is 0,0 */,
		null /* anchor is bottom center of the scaled image */,
		new google.maps.Size(40, 40)
	);
	marker = new google.maps.Marker({
		position: new google.maps.LatLng(user_lat, user_lng),
		map: map,
		icon: user_marker,
	});
	google.maps.event.addListener(
		marker,
		"click",
		(function (marker, i) {
			return function () {
				infowindow.setContent("Your Current Position");
				infowindow.open(map, marker);
			};
		})(marker, i)
	);
	var infowindow = new google.maps.InfoWindow();

	var marker, i;
	var image_url = `${base_url}assets/frontend/images/it_service/location_icon_map_cont.png`;
	var place_marker = new google.maps.MarkerImage(
		image_url,
		null /* size is determined at runtime */,
		null /* origin is 0,0 */,
		null /* anchor is bottom center of the scaled image */,
		new google.maps.Size(40, 40)
	);
	var user_position = new google.maps.LatLng(user_lat, user_lng);
	if (data) {
		$.each(data, function (key, value) {
			marker = new google.maps.Marker({
				position: new google.maps.LatLng(
					value.developer_lat,
					value.developer_lng
				),
				map: map,
				icon: place_marker,
				address: value.developer_name,
				title: value.developer_name,
			});

			gmarkers.push(marker);
			var target_position = new google.maps.LatLng(
				value.developer_lat,
				value.developer_lng
			);
			var distance = getDistance(user_position, target_position);
			var btn_direction = `<a href="javascript:;" onclick="getDirection('${
				user_lat + "," + user_lng
			}','${
				value.developer_lat + "," + value.developer_lng
			}')"><i class="fa fa-search" aria-hidden="true"></i> Get Direction</a>`;
			var info_window_contnet = ` Location Name: ${value.developer_name} 
		<br> Straight Distance: ${Math.round(distance)} M From Your Location
		<br> ${btn_direction}
		`;
			google.maps.event.addListener(
				marker,
				"click",
				(function (marker, i) {
					return function () {
						infowindow.setContent(info_window_contnet);
						infowindow.open(map, marker);
					};
				})(marker, i)
			);
		});
		closest = findClosestN(user_position, data.length);
		// get driving distance
		numberOfDrivingResults = data.length;
		closest = closest.splice(0, data.length);
		calculateDistances(user_position, closest, numberOfDrivingResults);
	}
	// var image = "images/it_service/location_icon_map_cont.png";

	// var beachMarker = new google.maps.Marker({
	//   position: { lat: -6.2008406, lng: 106.7987143 },
	//   map: map,
	//   icon: image,
	// });
}

function getKecamatan(kota) {
	$("#f_kecamatan option").remove();
	$.ajax({
		url: `${base_url}gis/getKecamatan`,
		type: "POST",
		data: {
			kota: kota,
		},
		dataType: "json",
		success: function (data) {
			$("#f_kecamatan").append(`<option value="0">ALL</option>`);
			$.each(data, function (key, value) {
				$("#f_kecamatan").append(
					`<option value="${value.kecamatan_id}">${value.kecamatan_name}</option>`
				);
			});
		},
		error: function (xhr, status, error) {
			Swal.fire({
				title: error,
				// text: response.message,
				icon: "error",
			});
		},
		timeout: 300000, // sets timeout to 5 minutes
	});
}

// change handler
$("#f_kota").on("change", function (e) {
	// Do something
	getKecamatan($("#f_kota").val());
});

$(".select2").on("change", function (e) {
	// Do something
	filter_persebaran();
});

var rad = function (x) {
	return (x * Math.PI) / 180;
};

var getDistance = function (p1, p2) {
	var R = 6378137; // Earth’s mean radius in meter
	var dLat = rad(p2.lat() - p1.lat());
	var dLong = rad(p2.lng() - p1.lng());
	var a =
		Math.sin(dLat / 2) * Math.sin(dLat / 2) +
		Math.cos(rad(p1.lat())) *
			Math.cos(rad(p2.lat())) *
			Math.sin(dLong / 2) *
			Math.sin(dLong / 2);
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
	var d = R * c;
	return d; // returns the distance in meter
};

function filter_persebaran() {
	$("#result_filter").html("");
	var f_search = $("#f_search").val();
	var f_kota = $("#f_kota").val();
	var f_kecamatan = $("#f_kecamatan").val();
	$.ajax({
		url: `${base_url}frontend/map/filter`,
		type: "POST",
		data: {
			f_search: f_search,
			f_kota: f_kota,
			f_kecamatan: f_kecamatan,
		},
		dataType: "json",
		success: function (result) {
			initMap(user_lat, user_lng, result.data);
			$('#tabMap a[href="#result"]').trigger('click');
		},
		error: function (xhr, status, error) {
			Swal.fire({
				title: error,
				// text: response.message,
				icon: "error",
			});
		},
		timeout: 300000, // sets timeout to 5 minutes
	});
}

function initialize() {
	// alert("init");
	geocoder = new google.maps.Geocoder();
	map = new google.maps.Map(document.getElementById("map"), {
		zoom: 9,
		center: new google.maps.LatLng(52.6699927, -0.727462),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
	});
	var infowindow = new google.maps.InfoWindow();
	var marker, i;
	var bounds = new google.maps.LatLngBounds();
	document.getElementById("info").innerHTML =
		"found " + locations.length + " locations<br>";
	for (i = 0; i < locations.length; i++) {
		var coordStr = locations[i][4];
		var coords = coordStr.split(",");
		var pt = new google.maps.LatLng(
			parseFloat(coords[0]),
			parseFloat(coords[1])
		);
		bounds.extend(pt);
		marker = new google.maps.Marker({
			position: pt,
			map: map,
			icon: locations[i][5],
			address: locations[i][2],
			title: locations[i][0],
			html: locations[i][0] + "<br>" + locations[i][2],
		});
		gmarkers.push(marker);
		google.maps.event.addListener(
			marker,
			"click",
			(function (marker, i) {
				return function () {
					infowindow.setContent(marker.html);
					infowindow.open(map, marker);
				};
			})(marker, i)
		);
	}
	map.fitBounds(bounds);
}

function codeAddress() {
	console.log("MASUK");
	var numberOfResults = 25;
	var numberOfDrivingResults = 5;
	var address = document.getElementById("f_search").value;
	geocoder.geocode(
		{
			address: address,
		},
		function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				console.log(results[0].geometry.location);
				map.setCenter(results[0].geometry.location);
				if (customerMarker) customerMarker.setMap(null);
				customerMarker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
				});
				closest = findClosestN(results[0].geometry.location, numberOfResults);
				// get driving distance
				closest = closest.splice(0, numberOfResults);
				calculateDistances(
					results[0].geometry.location,
					closest,
					numberOfDrivingResults
				);
			} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		}
	);
}

function findClosestN(pt, numberOfResults) {
	var closest = [];
	// document.getElementById("info").innerHTML +=
	// 	"processing " + gmarkers.length + "<br>";
	for (var i = 0; i < gmarkers.length; i++) {
		gmarkers[i].distance =
			google.maps.geometry.spherical.computeDistanceBetween(
				pt,
				gmarkers[i].getPosition()
			);
		// document.getElementById("info").innerHTML +=
		// 	"process " +
		// 	i +
		// 	":" +
		// 	gmarkers[i].getPosition().toUrlValue(6) +
		// 	":" +
		// 	gmarkers[i].distance.toFixed(2) +
		// 	"<br>";
		gmarkers[i].setMap(null);
		closest.push(gmarkers[i]);
	}
	closest.sort(sortByDist);
	return closest;
}

function sortByDist(a, b) {
	return a.distance - b.distance;
}

function calculateDistances(pt, closest, numberOfResults) {
	var service = new google.maps.DistanceMatrixService();
	var request = {
		origins: [pt],
		destinations: [],
		travelMode: google.maps.TravelMode.DRIVING,
		unitSystem: google.maps.UnitSystem.METRIC,
		avoidHighways: false,
		avoidTolls: false,
	};
	for (var i = 0; i < closest.length; i++) {
		request.destinations.push(closest[i].getPosition());
	}
	service.getDistanceMatrix(request, function (response, status) {
		if (status != google.maps.DistanceMatrixStatus.OK) {
			alert("Error was: " + status);
		} else {
			var origins = response.originAddresses;
			var destinations = response.destinationAddresses;
			var outputDiv = document.getElementById("result_filter");
			outputDiv.innerHTML = "";

			var results = response.rows[0].elements;
			// save title and address in record for sorting
			console.log(results);
			for (var i = 0; i < closest.length; i++) {
				results[i].title = closest[i].title;
				results[i].address = closest[i].address;
				results[i].idx_closestMark = i;
			}
			results.sort(sortByDistDM);
			for (var i = 0; i < numberOfResults && i < closest.length; i++) {
				closest[i].setMap(map);
				outputDiv.innerHTML +=
					"<a style='color:blue;' href='javascript:google.maps.event.trigger(closest[" +
					results[i].idx_closestMark +
					'],"click");\'>' +
					results[i].title +
					"</a><br>" +
					results[i].address +
					"<br>" +
					"Driving Distance " + results[i].distance.text +
					" appoximately " +
					results[i].duration.text +
					"<br><hr>";
			}
		}
	});
}

function sortByDistDM(a, b) {
	return a.distance.value - b.distance.value;
}

// google.maps.event.addDomListener(window, "load", initialize);
// Store Name[0],delivery[1],Address[2],Delivery Zone[3],Coordinates[4] data from FusionTables pizza stores example
