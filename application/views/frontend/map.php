   <!-- inner page banner -->
   <div id="inner_banner" class="section inner_banner_section">
   	<div class="container">
   		<div class="row">
   			<div class="col-md-12">
   				<div class="full">
   					<div class="title-holder">
   						<div class="title-holder-cell text-left">
   							<h1 class="page-title">
   								Peta Sebaran Anggota REI DKI Jakarta
   							</h1>
   							<ol class="breadcrumb">
   								<li><a href="index.html">Home</a></li>
   								<li class="active">Peta Sebaran Anggota REI DKI Jakarta</li>
   							</ol>
   						</div>
   					</div>
   				</div>
   			</div>
   		</div>
   	</div>
   </div>
   <!-- end inner page banner -->
   <!-- section -->
   <div class="section">
   	<div class="row" style="padding: 5%;">
   		<div class="col-md-3">
   			<div class="side_bar">
   				<div class="side_bar_blog">
   					<h4>Search</h4>
   					<div class="side_bar_search">
   						<div class="input-group stylish-input-group">
   							<input class="form-control" placeholder="Search" id="f_search" type="text" />
   							<span class="input-group-addon" onclick="filter_persebaran()" style="cursor: pointer;">
   								<button type="button" style="cursor: pointer;">
   									<i class="fa fa-search" aria-hidden="true"></i>
   								</button>
   							</span>
   						</div>
   					</div>
   				</div>
   				<div class="side_bar_blog">
   					<h4>LEGENDA</h4>
   					<span>
   						<p><img src="<?=base_url('assets/frontend/images/it_service/user_position.png')?>" width="40px" alt=""> Posisi Saat Ini</p>
   						<p><img src="<?=base_url('assets/frontend/images/it_service/location_icon_map_cont.png')?>" width="40px" alt=""> Posisi Developer</p>
   					</span>
   				</div>
   				<div class="side_bar_blog">
   					<h4>KATEGORI KEANGGOTAAN</h4>
   					<div class="categary">
   						<select class="form-control select2 select2-blue" name="" id="">
   							<option value="0" selected>ALL</option>
   							<option value="asas">asas</option>
   						</select>
   					</div>
   				</div>
   				<div class="side_bar_blog">
   					<h4>KOTA</h4>
   					<div class="categary">
   						<select class="form-control select2 select2-blue" name="f_kota" id="f_kota">
   							<option value="0" selected>ALL</option>
   							<?php foreach ($select_kota as $kota) : ?>
   								<option value="<?= $kota->kota_id ?>"><?= strtoupper($kota->kota_name) ?></option>
   							<?php endforeach; ?>
   						</select>

   						<input type="text" value="0" id="curr_lat" hidden />
   						<input type="text" value="0" id="curr_lng" hidden />
   					</div>
   				</div>
   				<div class="side_bar_blog">
   					<h4>KECAMATAN</h4>
   					<div class="categary">
   						<select class="form-control select2 select2-blue" name="f_kecamatan" id="f_kecamatan">
   							<option value="0" selected>ALL</option>
   						</select>

   						<input type="text" value="0" id="curr_lat" hidden />
   						<input type="text" value="0" id="curr_lng" hidden />
   					</div>
   				</div>
   			</div>
   		</div>
   		<div class="col-md-9">
   			<div class="row">
   				<div class="col-xl-12 col-lg-12 col-md-12">
   					<div id="map"></div>
   				</div>
   			</div>
   			<div class="row">
   				<div class="col-md-12">
   					<div class="full">
   						<div class="tab_bar_section">
   							<ul class="nav nav-tabs" id="tabMap" role="tablist">
   								<li class="nav-item">
   									<a class="nav-link" data-toggle="tab" href="#result">Result</a>
   								</li>
   								<li class="nav-item">
   									<a class="nav-link" data-toggle="tab" href="#direction">Direction</a>
   								</li>
   								<li class="nav-item">
   									<a class="nav-link" data-toggle="tab" href="#portofolio">Portofolio <span id="portofolio_num"></span></a>
   								</li>
   							</ul>
   							<!-- Tab panes -->
   							<div class="tab-content">
   								<div id="result" class="tab-pane">
   									<div class="product_desc">
   										<div id="result_filter"></div>
   									</div>
   								</div>
   								<div id="direction" class="tab-pane">
   									<div class="product_desc">
   										<div id="directions"></div>
   									</div>
   								</div>
   								<div id="portofolio" class="tab-pane fade">
   									<div class="product_review portofolio_list">
   										<div class="row">
   										</div>
   									</div>
   								</div>
   							</div>
   						</div>
   					</div>
   				</div>
   			</div>
   		</div>
   	</div>

   </div>
   <!-- end section -->

   <!-- google map js -->
   <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script> -->
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAl9LtfJKn0c-q5ebjAaJfil1ghK6J6TSk&language=id&region=id&libraries=geometry"></script>
   <!-- end google map js -->
