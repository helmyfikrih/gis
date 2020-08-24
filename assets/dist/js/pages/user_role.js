$(function () {
	var myTable = $("#table_role").DataTable({
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
			url: `${base_url}user_role/getList`,
			type: "POST",
			data: function (d) {
				// d.id_region = $('#region').val();
			},
		},
		initComplete: function (settings, json) {
			$("#table_role_filter input").unbind();
			$("#table_role_filter input").bind("keyup", function (e) {
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
							$("#table_role").DataTable().ajax.reload(null, false);
						},
						error: function (xhr, status, error) {
							Swal.fire({ title: "Error", text: error, icon: "error" });
							$("#table_role").DataTable().ajax.reload(null, false);
						},
					});
				}
			});
		},
	});
	$("#form").validate({
		rules: {
			role_code: {
				required: true,
				minlength: 3,
			},
			role_name: {
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
	$("#modalHeaderText").html("Add New Role");
	showModal();
}

function showModal() {
	$("#form").trigger("reset");
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

function edit(e) {
	$("#modalHeaderText").html("Edit Role");
	showModal();
	jQuery.ajax({
		type: "post",
		data: {
			id: e,
		},
		url: `${base_url}user_role/getOne`,
		dataType: "json",
		success: function (e) {
			jQuery("#role_id").val(e[0].role_id);
			jQuery("#role_name").val(e[0].role_name);
			jQuery("#role_code").val(e[0].role_code);
			jQuery("#role_nameOld").val(e[0].role_name);
			jQuery("#role_codeOld").val(e[0].role_code);
			var t = e[0].role_allow_menu.split(",");
			for (i = 0; i < t.length; i++) {
				$("#box_" + t[i]).prop("checked", true);
				// $("#box_" + t[i]).attr("checked", "checked")
			}
		},
	});
}

$("#form").on("reset", function (e) {
	$("input:checkbox").removeAttr("checked");
});

function deleteData(rid, rcode) {
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
				url: `${base_url}user_role/delete`,
				type: "POST",
				data: {
					rid: rid,
					rcode: rcode,
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
					$("#table_role").DataTable().ajax.reload(null, false);
				},
				error: function (xhr, status, error) {
					Swal.fire({ title: "Error", text: error, icon: "error" });
					$("#table_role").DataTable().ajax.reload(null, false);
				},
			});
		}
	});
}
