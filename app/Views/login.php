<?= $this->extend('layout_login/header') ?>
<?= $this->section('content') ?>
    <?php $uri = service('uri') ?>
    <?php $this->config = config('Auth');
    $redirect = $this->config->assignRedirect; ?>
    <div class="container">
        <?php $validation = \Config\Services::validation(); ?>
        <?php if (session()->get('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->get('success'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->get('danger')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->get('danger'); ?>
                <?php if (session()->get('resetlink')) {
                    echo session()->get('resetlink');
                } ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-10 mx-auto login-desk">
                <div class="row">
                    <div class="col-md-7 detail-box">
                        <div class="detailsh">
                            <img class="help" src="<?= base_url() ?>public/assets/dist/img/pngwing.com.png" alt="">
                            <h3>SIPESANTIK</h3>
                            <p>Sistem Penyampaian Saran, Kritik, Masukan dan Keluhan</p>
                        </div>
                    </div>
                    <div class="col-md-5 loginform">
                        <img class="logo" src="<?= base_url() ?>public/assets/dist/img/83790f2b43f00be.png" alt="" style="width:150px;height:150px;"> 
                        <h4>Selamat Datang</h4>                   
                        <p>Silahkan Login Terlebih Dahulu</p>
                        <div class="login-det">
                            <form class="" action="<?= base_url() ?>login" method="post">
                                <div class="form-row">
                                    <label for="">NIK</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa-solid fa-id-card"></i>
                                            </span>
                                        </div>
                                        <input type="number" class="form-control" name="nik" id="nik" value="<?= set_value('nik') ?>" placeholder="Masukkan NIK">
                                        <?php if ($validation->getError('nik')) { ?>
                                            <div class='alert alert-danger mt-2'>
                                                <?= $error = $validation->getError('nik'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label for="">Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control" name="password" id="password" value="" placeholder="Masukkan Password">
                                        <?php if ($validation->getError('password')) { ?>
                                            <div class='alert alert-danger mt-2'>
                                                <?= $error = $validation->getError('password'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary btn-xs" style="margin-top:60px">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection()?>