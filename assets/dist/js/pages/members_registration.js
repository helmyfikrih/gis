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
					approval_date = ` <tr>
                                        <th>Tanggal Approval Registrasi :</th>
                                        <td>${formatDate(
																					"dd-mm-yyyy",
																					value.register_last_update
																				)}</td>
                                    </tr>
                    `;
					status_registrasi = `<span class=" badge bg-success">Sudah Terverifikasi</span>`;
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
                            
						</tbody>
					</table>
				</div>
				 </div>
				 <div class="col-md-6 col-sm-12">
				 <div class="text-center" id="map">
   
                 </div>
                 <table class="table">
                    <tbody>
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
				`
				);
			});

			$("#footer-view").html(`
                    <button type="button" class="btn btn-danger">Reject</button>
                    <button type="button" class="btn btn-info">Approve</button>
            `);
			$(".profile-img-clickable").colorbox({
				rel: "profile-img-clickable",
				transition: "fade",
				scalePhotos: true,
				maxWidth: "100%",
				maxHeight: "100%",
			});
		},
		error: function (xhr, status, error) {
			Swal.fire({ title: "Error", text: error, icon: "error" });
		},
	});
}

function approval() {
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
}
