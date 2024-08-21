<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url()?>public/assets/dist/img/83790f2b43f00be.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <script src="https://kit.fontawesome.com/86e5d56058.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/select2/css/select2.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/dist/css/color.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/bs-stepper/css/bs-stepper.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <script src="<?= base_url()?>public/assets/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
    <script src="<?= base_url()?>public/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url()?>public/assets/plugins/select2/js/select2.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .form-login-body {
            background-image: url('<?= base_url() ?>public/assets/dist/img/FOTO SD TAMPAK DEPAN.jpg');
            background-size: cover;
        }
        .toForgot{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width:700px
        }
    </style>
</head>
<body class="form-login-body">
<?php $uri = service('uri') ?>
<?php $this->config = config('Auth');
$redirect = $this->config->assignRedirect; ?>
<?= $this-> renderSection('content')?>
</body>