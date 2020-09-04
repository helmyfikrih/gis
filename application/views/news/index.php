<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">News</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Manage</a></li>
                        <li class="breadcrumb-item active">News</li>
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
                            <h3 class="card-title text-left">Data News</h3>
                            <div class="text-right">
                                <?php if ((array_intersect(array($menu_allow . '_create'), $user_allow_menu))) { ?>
                                    <a href="<?= base_url('news/create') ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus"></i> Add New
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatables" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>News Title</th>
                                        <th>News Tags</th>
                                        <th>News Created By</th>
                                        <th>News Created Date</th>
                                        <th>News Status</th>
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
    <!-- /.modal -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->