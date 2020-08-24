<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= $user_session->ud_img_url ? $user_session->ud_img_url : base_url() . "assets/dist/img/avatar04.png"; ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $user_session->ud_full_name ?></h3>

                            <p class="text-muted text-center"><?= $user_session->role_name ?></p>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#detail" data-toggle="tab">Detail</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="detail">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th style="width:50%">Full Name :</th>
                                                    <td><?= esc($user_session->ud_full_name) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Username:</th>
                                                    <td><?= esc($user_session->user_username) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>E-mail:</th>
                                                    <td><?= esc($user_session->user_email) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Phone Number:</th>
                                                    <td><?= esc($user_session->ud_phone) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Birth Date:</th>
                                                    <td><?= date("d-m-Y", strtotime($user_session->ud_birth_date)) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Birth Place:</th>
                                                    <td><?= esc($user_session->ud_birth_place) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Gender:</th>
                                                    <td><?= getUserGenderString($user_session->ud_gender) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Address:</th>
                                                    <td><?= esc($user_session->ud_address) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Role:</th>
                                                    <td><?= esc($user_session->role_name) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Status:</th>
                                                    <td><?= esc(getUserStatusString($user_session->user_status)) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings">
                                    <div class="card card-primary card-outline card-tabs">
                                        <div class="card-header p-0 pt-1 border-bottom-0">
                                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="tab-profile" data-toggle="pill" href="#tab-content-profile" role="tab" aria-controls="tab-profile" aria-selected="true">Profile</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="tab-change-password" data-toggle="pill" href="#tab-content-change-password" role="tab" aria-controls="tab-content-change-password" aria-selected="false">Change Password</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="tabContent">
                                                <div class="tab-pane fade active show" id="tab-content-profile" role="tabpanel" aria-labelledby="tab-content-profile">
                                                    <form class="form-horizontal" id="form-profile" action="<?= base_url('profile/saveProfile') ?>">
                                                        <div class="form-group row">
                                                            <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                                                            <div class="col-sm-10 form-group-h">
                                                                <input type="text" class="form-control" id="username_old" name="username_old" value="<?= esc($user_session->user_username) ?>" placeholder="Username" readonly hidden>
                                                                <input type="text" class="form-control" id="username" name="username" value="<?= esc($user_session->user_username) ?>" placeholder="Username">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail" class="col-sm-2 col-form-label">E-mail</label>
                                                            <div class="col-sm-10 form-group-h">
                                                                <input type="email" class="form-control" id="email_old" name="email_old" value="<?= esc($user_session->user_email) ?>" placeholder="Email" hidden readonly>
                                                                <input type="email" class="form-control" id="email" name="email" value="<?= esc($user_session->user_email) ?>" placeholder="Email">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail" class="col-sm-2 col-form-label">Nomor Telepon</label>
                                                            <div class="col-sm-10 form-group-h">
                                                                <input type="text" class="form-control" id="phone_number_old" name="phone_number_old" value="<?= esc($user_session->ud_phone) ?>" placeholder="Nomor Telepon" hidden readonly>
                                                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= esc($user_session->ud_phone) ?>" placeholder="Nomor Telepon">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputName2" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                                            <div class="col-sm-10 form-group-h">
                                                                <input type="text" class="form-control" id="full_name" name="full_name" value="<?= esc($user_session->ud_full_name) ?>" placeholder="Nama Lengkap">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputSkills" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                                            <div class="col-sm-10 form-group-h">
                                                                <input type="text" class="form-control" id="birth_place" name="birth_place" value="<?= esc($user_session->ud_birth_place) ?>" placeholder="Tempat Lahir">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputSkills" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                                            <div class="col-sm-10 form-group-h">
                                                                <input type="text" class="form-control" id="birth_date" name="birth_date" value="<?= esc(date("d-m-Y", strtotime($user_session->ud_birth_date))) ?>" placeholder="Tanggal Lahir">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputExperience" class="col-sm-2 col-form-label">Alamat</label>
                                                            <div class="col-sm-10 form-group-h">
                                                                <textarea class="form-control" id="address" name="address" placeholder="Alamat"><?= esc($user_session->ud_address) ?> </textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputExperience" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                                            <div class="col-sm-10 form-group-h">
                                                                <select name="user_gender" id="user_gender" class="form-control select2bs4 select-form" style="width: 100%;">
                                                                    <option></option>
                                                                    <option value="L" <?= $user_session->ud_gender == 'L' ? 'selected' : '' ?>>Laki-Laki</option>
                                                                    <option value="P" <?= $user_session->ud_gender == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group row">
                                                            <div class="offset-sm-2 col-sm-10">
                                                                <button type="submit" class="btn btn-info">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade" id="tab-content-change-password" role="tabpanel" aria-labelledby="tab-content-change-password">
                                                    <form class="form-horizontal" id="form-change-password" action="<?= base_url('profile/saveChangePassword') ?>">
                                                        <div class="form-group row">
                                                            <label for="inputName" class="col-sm-2 col-form-label">Password Sebelumnya</label>
                                                            <div class="col-sm-10 form-group-h">
                                                                <input type="password" class="form-control" id="password_old" name="password_old" placeholder="Password Sebelumnya">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail" class="col-sm-2 col-form-label">Password Baru</label>
                                                            <div class="col-sm-10 form-group-h">
                                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password Baru">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputName2" class="col-sm-2 col-form-label">Ulangi Password Baru</label>
                                                            <div class="col-sm-10 form-group-h">
                                                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Ulangi Password Baru">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="offset-sm-2 col-sm-10">
                                                                <button type="submit" class="btn btn-info">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>