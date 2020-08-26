<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Kecamatan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Data Kecamatan</li>
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
                            <h3 class="card-title text-left">Data Kecamatan</h3>
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
                            <table id="table_kecamatan" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Kecamatan ID</th>
                                        <th>Kecamatan Code</th>
                                        <th>Kecamatan Name</th>
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
    <!-- /.content -->
    <!-- Modals -->
    <div class="modal fade" id="modalAddEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span id="modalHeaderText"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">
                    <form role="form" id="form" action="<?= base_url('data_kecamatan/save') ?>">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Kota</label>
                                    <select name="kota_id" id="kota_id" class="form-control select2bs4 select-form" style="width: 100%;">
                                        <option></option>
                                        <?php foreach ($select_kota as $kota) { ?>
                                            <option value="<?= $kota->kota_id ?>"><?= $kota->kota_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kecamatan Code</label>
                                    <input type="text" name="kecamatan_id" id="kecamatan_id" class="form-control" placeholder="Role Code..." hidden>
                                    <input type="text" name="kecamatan_code" id="kecamatan_codeOld" class="form-control" placeholder="Role Code..." hidden>
                                    <input type="text" name="kecamatan_code" id="kecamatan_code" class="form-control" placeholder="Role Code...">
                                </div>
                                <div class="form-group">
                                    <label>Kecamatan Name</label>
                                    <input type="text" name="kecamatan_name" id="kecamatan_nameOld" class="form-control" placeholder="Role Name..." hidden>
                                    <input type="text" name="kecamatan_name" id="kecamatan_name" class="form-control" placeholder="Role Name...">
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
    <!-- /.modal -->
</div>
<!-- /.content-wrapper -->