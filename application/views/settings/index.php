<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">System Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">System Settings</li>
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
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="row">
                            <div class="col-5 col-sm-3">
                                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="vert-tabs-info-tab" data-toggle="pill" href="#vert-tabs-info" role="tab" aria-controls="vert-tabs-info" aria-selected="true">General Info</a>
                                    <a class="nav-link" id="vert-tabs-logo-tab" data-toggle="pill" href="#vert-tabs-logo" role="tab" aria-controls="vert-tabs-logo" aria-selected="false">Logo</a>
                                    <a class="nav-link" id="vert-tabs-smtp-tab" data-toggle="pill" href="#vert-tabs-smtp" role="tab" aria-controls="vert-tabs-smtp" aria-selected="false">SMTP</a>
                                </div>
                            </div>
                            <div class="col-7 col-sm-9">
                                <div class="tab-content" id="vert-tabs-tabContent" style="padding: 20px;">
                                    <div class="tab-pane text-left fade show active" id="vert-tabs-info" role="tabpanel" aria-labelledby="vert-tabs-info-tab">
                                        <form action="<?= base_url('settings/saveGeneral') ?>" id="generalForm" role="form">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="company_name">APP NAME</label>
                                                        <input class="form-control" placeholder="APP NAME" name="application_name" type="text" id="application_name" value="<?= $setting->system_settings_app_name ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="company_name">APP ABOUT</label>
                                                        <textarea class="form-control" placeholder="APP ABOUT" name="application_about" type="text" id="application_about"><?= $setting->system_settings_app_about ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="company_name">HEADER TEXT</label>
                                                        <input class="form-control" placeholder="HEADER TEXT" name="header_name" type="text" id="header_name" value="<?= $setting->system_settings_app_header_text ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="company_name">FOOTER TEXT</label>
                                                        <input class="form-control" placeholder="FOOTER TEXT" name="footer_text" type="text" id="footer_text" value="<?= $setting->system_settings_app_footer_text ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="company_name">FOOTER YEAR</label>
                                                        <input class="form-control" placeholder="FOOTER YEAR" name="footer_year" type="number" min="0" id="footer_year" value="<?= $setting->system_settings_app_footer_year ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 ">
                                                    <div class="text-right form-group">
                                                        <button type="submit" class="btn btn-primary "> <i class="fa fa-check-square-o"></i> Save </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="vert-tabs-logo" role="tabpanel" aria-labelledby="vert-tabs-logo-tab">
                                        <form action="<?= base_url('settings/saveLogo') ?>" id="logoForm" role="form">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="company_name">LOGO HEADER</label>
                                                        <input class="form-control" placeholder="LOGO HEADER" name="system_settings_app_logo_header" type="file" accept="image/*" id="system_settings_app_logo_header">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="company_name">ICON</label>
                                                        <input class="form-control" placeholder="ICON" name="system_settings_app_logo_icon" type="file" accept="image/*" id="system_settings_app_logo_icon">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 ">
                                                    <div class="text-right form-group">
                                                        <button type="submit" class="btn btn-primary "> <i class="fa fa-check-square-o"></i> Save </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="vert-tabs-smtp" role="tabpanel" aria-labelledby="vert-tabs-smtp-tab">
                                        <?php echo form_open_multipart('settings/saveSMTP', 'class="" id="smtpForm" role="smtpForm"'); ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="company_name">SMTP HOST</label>
                                                    <input class="form-control" placeholder="SMTP HOST" name="sys_smtp_host" type="text" id="sys_smtp_host" value="<?= $setting->system_settings_smtp_host ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="company_name">SMTP USER</label>
                                                    <input class="form-control" placeholder="SMTP USER" name="sys_smtp_user" type="text" id="sys_smtp_user" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="company_name">SMTP PASSWORD</label>
                                                    <input class="form-control" placeholder="SMTP PASSWORD" name="sys_smtp_pass" type="text" id="sys_smtp_pass" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="company_name">SMTP CRYPTO</label>
                                                    <input class="form-control" placeholder="SMTP CRYPTO" name="sys_smtp_crypto" type="text" id="sys_smtp_crypto" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="company_name">SMTP PORT</label>
                                                    <input class="form-control" placeholder="SMTP PORT" name="sys_smtp_port" type="number" min="0" id="sys_smtp_port" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="company_name">SMTP FROM</label>
                                                    <input class="form-control" placeholder="SMTP FROM" name="sys_smtp_from" type="text" id="sys_smtp_from" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="company_name">SMTP ALIAS</label>
                                                    <input class="form-control" placeholder="SMTP ALIAS" name="sys_smtp_alias" type="text" id="sys_smtp_alias" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 ">
                                                <div class="text-right form-group">
                                                    <button type="submit" class="btn btn-primary "> <i class="fa fa-check-square-o"></i> Save </button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->