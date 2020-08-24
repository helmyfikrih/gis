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
