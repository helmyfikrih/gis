$(function () {
	$(".profile-img-clickable").colorbox({
		rel: "profile-img-clickable",
		transition: "fade",
		maxWidth: "100%",
		maxHeight: "100%",
	});
	$("#image_crop").hide("slow");
	// Image Croper
	$("#upload_image").on("change", function () {
		$("#image_crop").show("slow");
		var reader = new FileReader();
		reader.onload = function (event) {
			$image_crop
				.croppie("bind", {
					url: event.target.result,
				})
				.then(function () {});
		};
		reader.readAsDataURL(this.files[0]);
	});
	$image_crop = $("#image_crop").croppie({
		enableExif: true,
		viewport: {
			width: 400,
			height: 400,
			type: "square", //circle
		},
		boundary: {
			width: 500,
			height: 500,
		},
	});
	$("#saveAvatar").click(function (event) {
		$image_crop
			.croppie("result", {
				type: "canvas",
				size: "viewport",
			})
			.then(function (response) {
				$.ajax({
					url: `${base_url}profile/saveChangeAvatar`,
					type: "POST",
					data: { image: response },
					dataType: "json",
					success: function (data) {
						response = jQuery.parseJSON(JSON.stringify(data));
						Swal.fire({
							title: response.message,
							// text: response.message,
							icon: "success",
						}).then((result) => {
							location.reload();
						});
					},
				});
			});
	});
	$("#birth_date").datepicker({
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

	$("#form-profile").validate({
		ignore: [],
		rules: {
			username: {
				required: true,
				minlength: 5,
			},
			email: {
				required: true,
				email: true,
			},
			full_name: {
				required: true,
				minlength: 5,
			},
			birth_place: {
				required: true,
				minlength: 5,
			},
			birth_date: {
				required: true,
				minlength: 5,
			},
			address: {
				required: true,
				minlength: 5,
			},
			user_gender: {
				required: true,
			},
		},
		messages: {},
		errorElement: "span",
		errorPlacement: function (error, element) {
			error.addClass("invalid-feedback");
			element.closest(".form-group-h").append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid");
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass("is-invalid");
		},
	});

	$("#form-change-password").validate({
		ignore: [],
		rules: {
			password_old: {
				required: true,
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
		},
		messages: {},
		errorElement: "span",
		errorPlacement: function (error, element) {
			error.addClass("invalid-feedback");
			element.closest(".form-group-h").append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid");
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass("is-invalid");
		},
	});
});

function changeAvatar() {
	$("#modalChangeAvatar").modal("show");
}
