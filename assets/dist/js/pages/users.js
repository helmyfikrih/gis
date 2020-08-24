$(function () {
	$("#user_birth_date").datepicker({
		format: "dd-mm-yyyy",
		autoclose: true,
	});
	$(".select2bs4").select2({
		theme: "bootstrap4",
		placeholder: "Pilih salah satu...",
		allowClear: true,
	});
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
			url: `${base_url}users/getList`,
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

	$("#accordion3 input:checkbox").click(function () {
		var e = $(this).attr("id");
		var t = $(this).val();

		if ($(this).is(":checked")) {
			$(".down_" + t + " :checkbox").prop("checked", true);
		} else {
			$(".down_" + t + " :checkbox").prop("checked", false);
		}
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

	$("#form").validate({
		ignore: [],
		rules: {
			user_username: {
				required: true,
				minlength: 5,
			},
			user_email: {
				required: true,
				email: true,
				minlength: 5,
			},
			user_role: {
				required: true,
			},
			user_status: {
				required: true,
			},
			user_full_name: {
				required: true,
			},
			user_phone: {
				required: true,
			},
			user_birth_date: {
				required: true,
			},
			user_birth_place: {
				required: true,
				minlength: 5,
			},
			user_address: {
				required: true,
				minlength: 5,
			},
			user_gender: {
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
});
function addNew() {
	$("#form").trigger("reset");
	$(".modalHeaderText").html("Add New Role");
	showModal();
	$("#user_password").attr("required", true);
}

function showModal() {
	$("#form").trigger("reset");
	$("#user_password").attr("placeholder", "Password");
	$("#modalAddEdit").modal("show");
}
function hideModal() {
	$("#modalAddEdit").modal("hide");
}

function ngeklik() {
	var e = [];
	$("#accordion3 input:checked").each(function () {
		e.push($(this).val());
	});
	$("#imenu").html(e.toString());
}

function view(e) {
	$("#modalView").modal("show");
	jQuery.ajax({
		type: "post",
		data: {
			id: e,
		},
		url: `${base_url}users/getOne`,
		dataType: "json",
		success: function (e) {
			$(".modalHeaderText").html(`Detail User ${e[0].ud_full_name}`);
			$("#body-view").html(
				`  <div class="table-responsive">
					<table class="table">
						<tbody>
							<tr>
								<th style="width:50%">Full Name :</th>
								<td>${e[0].ud_full_name}</td>
							</tr>
							<tr>
								<th>Username:</th>
								<td>${e[0].user_username}</td>
							</tr>
							<tr>
								<th>E-mail:</th>
								<td>${e[0].user_email}</td>
							</tr>
							<tr>
								<th>Phone Number:</th>
								<td>${e[0].ud_phone}</td>
							</tr>
							<tr>
								<th>Birth Date:</th>
								<td>${formatDate("dd-mm-yyyy", e[0].ud_birth_date)}</td>
							</tr>
							<tr>
								<th>Birth Place:</th>
								<td>${e[0].ud_birth_place}</td>
							</tr>
							<tr>
								<th>Gender:</th>
								<td>${
									e[0].ud_gender == "P"
										? "Perempuan"
										: e[0].ud_gender == "L"
										? "Laki-Laki"
										: ""
								}</td>
							</tr>
							<tr>
								<th>Address:</th>
								<td>${e[0].ud_address}</td>
							</tr>
							<tr>
								<th>Role:</th>
								<td>${e[0].role_name}</td>
							</tr>
							<tr>
								<th>Status:</th>
								<td>${
									e[0].user_status == 1
										? "Active"
										: e[0].user_status == 0
										? "Inactive"
										: ""
								}</td>
							</tr>
						</tbody>
					</table>
				</div>`
			);
		},
		error: function (xhr, status, error) {
			Swal.fire({ title: "Error", text: error, icon: "error" });
		},
	});
}

function edit(e) {
	$(".modalHeaderText").html("Edit User");
	showModal();
	jQuery.ajax({
		type: "post",
		data: {
			id: e,
		},
		url: `${base_url}users/getOne`,
		dataType: "json",
		success: function (e) {
			$("#user_password").attr(
				"placeholder",
				"Kosongkan Jika Tidak Ingin Diubah"
			);
			$("#user_password").attr("required", false);
			jQuery("#user_id").val(e[0].uid);
			jQuery("#user_username").val(e[0].user_username);
			jQuery("#user_email").val(e[0].user_email);
			jQuery("#user_role").val(e[0].role_id).trigger("change");
			jQuery("#user_status").val(e[0].user_status).trigger("change");
			jQuery("#user_full_name").val(e[0].ud_full_name);
			jQuery("#user_phone").val(e[0].ud_phone);
			jQuery("#user_birth_place").val(e[0].ud_birth_place);
			$("#user_birth_date").datepicker(
				"update",
				formatDate("dd-mm-yyyy", e[0].ud_birth_date)
			);
			jQuery("#user_address").val(e[0].ud_address);
			jQuery("#user_gender").val(e[0].ud_gender).trigger("change");
		},
		error: function (xhr, status, error) {
			Swal.fire({ title: "Error", text: error, icon: "error" });
		},
	});
}

function deleteData(uid, uname) {
	Swal.fire({
		title: "Apakah Anda Yakin?",
		text: "Data akan dihapus secara permanen dan tidak dapat dikembalikan.",
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#3085d6",
		confirmButtonText: "Yes",
	}).then((result) => {
		if (result.value) {
			var myForm = $("#form")[0];
			$.ajax({
				url: `${base_url}users/delete`,
				type: "POST",
				data: {
					uid: uid,
					uname: uname,
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

$("#form").on("reset", function (e) {
	$("#user_birth_date").datepicker("update", "");
	$(".select2bs4").val("").trigger("change");
	$(".is-invalid").removeClass("is-invalid");
});

// Vorm Validation
$(".select-form").on("change", function (e) {
	// Do something
	var is_invalid = $(".is-invalid");
	if (is_invalid.hasClass("is-invalid")) {
		$("#form").valid();
	}
});
$(".date-form").on("change", function (e) {
	// Do something
	var is_invalid = $(".is-invalid");
	if (is_invalid.hasClass("is-invalid")) {
		$("#form").valid();
	}
});
