<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPESANTIK Login</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/dist/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/dist/css/animate.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/slider/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/slider/css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>public/assets/dist/css/login.css" />
    <script src="https://kit.fontawesome.com/86e5d56058.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="<?= base_url()?>public/assets/dist/img/83790f2b43f00be.png">
    <style>
        body {
                height: 100%;
                overflow-y: hidden;
                zoom: 0.85;
            }
    </style>
</head>

<body class="form-login-body" style="background-image:url('<?= base_url() ?>public/assets/dist/img/FOTO SD TAMPAK DEPAN.jpg'); height: 100%;width: 100%;margin: 0;background-size: cover;background-position: center;">
<?php $uri = service('uri') ?>
<?php $this->config = config('Auth');
$redirect = $this->config->assignRedirect; ?>
<?= $this-> renderSection('content')?>

<script src="<?= base_url() ?>public/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>public/assets/dist/js/adminlte.min.js"></script>
<script src="<?= base_url()?>public/assets/dist/js/popper.min.js"></script>
<script src="<?= base_url()?>public/assets/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url()?>public/assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
<script src="<?= base_url()?>public/assets/plugins/slider/js/owl.carousel.min.js"></script>
<script src="<?= base_url()?>public/assets/dist/js/script.js"></script>
</body>