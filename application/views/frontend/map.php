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
   							<input class="form-control" placeholder="Search" type="text" />
   							<span class="input-group-addon">
   								<button type="submit">
   									<i class="fa fa-search" aria-hidden="true"></i>
   								</button>
   							</span>
   						</div>
   					</div>
   				</div>
   				<div class="side_bar_blog">
   					<h4>LEGENDA</h4>
   					<span>
   						<p><i class="fa fa-home" style="color: red;"></i> adas</p>
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
   						<select class="form-control select2 select2-blue" name="filter_kota" id="filter_kota">
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
   						<select class="form-control select2 select2-blue" name="filter_kec" id="filter_kec">
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
   							<ul class="nav nav-tabs" role="tablist">
   								<li class="nav-item">
   									<a class="nav-link active" data-toggle="tab" href="#direction">Direction</a>
   								</li>
   								<li class="nav-item">
   									<a class="nav-link" data-toggle="tab" href="#reviews">Reviews (2)</a>
   								</li>
   							</ul>
   							<!-- Tab panes -->
   							<div class="tab-content">
   								<div id="direction" class="tab-pane active">
   									<div class="product_desc">
   										<div id="directions"></div>
   									</div>
   								</div>
   								<div id="reviews" class="tab-pane fade">
   									<div class="product_review">
   										<h3>Reviews (2)</h3>
   										<div class="commant-text row">
   											<div class="col-lg-2 col-md-2 col-sm-4">
   												<div class="profile">
   													<img class="img-responsive" src="<?= base_url() ?>assets/frontend/images/it_service/client1.png" alt="#" />
   												</div>
   											</div>
   											<div class="col-lg-10 col-md-10 col-sm-8">
   												<h5>David</h5>
   												<p>
   													<span class="c_date">March 2, 2018</span> |
   													<span><a rel="nofollow" class="comment-reply-link" href="#">Reply</a></span>
   												</p>
   												<span class="rating">
   													<i class="fa fa-star" aria-hidden="true"></i>
   													<i class="fa fa-star" aria-hidden="true"></i>
   													<i class="fa fa-star" aria-hidden="true"></i>
   													<i class="fa fa-star" aria-hidden="true"></i>
   													<i class="fa fa-star-o" aria-hidden="true"></i>
   												</span>
   												<p class="msg">
   													ThisThis book is a treatise on the theory of
   													ethics, very popular during the Renaissance. The
   													first line of Lorem Ipsum, “Lorem ipsum dolor
   													sit amet..
   												</p>
   											</div>
   										</div>
   										<div class="commant-text row">
   											<div class="col-lg-2 col-md-2 col-sm-4">
   												<div class="profile">
   													<img class="img-responsive" src="<?= base_url() ?>assets/frontend/images/it_service/client2.png" alt="#" />
   												</div>
   											</div>
   											<div class="col-lg-10 col-md-10 col-sm-8">
   												<h5>Jack</h5>
   												<p>
   													<span class="c_date">March 2, 2018</span> |
   													<span><a rel="nofollow" class="comment-reply-link" href="#">Reply</a></span>
   												</p>
   												<span class="rating">
   													<i class="fa fa-star" aria-hidden="true"></i>
   													<i class="fa fa-star" aria-hidden="true"></i>
   													<i class="fa fa-star" aria-hidden="true"></i>
   													<i class="fa fa-star" aria-hidden="true"></i>
   													<i class="fa fa-star-o" aria-hidden="true"></i>
   												</span>
   												<p class="msg">
   													Nunc augue purus, posuere in accumsan sodales
   													ac, euismod at est. Nunc faccumsan ermentum
   													consectetur metus placerat mattis. Praesent
   													mollis justo felis, accumsan faucibus mi maximus
   													et. Nam hendrerit mauris id scelerisque
   													placerat. Nam vitae imperdiet turpis
   												</p>
   											</div>
   										</div>
   										<div class="row">
   											<div class="col-sm-12">
   												<div class="full review_bt_section">
   													<div class="float-right">
   														<a class="btn sqaure_bt" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Leave a Review</a>
   													</div>
   												</div>
   												<div class="full">
   													<div id="collapseExample" class="full collapse commant_box">
   														<form accept-charset="UTF-8" action="index.html" method="post">
   															<input id="ratings-hidden" name="rating" type="hidden" />
   															<textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." required=""></textarea>
   															<div class="full_bt center">
   																<button class="btn sqaure_bt" type="submit">
   																	Save
   																</button>
   															</div>
   														</form>
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
   		</div>
   	</div>

   </div>
   <!-- end section -->

   <!-- google map js -->
   <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script> -->
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAl9LtfJKn0c-q5ebjAaJfil1ghK6J6TSk&language=id&region=id"></script>
   <!-- end google map js -->
