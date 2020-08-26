var geocoder;
var map;
var marker;
var is_searched = false;
var infowindow = new google.maps.InfoWindow({
	size: new google.maps.Size(150, 50),
});

$(function () {
	$(".select2bs4").select2({
		theme: "bootstrap4",
		placeholder: "Pilih salah satu...",
		allowClear: true,
	});
	$.validator.setDefaults({
		submitHandler: function (form) {
			Swal.fire({
				title: "Apakah Anda Yakin?",
				text: "",
				icon: "question",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes",
			}).then((result) => {
				if (result.value) {
					var myForm = $("#form")[0];
					$.ajax({
						url: $(myForm).attr("action"),
						type: "POST",
						data: new FormData(myForm),
						contentType: false,
						cache: false,
						processData: false,
						dataType: "json",
						success: function (data) {
							response = jQuery.parseJSON(JSON.stringify(data));
							if (response.is_success === true) {
								Swal.fire({
									title: response.message,
									// text: response.message,
									icon: "success",
								});
								$("#form").trigger("reset");
								hideModal();
							} else {
								Swal.fire({
									title: "Warning",
									text: response.message,
									icon: "warning",
								});
							}
							$("#datatables").DataTable().ajax.reload(null, false);
						},
						error: function (xhr, status, error) {
							Swal.fire({ title: "Error", text: error, icon: "error" });
							$("#datatables").DataTable().ajax.reload(null, false);
						},
					});
				}
			});
		},
	});

	$("#form_register").validate({
		ignore: [],
		rules: {
			username: {
				required: true,
				minlength: 5,
			},
			email: {
				required: true,
				email: true,
				minlength: 5,
			},
			password: {
				required: true,
				minlength: 5,
			},
			password_confirm: {
				required: true,
				minlength: 5,
				equalTo: "#password",
			},
			developer_name: {
				required: true,
			},
			kota: {
				required: true,
			},
			kecamatan: {
				required: true,
			},
			address: {
				required: true,
			},
			phone: {
				required: true,
				minlength: 5,
			},
			recomendation: {
				required: true,
			},
			pasphoto: {
				required: true,
			},
		},
		// messages: {
		// 	email: {
		// 		required: "Please enter a email address",
		// 		email: "Please enter a vaild email address",
		// 	},
		// 	password: {
		// 		required: "Please provide a password",
		// 		minlength: "Your password must be at least 5 characters long",
		// 	},
		// },
		errorElement: "span",
		errorPlacement: function (error, element) {
			error.addClass("invalid-feedback");
			element.closest(".form-group").append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid");
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass("is-invalid");
		},
	});
	initialize;
	google.maps.event.addDomListener(window, "load", initialize);
});

function initialize() {
	geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(-6.2295712, 106.759478);
	var mapOptions = {
		zoom: 12,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
	};
	map = new google.maps.Map(document.getElementById("map"), mapOptions);
	google.maps.event.addListener(map, "click", function () {
		infowindow.close();
	});
}

function geocodePosition(pos) {
	geocoder.geocode(
		{
			latLng: pos,
		},
		function (responses) {
			if (responses && responses.length > 0) {
				marker.formatted_address = responses[0].formatted_address;
				$("#address").val(responses[0].formatted_address);
				$("#loc_lat").val(responses[0].geometry.location.lat());
				$("#loc_lng").val(responses[0].geometry.location.lng());
				is_searched = true;
			} else {
				marker.formatted_address = "Cannot determine address at this location.";
			}
			infowindow.setContent(
				marker.formatted_address +
					"<br>coordinates: " +
					marker.getPosition().toUrlValue(6)
			);
			// infowindow.open(map, marker);
		}
	);
}

function codeAddress() {
	var address = document.getElementById("address").value;
	geocoder.geocode(
		{
			address: address,
		},
		function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				$("#loc_lat").val(results[0].geometry.location.lat());
				$("#loc_lng").val(results[0].geometry.location.lng());
				is_searched = true;
				if (marker) {
					marker.setMap(null);
					if (infowindow) infowindow.close();
				}
				marker = new google.maps.Marker({
					map: map,
					draggable: true,
					position: results[0].geometry.location,
				});
				map.fitBounds(results[0].geometry.viewport);
				google.maps.event.addListener(marker, "dragend", function () {
					geocodePosition(marker.getPosition());
				});

				// google.maps.event.addListener(marker, "click", function () {
				// 	if (marker.formatted_address) {
				// 		infowindow.setContent(
				// 			marker.formatted_address +
				// 				"<br>coordinates: " +
				// 				marker.getPosition().toUrlValue(6)
				// 		);
				// 		$("#address").val(marker.formatted_address);
				// 		$("#loc_lat").val(marker.latLng.lat().toFixed(3));
				// 		$("#loc_lng").val(marker.latLng.lng().toFixed(3));
				// 	} else {
				// 		infowindow.setContent(
				// 			address + "<br>coordinates: " + marker.getPosition().toUrlValue(6)
				// 		);
				// 		$("#address").val(marker.formatted_address);
				// 		$("#loc_lat").val(marker.latLng.lat().toFixed(3));
				// 		$("#loc_lng").val(marker.latLng.lng().toFixed(3));
				// 	}
				// 	infowindow.open(map, marker);
				// });
				// google.maps.event.trigger(marker, "click");
			} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		}
	);
}

// Vorm Validation
$(".select-form").on("change", function (e) {
	// Do something
	var is_invalid = $(".is-invalid");
	if (is_invalid.hasClass("is-invalid")) {
		$("#form").valid();
	}
});
