<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                            <h3 class="card-title text-left">Data Users</h3>
                            <div class="text-right">
                                <?php if ((array_intersect(array($menu_allow . '_create'), $user_allow_menu))) { ?>
                                    <button type="button" class="btn btn-sm btn-primary" onclick="addNew()">
                                        <i class="fas fa-plus"></i> Add New
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatables" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Users ID</th>
                                        <th>Users Name</th>
                                        <th>Users E-mail</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Modals -->
    <div class="modal fade" id="modalAddEdit" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="modalHeaderText"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">
                    <form role="form" id="form" action="<?= base_url('users/save') ?>">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="user_id" id="user_id" class="form-control" placeholder="Username" hidden>
                                    <input type="text" name="user_usernameOld" id="user_usernameOld" class="form-control" placeholder="Username" hidden>
                                    <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Username">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="user_passwordOld" id="user_passwordOld" class="form-control" placeholder="Password" hidden>
                                    <input type="text" name="user_password" id="user_password" class="form-control" placeholder="Password">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="user_emailOld" id="user_emailOld" class="form-control" placeholder="E-mail" hidden>
                                    <input type="email" name="user_email" id="user_email" class="form-control" placeholder="E-mail">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="user_role" id="user_role" class="form-control select2bs4 select-form" style="width: 100%;">
                                        <option></option>
                                        <?php foreach ($select_role as $role) { ?>
                                            <option value="<?= $role->role_id ?>"><?= $role->role_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Status User</label>
                                    <select name="user_status" id="user_status" class="form-control select2bs4 select-form" style="width: 100%;">
                                        <option></option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="user_full_name" id="user_full_name" placeholder="Nama Lengkap" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" name="user_phone" id="user_phone" class="form-control" placeholder="Nomor Telepon">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="text" format-date="dd-mm-yyyy" name="user_birth_date" id="user_birth_date" placeholder="dd-mm-yyyy" class="form-control datepicker date-form" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="user_birth_place" id="user_birth_place" class="form-control" placeholder="Tempat Lahir">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="user_address" id="user_address" class="form-control" rows="3" placeholder="Alamat"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="user_gender" id="user_gender" class="form-control select2bs4 select-form" style="width: 100%;">
                                        <option></option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modalView" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="modalHeaderText"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">
                    <div id="body-view">

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->