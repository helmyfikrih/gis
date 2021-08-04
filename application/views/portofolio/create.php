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
					<h1 class="m-0 text-dark">Create Portofolio</h1>
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
							<h3 class="card-title text-left">Create New Portofolio</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<form action="<?= base_url('portofolio/save') ?>" id="form_register" class="form-horizontal">
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
												<div class="col-md-12">
													<div class="form-group">
														<label>Nama Portofolio</label>
														<input name="portofolio_name" id="portofolio_name" type="text" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Email Portofolio</label>
														<input name="portofolio_email" id="portofolio_email" type="email" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Tanggal Buat</label>
														<input name="portofolio_start_date" id="portofolio_start_date" type="date" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Tanggal Selesai</label>
														<input name="portofolio_end_date" id="portofolio_end_date" type="date" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Phone <span class="red">*</span></label>
														<input name="phone" id="phone" type="text" class="form-control">
													</div>
												</div>
												<!-- <div class="col-md-12">
													<div class="form-group">
														<label>Kota Portofolio</label>
														<select name="kota" id="kota" class="form-control select2">
															<option></option>
															<?php foreach ($select_kota as $kota) { ?>
																<option value="<?= $kota->kota_id ?>"><?= $kota->kota_name ?></option>
															<?php } ?>
														</select>
													</div>
												</div> -->
												<!-- <div class="col-md-12">
													<div class="form-group">
														<label>Kecamatan Portofolio</label>
														<select name="kecamatan" id="kecamatan" class="form-control select2">
														</select>
													</div>
												</div> -->
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
