<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">User Role</li>
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
                            <h3 class="card-title text-left">Data Role</h3>
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
                            <table id="table_role" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Role ID</th>
                                        <th>Role Code</th>
                                        <th>Role Name</th>
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
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span id="modalHeaderText"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">
                    <form role="form" id="form" action="<?= base_url('user_role/save') ?>">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Role Code</label>
                                    <input type="text" name="role_id" id="role_id" class="form-control" placeholder="Role Code..." hidden>
                                    <input type="text" name="role_code" id="role_codeOld" class="form-control" placeholder="Role Code..." hidden>
                                    <input type="text" name="role_code" id="role_code" class="form-control" placeholder="Role Code...">
                                </div>
                                <div class="form-group">
                                    <label>Role Name</label>
                                    <input type="text" name="role_name" id="role_nameOld" class="form-control" placeholder="Role Name..." hidden>
                                    <input type="text" name="role_name" id="role_name" class="form-control" placeholder="Role Name...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div id="imenu" style="display:none"></div>
                                    <style>
                                        .akar_dua {
                                            padding-left: 25px
                                        }

                                        .akar_tiga {
                                            padding-left: 50px
                                        }

                                        #accordion3 input[type="checkbox"] {
                                            margin-top: -3px !important;
                                        }

                                        #selector {
                                            width: 220px;
                                            overflow: auto;
                                            margin-bottom: 10px;
                                        }

                                        .scroll-select {
                                            width: auto !important;
                                            min-width: 220px;
                                            margin-bottom: 0px !important;
                                        }
                                    </style>

                                    <div class="panel-group accordion" id="accordion3">
                                        <label>Menu Access</label>
                                        <?php
                                        $data = $menuakses;
                                        foreach ($data['root'] as $top) {
                                            $rootname = $top['menu_name'];
                                            $rootid   = $top['menu_id'];

                                            if (isset($data['sub_' . $rootid])) {
                                                echo '<div class="panel panel-default"><i class="ace-icon fa fa-plus bigger-120 blue"></i>
									<input name="role_allow_menu[]"  id="box_' . $rootid . '" type="checkbox" value="' . $rootid . '"  >
									<a class="" data-toggle="collapse"  href="#collapse_' . $rootid . '">' . $rootname . '</a>
								  <div style="height: 0px; " id="collapse_' . $rootid . '" class="panel-collapse collapse akar_dua down_' . $rootid . '">';

                                                foreach ($data['sub_' . $rootid] as $sub_satu) {

                                                    if (isset($data['sub_' . $rootid . '_' . $sub_satu->menu_id])) {
                                                        echo '<div class="panel panel-default"><i class="ace-icon fa fa-plus bigger-120 blue"></i>
											<input type="checkbox" name="role_allow_menu[]"  id="box_' . $sub_satu->menu_id . '" value="' . $sub_satu->menu_id . '" >
                                            <a class="" data-toggle="collapse"  href="#sub_tiga_' . $sub_satu->menu_id . '">' . $sub_satu->menu_name . ' <span class="arrow"></span></a>
											<div style="height: 0px;" id="sub_tiga_' . $sub_satu->menu_id . '" class="panel-collapse collapse akar_dua down_' . $sub_satu->menu_id . '">';

                                                        foreach ($data['sub_' . $rootid . '_' . $sub_satu->menu_id] as $sub_dua) {

                                                            if (isset($data['sub_' . $rootid . '_' . $sub_satu->menu_id . '_' . $sub_dua->menu_id])) {
                                                                echo '<div class="panel panel-default"><i class="ace-icon fa fa-plus bigger-120 blue"></i>
													<input type="checkbox" name="role_allow_menu[]"  id="box_' . $sub_dua->menu_id . '" value="' . $sub_dua->menu_id . '" >
												    <a class="" data-toggle="collapse"  href="#sub_tiga_' . $sub_dua->id . '">' . $sub_dua->menu_name . ' <span class="arrow"></span></a>
													<div style="height: 0px;" id="sub_tiga_' . $sub_dua->menu_id . '" class="panel-collapse collapse akar_dua down_' . $sub_dua->menu_id . '">';

                                                                foreach ($data['sub_' . $rootid . '_' . $sub_satu->menu_id . '_' . $sub_dua->menu_id] as $sub_tiga) {
                                                                    echo '<input style="margin-left: 15px;" type="checkbox" name="role_allow_menu[]"  id="box_' . $sub_tiga->menu_id . '" value="' . $sub_tiga->menu_id . '" > ' . $sub_tiga->menu_name . '<br>';
                                                                    if (!empty($sub_tiga->menu_access)) {
                                                                        echo '<div style="height: auto;" id="collapse_' . $sub_tiga->menu_id . '" class="panel-collapse akar_dua down_' . $sub_tiga->menu_id . ' collapse show">';
                                                                        $arr_level = explode(",", $sub_tiga->access);
                                                                        foreach ($arr_level as $arr_value) {
                                                                            $level_value = 'level_' . $sub_tiga->menu_id . '_' . $arr_value;
                                                                            echo '<input style="margin-left: 15px;" style="margin-left: 26px;" type="checkbox" name="role_allow_menu[]"  id="box_' . $level_value . '" value="' . $level_value . '" > ' . $arr_value . '<br>';
                                                                        }
                                                                        echo '</div>';
                                                                    }
                                                                }
                                                                echo '</div></div>';
                                                            } else {
                                                                echo '<input style="margin-left: 15px;" type="checkbox" name="role_allow_menu[]"  id="box_' . $sub_dua->menu_id . '" value="' . $sub_dua->menu_id . '" > ' . $sub_dua->menu_name . '<br>';
                                                                if (!empty($sub_dua->menu_access)) {
                                                                    echo '<div style="height: auto;" id="collapse_' . $sub_dua->menu_id . '" class="panel-collapse akar_dua down_' . $sub_dua->menu_id . ' collapse show">';
                                                                    $arr_level = explode(",", $sub_dua->menu_access);
                                                                    foreach ($arr_level as $arr_value) {
                                                                        $level_value = 'level_' . $sub_dua->menu_id . '_' . $arr_value;
                                                                        echo '<input style="margin-left: 15px;" type="checkbox" name="role_allow_menu[]"  id="box_' . $level_value . '" value="' . $level_value . '" > ' . $arr_value . '<br>';
                                                                    }
                                                                    echo '</div>';
                                                                }
                                                            }
                                                        }
                                                        echo '</div></div>';
                                                    } else {
                                                        echo '<input style="margin-left: 15px;" type="checkbox" name="role_allow_menu[]"  id="box_' . $sub_satu->menu_id . '" value="' . $sub_satu->menu_id . '"  > ' . $sub_satu->menu_name . '<br>';
                                                        if (!empty($sub_satu->menu_access)) {
                                                            $arr_level = explode(",", $sub_satu->menu_access);
                                                            echo '<div style="height: auto;" id="collapse_' . $sub_satu->menu_id . '" class="panel-collapse akar_dua down_' . $sub_satu->menu_id . ' collapse show">';
                                                            foreach ($arr_level as $arr_value) {
                                                                $level_value = 'level_' . $sub_satu->menu_id . '_' . $arr_value;
                                                                echo '<input style="margin-left: 15px;" type="checkbox"  name="role_allow_menu[]"  id="box_' . $level_value . '"  value="' . $level_value . '" > ' . $arr_value . '<br>';
                                                            }
                                                            echo '</div>';
                                                        }
                                                    }
                                                }
                                                echo ' </div>
                				</div>';
                                            } else {
                                                echo '<div class="panel panel-default" style="margin-left: 15px;"><input name="role_allow_menu[]"  id="box_' . $rootid . '" type="checkbox" value="' . $rootid . '"  ><a class="" data-toggle="collapse"  href="#collapse_' . $rootid . '"> ' . $rootname . '</a></div>';
                                            }
                                        }

                                        ?>
                                    </div>
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