<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Starter</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- ColorBox -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/colorbox/css/colorbox.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
    <?php
    foreach ($plugins_path_css as $plugin_css) { ?>
        <link href="<?= base_url() ?>assets/plugins/<?= $plugin_css ?>" rel="stylesheet">
    <?php
    }
    ?>
    <?php
    foreach ($css_path as $css) { ?>
        <link href="<?= base_url() ?>assets/dist/css/<?= $css ?>" rel="stylesheet">
    <?php
    }
    ?>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>