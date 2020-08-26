$(function () {
	var myTable = $("#table_kota").DataTable({
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
			url: `${base_url}data_kota/getList`,
			type: "POST",
			data: function (d) {
				// d.id_region = $('#region').val();
			},
		},
		initComplete: function (settings, json) {
			$("#table_kota_filter input").unbind();
			$("#table_kota_filter input").bind("keyup", function (e) {
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
							$("#table_kota").DataTable().ajax.reload(null, false);
						},
						error: function (xhr, status, error) {
							Swal.fire({ title: "Error", text: error, icon: "error" });
							$("#table_kota").DataTable().ajax.reload(null, false);
						},
					});
				}
			});
		},
	});
	$("#form").validate({
		rules: {
			kota_name: {
				required: true,
				minlength: 5,
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
	$("#modalHeaderText").html("Add New Kota");
	showModal();
}

function showModal() {
	$("#form").trigger("reset");
	$("#modalAddEdit").modal("show");
}
function hideModal() {
	$("#modalAddEdit").modal("hide");
}

function edit(e) {
	$("#modalHeaderText").html("Edit Kota");
	showModal();
	jQuery.ajax({
		type: "post",
		data: {
			id: e,
		},
		url: `${base_url}data_kota/getOne`,
		dataType: "json",
		success: function (e) {
			jQuery("#kota_id").val(e[0].kota_id);
			jQuery("#kota_name").val(e[0].kota_name);
			jQuery("#kota_nameOld").val(e[0].kota_name);
		},
	});
}

function deleteData(id) {
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
				url: `${base_url}data_kota/delete`,
				type: "POST",
				data: {
					id: id,
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
					$("#table_kota").DataTable().ajax.reload(null, false);
				},
				error: function (xhr, status, error) {
					Swal.fire({ title: "Error", text: error, icon: "error" });
					$("#table_kota").DataTable().ajax.reload(null, false);
				},
			});
		}
	});
}
