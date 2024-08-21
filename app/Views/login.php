<?= $this->extend('layout_login/header') ?>
<?= $this->section('content') ?>
<?php $uri = service('uri') ?>
<?php $this->config = config('Auth');
$redirect = $this->config->assignRedirect; ?>
<div class="container" style="position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);">
    
    <?php $validation = \Config\Services::validation(); ?>
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12 mx-auto login-desk">
            <div class="row">
                <div class="col-md-6 d-none d-md-block detail-box">
                    <div class="detailsh text-center">
                        <img class="help img-fluid" src="<?= base_url() ?>public/assets/dist/img/pngwing.com.png" alt="">
                        <h3>Sistem Feedback</h3>
                        <p>Sekolah Dasar Negeri Kuripan Kidul 04</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 loginform">
                    <div class="text-center">
                        <img class="logo img-fluid" src="<?= base_url() ?>public/assets/dist/img/83790f2b43f00be.png" alt="" style="width:150px;height:150px;">
                        <h4>Selamat Datang</h4>
                        <p>Silahkan Login Terlebih Dahulu</p>
                    </div>
                    <div class="login-det">
                        <form class="" action="<?= base_url() ?>login" id="form" method="post">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa-solid fa-id-card"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" name="nik" id="nik" placeholder="Masukkan NIK" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control" name="password" id="password" value="" placeholder="Masukkan Password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <button type="submit"  class="btn btn-block btn-primary" style="margin-top:20px">Login</button>
                                </div>
                                <div class="col-12 col-sm-8 text-right">
                                    <ul>
                                        <li><a href="<?= base_url() ?>lupaPassword">Lupa Password?</a></li>
                                    </ul>
                                </div>
                            </div>
                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url()?>public/assets/dist/js/login.js"></script>
<?php if(session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '<?= session()->getFlashdata('success') ?>',
        });
    </script>
<?php endif; ?>
<?php if(session()->getFlashdata('danger')): ?>
    <script>
        Swal.fire({
            icon: 'danger',
            title: 'Error',
            text: '<?= session()->getFlashdata('danger') ?>',
        });
    </script>
<?php endif; ?>
<?php if(session()->getFlashdata('error')): ?>
    <script>
        Toast.fire({
            icon: "error",
            title: "<?= session()->getFlashdata('error') ?>"
        });
    </script>
<?php endif; ?>
<?= $this->endSection() ?>
