$(function () {
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
					$.ajax({
						url: $(form).attr("action"),
						type: "POST",
						data: new FormData(form),
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
								}).then((result) => {
									location.reload();
								});
							} else {
								Swal.fire({
									title: "Warning",
									text: response.message,
									icon: "warning",
								});
							}
						},
						error: function (xhr, status, error) {
							Swal.fire({ title: "Error", text: error, icon: "error" });
						},
					});
				}
			});
		},
	});
	$("#generalForm").validate({
		ignore: [],
		rules: {
			application_name: {
				required: true,
				minlength: 5,
			},
			application_about: {
				required: true,
				minlength: 5,
			},
			header_name: {
				required: true,
			},
			footer_text: {
				required: true,
			},
			footer_year: {
				required: true,
			},
		},
		messages: {},
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

	$("#logoForm").validate({
		ignore: [],
		rules: {},
		messages: {},
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
	$("#smtpForm").validate({
		ignore: [],
		rules: {},
		messages: {},
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
