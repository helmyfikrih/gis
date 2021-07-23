var geocoder;
var map;
var marker;
var infowindow = new google.maps.InfoWindow({
	size: new google.maps.Size(150, 50),
});
var map_address;
var lat;
var lng;
$(function () {
	var myTable = $("#datatables").DataTable({
		autoWidth: false,
		responsive: false,
		bServerSide: true,
		scrollX: true,
		columnDefs: [
			{
				targets: 0,
				className: "text-center",
				// width: "15%",
			},
		],
		ajax: {
			url: `${base_url}members_registration/getList`,
			type: "POST",
			data: function (d) {
				// d.id_region = $('#region').val();
			},
		},
		initComplete: function (settings, json) {
			$("#datatables_filter input").unbind();
			$("#datatables_filter input").bind("keyup", function (e) {
				if (e.keyCode == 13) {
					myTable.search(this.value).draw();
				}
			});
		},
	});
});

function view(id, email) {
	$("#modalView").modal("show");
	jQuery.ajax({
		type: "post",
		data: {
			id: id,
			email: email,
		},
		url: `${base_url}members_registration/getOne`,
		dataType: "json",
		success: function (e) {
			$("#footer-view").html("");
			$("#body-view").html("");
			var attachment = "";
			var btn_approval = "";
			$.each(e.data_register_attachment, function (key, value) {
				attachment += `<a href='${value.register_attachment_url}' data-rel='colorbox' class='' style='padding-left:1%;padding-right:1%; border-style: solid;' target='_blank'>
                                    <i class='fa fa-paperclip'>  ${value.register_attachment_type}</i>
                                </a>`;
			});
			$.each(e.data_register, function (key, value) {
				$(".modalHeaderText").html(`Detail User ${value.register_name}`);
				var status_email = `<span class=" badge bg-warning">Menunggu Verifikasi</span>`;
				var status_registrasi = `<span class=" badge bg-warning">Menunggu Verifikasi</span>`;
				var email_verify_date = "";
				var approval_date = "";
				var approval_date_text = `<tr>
                                        <th>Tanggal Approval Registrasi :</th>
                                        <td>${formatDate(
																					"dd-mm-yyyy",
																					value.register_last_update
																				)}</td>
                                    </tr>`;
				if (value.register_email_verify_status == 1) {
					email_verify_date = `<tr>
                                        <th>Tanggal E-mail Verification :</th>
                                        <td>${formatDate(
																					"dd-mm-yyyy",
																					value.register_email_verify_date
																				)}</td>
                                    </tr>
                    `;
					status_email = `<span class=" badge bg-success">Sudah Terverifikasi</span>`;
				}
				if (value.register_status == 1) {
					approval_date = approval_date_text;
					status_registrasi = `<span class=" badge bg-success">Sudah Terverifikasi</span>`;
				} else if (value.register_status == 2) {
					btn_approval += `<button type="button" class="btn btn-danger" onclick="approval(0,'${value.register_email}','${value.register_uniq_code}')">Reject</button>&nbsp`;
					btn_approval += `<button type="button" class="btn btn-info" onclick="approval(1,'${value.register_email}','${value.register_uniq_code}')">Approve</button> &nbsp`;
				} else if (value.register_status == 0) {
					approval_date = approval_date_text;
					status_registrasi = `<span class=" badge bg-danger">Ditolak</span>`;
				}
				$("#body-view").html(
					`<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="table-responsive">
					<table class="table">
						<tbody>
							<tr>
								<th>Nama Developer :</th>
								<td>${value.register_name}</td>
							</tr>
							<tr>
								<th>E-mail Developer:</th>
								<td>${value.register_email}</td>
							</tr>
							<tr>
								<th>Telepon Developer:</th>
								<td>${value.register_phone}</td>
							</tr>
							<tr>
								<th>Alamat Developer :</th>
								<td>${value.register_address}</td>
							</tr>
							<tr>
								<th>Rekomendasi Oleh :</th>
								<td>${value.register_recomended_by}</td>
							</tr>
							<tr>
								<th>Status E-mail Verication:</th>
								<td>${status_email}</td>
                            </tr>
                            ${email_verify_date}
							<tr>
								<th>Status Registrasi:</th>
								<td>${status_registrasi}</td>
                            </tr>
                            ${approval_date}
							<tr>
								<th>Tanggal Registrasi:</th>
								<td>${formatDate("dd-mm-yyyy", value.register_created_date)}</td>
                            </tr>
                             <tr>
                            <th>File Registration :</th>
                            <td>
                               ${attachment}
                            </td>
                        </tr>
						</tbody>
					</table>
				</div>
				 </div>
				 <div class="col-md-6 col-sm-12">
                 <div id="map">

                 </div>
				 </div>
				 </div>
				`
				);
				map_address = value.register_address;
				lat = value.register_lat;
				lng = value.register_lng;
			});

			$("#footer-view").html(`
            ${btn_approval}
            `);
			initialize();
			console.log(map_address)
			// if (!lat & !lng) 
			codeAddress(map_address);
			google.maps.event.trigger(map, "resize");
		},
		error: function (xhr, status, error) {
			Swal.fire({ title: "Error", text: error, icon: "error" });
		},
	});
}

function approval(approval, email, code) {
	var text;
	if (approval == 1 || approval == "1") {
		text = "Approve";
	} else {
		text = "Reject";
	}
	Swal.fire({
		title: "Apakah Anda Yakin?",
		text: text,
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: `${base_url}members_registration/approval`,
				type: "POST",
				data: {
					approval: approval,
					email: email,
					code: code,
				},
				dataType: "json",
				success: function (data) {
					response = jQuery.parseJSON(JSON.stringify(data));
					if (response.is_success === true) {
						Swal.fire({
							title: response.message,
							// text: response.message,
							icon: "success",
						});
						$("#modalView").modal("hide");
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
}

function initialize(lat, lng) {
	geocoder = new google.maps.Geocoder();
	if(lat && lng) {
		var latlng = new google.maps.LatLng(lat, lng);
	} else {
		var latlng = new google.maps.LatLng(-6.2295712, 106.759478);
	}
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

function codeAddress(adress) {
	var address = adress;
	geocoder.geocode(
		{
			address: address,
		},
		function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				is_searched = true;
				if (marker) {
					marker.setMap(null);
					if (infowindow) infowindow.close();
				}
				marker = new google.maps.Marker({
					map: map,
					draggable: false,
					position: results[0].geometry.location,
				});
				map.fitBounds(results[0].geometry.viewport);
				google.maps.event.addListener(marker, "dragend", function () {
					geocodePosition(marker.getPosition());
				});
			} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		}
	);
}
