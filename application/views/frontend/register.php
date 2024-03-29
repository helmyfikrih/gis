   <!-- inner page banner -->
   <style>
       label {
           color: #333;
       }
   </style>
   <div id="inner_banner" class="section inner_banner_section">
       <div class="container">
           <div class="row">
               <div class="col-md-12">
                   <div class="full">
                       <div class="title-holder">
                           <div class="title-holder-cell text-left">
                               <h1 class="page-title">
                                   Daftar Keanggotaan
                               </h1>
                               <ol class="breadcrumb">
                                   <li><a href="index.html">Home</a></li>
                                   <li class="active">Daftar Keanggotaan</li>
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
       <div class="container">
           <div class="row" style="padding-top: 5%; padding-bottom:5%;">

               <div class="col-md-12">
                   <div class="payment-form">
                       <div class="col-xs-12 col-md-12">
                           <!-- CREDIT CARD FORM STARTS HERE -->
                           <div class="panel panel-default credit-card-box">
                               <form action="<?= base_url('auth/register') ?>" id="form_register">
                                   <div class="panel-heading display-table">
                                       <div class="display-tr">
                                           <h3 class="panel-title display-td">Pendaftaran Anggota Baru</h3>
                                           <div class="display-td"> </div>
                                       </div>
                                   </div>
                                   <div class="panel-body">
                                       <div class="col-md-12">
                                           <fieldset>
                                               <div class="row">
                                                   <!-- <div class="col-md-6">
                                                       <div class="form-group">
                                                           <label>Bottle <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="orderBottle_1" id="orderBottle_1" type="text" class="form-control">
                                                           <input name="orderBottle_2" id="orderBottle_2" type="text" class="form-control">
                                                           <input name="orderBottle_3" id="orderBottle_3" type="text" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                       <div class="form-group">
                                                           <label>carton <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="orderCarton_1" id="orderCarton_1" type="text" class="form-control">
                                                           <input name="orderCarton_2" id="orderCarton_2" type="text" class="form-control">
                                                           <input name="orderCarton_3" id="orderCarton_3" type="text" class="form-control">
                                                       </div>
                                                   </div>
                                                   <button type="button" onclick="mappingData()">MAPPING</button> -->
                                                   <div class="col-md-6">
                                                       <div class="form-group">
                                                           <label>Username <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="username" id="username" type="text" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                       <div class="form-group">
                                                           <label>Email <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="email" id="email" type="email" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                       <div class="form-group">
                                                           <label>Password <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="password" id="password" type="password" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                       <div class="form-group">
                                                           <label>Ulangi Password <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="password_confirm" id="password_confirm" type="password" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label>Nama Developer<span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="developer_name" id="developer_name" type="text" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label>Kota Developer<span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <select name="kota" id="kota" class="form-control select2bs4 select-form">
                                                               <option></option>
                                                               <?php foreach ($select_kota as $kota) { ?>
                                                                   <option value="<?= $kota->kota_id ?>"><?= $kota->kota_name ?></option>
                                                               <?php } ?>
                                                           </select>
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label>Kecamatan Developer<span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <select name="kecamatan" id="kecamatan" class="form-control select2bs4 select-form">
                                                           </select>
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label>Address <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <textarea name="address" id="address" class="form-control"></textarea>
                                                           <input name="loc_lat" id="loc_lat" type="text" readonly hidden class="form-control">
                                                           <input name="loc_lng" id="loc_lng" type="text" readonly hidden class="form-control">
                                                           <button onclick="codeAddress()" type="button" class="btn btn-info btn-small"> Search</button>
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <div id="map"></div>
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label>Phone <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="phone" id="phone" type="text" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label>Rekomendasi Oleh <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i> (Pisahkan Dengan Koma)</span></label>
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
                                                           <label>1. Pasphoto Direktur Utama, ukuran 4 x6 <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="f_pasphoto" id="pasphoto" type="file" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label>2. Scan/File KTP Direktur Utama <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="f_ktp" type="file" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label>3. Scan/File Akte Pendirian Perusahaan / akte perubahab yang menyebutkan bidang usaha Realestat / sebagai pengembang <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="f_akte" type="file" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label>4. Scan/File Surat Keterangan Domisili Perusahaan di Jakarta <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="f_keterangan" type="file" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label>5. Scan/File Nomor Pokok Wajib Pajak ( NPWP ) <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="f_npwp" type="file" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label>6. Scan/File Surat Ijin Usaha Perdagangan ( SIUP ) <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="f_siup" type="file" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label>7. Scan/File Tanda Daftar Perusahaan ( TDP ) <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="f_tdp" type="file" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label>8. File Susunan Dewan Komisaris / Direksi ( Nama & Jabatan ) serta struktur Organisasi Perusahaan <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="f_susunan_dewan" type="file" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label>9. Scan/File Surat pernyataan kesediaan untuk mematuhi semua ketentuan / peraturan yang berlaku, dan menjalankan etika profesi sesuai Saptabrata REI (dibuat diatas kop surat perusahaan & ditandatangani diatas meterai). <span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span></label>
                                                           <input name="f_pernyataan" type="file" class="form-control">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <input name="agreement" id="agreement" type="checkbox">
                                                           <span class="crte-ac">Saya Bersedia Mengikuti <a href="<?=base_url()?>assets\files\SYARAT_DAN_KEBIJAKAN_REI_DKI_JAKARTA.pdf" target="_blank" style="color: blue;"> Kebijakan dan Ketentuan </a> Yang Berlaku.</span><span class="red"><i class="fa fa-asterisk" style="color: red;" aria-hidden="true"></i></span> </div>
                                                   </div>
                                               </div>
                                           </fieldset>
                                           <div class="text-center">
                                               <button type="submit" class="btn btn-info btn-small"> Register</button>
                                           </div>
                                       </div>
                                   </div>
                               </form>
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
   <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkUOdZ5y7hMm0yrcCQoCvLwzdM6M8s5qk=id&region=id"></script> -->
   <!-- end google map js -->
