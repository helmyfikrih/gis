$(function () {
	if ($("textarea").hasClass("editor")) {
		var editor = CKEDITOR.replace("news_body");
		CKFinder.setupCKEditor(editor);

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
										window.location.replace(`${base_url}news`);
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
								$("#datatables").DataTable().ajax.reload(null, false);
							},
						});
					}
				});
			},
		});

		$("#news_form").validate({
			ignore: [],
			rules: {
				news_title: {
					required: true,
					minlength: 5,
				},
				news_body: {
					minlength: 5,
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
	}

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
			url: `${base_url}news/getList`,
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

function deleteData(nid, nslug) {
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
			$.ajax({
				url: `${base_url}news/delete`,
				type: "POST",
				data: {
					nid: nid,
					nslug: nslug,
				},
				dataType: "json",
				success: function (data) {
					response = jQuery.parseJSON(JSON.stringify(data));
					if (response.is_success === true) {
						Swal.fire({
							title: response.message,
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
