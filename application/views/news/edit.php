<style>
    .bootstrap-tagsinput>.badge-info {
        margin: 2px 2px;
    }
</style>
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
                    <form id="news_form" action="<?= base_url('news/save') ?>">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-left">Edit News</h3>
                                <div class="text-right">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">News Title</label>
                                            <input type="text" class="form-control" id="news_id" name="news_id" placeholder="News Title" value="<?= $data_news[0]['news_id'] ?>" readonly hidden>
                                            <input type="text" class="form-control" id="news_title" name="news_title" placeholder="News Title" value="<?= $data_news[0]['news_title'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">News Tags</label>
                                            <input type="text" class="form-control" id="news_tags" name="news_tags" data-role="tagsinput" value="<?= $data_news[0]['news_tags'] ?>" placeholder="News Tags">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">News Body</label>
                                            <textarea type="text" class="form-control editor" id="news_body" name="news_body" placeholder="News Body"><?= $data_news[0]['news_body'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="text-right">
                                    <?php if ((array_intersect(array($menu_allow . '_create'), $user_allow_menu))) { ?>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-save"></i> Publish
                                        </button>
                                    <?php } ?>
                                </div>
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