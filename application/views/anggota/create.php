<style>
	#map {
		width: 100%;
		height: 50%;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Create Member</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Manage</a></li>
						<li class="breadcrumb-item"><a href="#">Members</a></li>
						<li class="breadcrumb-item active">Create</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title text-left">Create New Anggota</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<form action="<?= base_url('anggota/save') ?>" id="form_register" class="form-horizontal">
								<div class="panel-heading display-table">
									<div class="display-tr">
										<h3 class="panel-title display-td">Data Pribadi</h3>
										<div class="display-td"> </div>
									</div>
								</div>
								<div class="panel-body">
									<div class="col-md-12">
										<fieldset>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Username <span class="red">*</span></label>
														<input name="username" id="username" type="text" class="form-control">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Email <span class="red">*</span></label>
														<input name="email" id="email" type="email" class="form-control">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Password <span class="red">*</span></label>
														<input name="password" id="password" type="password" class="form-control">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Ulangi Password <span class="red">*</span></label>
														<input name="password_confirm" id="password_confirm" type="password" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Nama Developer</label>
														<input name="developer_name" id="developer_name" type="text" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Kota Developer</label>
														<select name="kota" id="kota" class="form-control select2">
															<option></option>
															<?php foreach ($select_kota as $kota) { ?>
																<option value="<?= $kota->kota_id ?>"><?= $kota->kota_name ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Kecamatan Developer</label>
														<select name="kecamatan" id="kecamatan" class="form-control select2">
														</select>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Address <span class="red">*</span></label>
														<textarea name="address" id="address" class="form-control"></textarea>
														<input name="loc_lat" id="loc_lat" type="text" readonly hidden class="form-control">
														<input name="loc_lng" id="loc_lng" type="text" readonly hidden class="form-control">
														<button onclick="codeAddress()" type="button" class="btn btn-info btn-small"> Search</button>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<div id="map" style="min-height: 40vh;"></div>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Phone <span class="red">*</span></label>
														<input name="phone" id="phone" type="text" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Rekomendasi Oleh <span class="red">* (Pisahkan Dengan Koma)</span></label>
														<input name="recomendation" id="recomendation" type="text" class="form-control">
													</div>
												</div>
											</div>
										</fieldset>
									</div>
								</div>

								<div class="panel-heading display-table">
									<div class="display-tr">
										<h3 class="panel-title display-td">Dokumen Pendaftaran</h3>
										<div class="display-td"> </div>
									</div>
								</div>
								<div class="panel-body">
									<div class="col-md-12">
										<fieldset>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>1. Pasphoto Direktur Utama, ukuran 4 x6 <span class="red">*</span></label>
														<input name="f_pasphoto" id="pasphoto" type="file" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>2. Scan/File KTP Direktur Utama <span class="red">*</span></label>
														<input name="f_ktp" type="file" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>3. Scan/File Akte Pendirian Perusahaan / akte perubahab yang menyebutkan bidang usaha Realestat / sebagai pengembang <span class="red">*</span></label>
														<input name="f_akte" type="file" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>4. Scan/File Surat Keterangan Domisili Perusahaan di Jakarta <span class="red">*</span></label>
														<input name="f_keterangan" type="file" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>5. Scan/File Nomor Pokok Wajib Pajak ( NPWP ) <span class="red">*</span></label>
														<input name="f_npwp" type="file" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>6. Scan/File Surat Ijin Usaha Perdagangan ( SIUP ) <span class="red">*</span></label>
														<input name="f_siup" type="file" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>7. Scan/File Tanda Daftar Perusahaan ( TDP ) <span class="red">*</span></label>
														<input name="f_tdp" type="file" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>8. File Susunan Dewan Komisaris / Direksi ( Nama & Jabatan ) serta struktur Organisasi Perusahaan <span class="red">*</span></label>
														<input name="f_susunan_dewan" type="file" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>9. Scan/File Surat pernyataan kesediaan untuk mematuhi semua ketentuan / peraturan yang berlaku, dan menjalankan etika profesi sesuai Saptabrata REI (dibuat diatas kop surat perusahaan & ditandatangani diatas meterai). <span class="red">*</span></label>
														<input name="f_pernyataan" type="file" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input name="agreement" id="agreement" type="checkbox">
														<span class="crte-ac">Saya Bersedia Mengikuti Kebijakan dan Ketentuan Yang Berlaku.</span>
													</div>
												</div>
											</div>
										</fieldset>
									</div>
								</div>
						</div>
						<!-- /.card-body -->
						<div class="card-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
					</form>
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<!-- Modals -->

	<!-- /.modal -->
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAl9LtfJKn0c-q5ebjAaJfil1ghK6J6TSk&language=id&region=id"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkUOdZ5y7hMm0yrcCQoCvLwzdM6M8s5qk=id&region=id"></script> -->
