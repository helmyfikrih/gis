<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link">
        <img src="<?= base_url() ?>assets/dist/img/<?= $setting->system_settings_app_logo_header ?>?x=<?= time() ?>" alt="<?= $setting->system_settings_app_name ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $setting->system_settings_app_name ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <a href="<?= $user_session->ud_img_url ? $user_session->ud_img_url : base_url() . "assets/dist/img/avatar04.png"; ?><?= "?x=" . time() ?>" class="profile-img-clickable-sidebar">
                    <img class="profile-user-img img-fluid img-circle" src="<?= $user_session->ud_img_url ? $user_session->ud_img_url : base_url() . "assets/dist/img/avatar04.png"; ?><?= "?x=" . time() ?>" alt="<?= $user_session->ud_full_name ?>">
                </a>
            </div>
            <div class="info">
                <a href="<?= base_url('profile') ?>" class="d-block"><?= $user_session->user_username; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?= $menu_body ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>