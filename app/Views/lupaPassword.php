<?= $this->extend('layout_login/header') ?>
<?= $this->section('content') ?>
<style>
    .grid-item {
                background-color: #f0f0f0;
                border: 1px solid #ccc;
                padding: 10px;
            }
    .toForgot{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width:500px;
        border-width:0px
    }
</style>
<div class="card toForgot">
    <div class="card-header" style="background-Color:#14406B;color:white;">
        <span>Pilih Metode Untuk Reset Password</span>
    </div>
    <div class="card-body">
        <div class="grid-item mb-3">
            <div class="d-flex justify-content-between">
                <div>
                    <i class="fa-solid fa-envelope" style="font-size:35px; vertical-align: middle;"></i>
                    <span class="ml-2" style="vertical-align: middle;">Kirim Kode Reset Password Ke Email</span>
                </div>
                <a href="<?= base_url() ?>viewKirimEmail" class="btn btn-primary">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
        </div>
        <div class="grid-item mb-3">
            <div class="d-flex justify-content-between">
                <div>
                    <i class="fa-solid fa-envelope" style="font-size:35px; vertical-align: middle;"></i>
                    <span class="ml-2" style="vertical-align: middle;">Kirim Kode Reset Password Ke Email Wali Siswa</span>
                </div>
                <a href="<?= base_url() ?>viewKirimEmailUser" class="btn btn-primary">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
        </div>
        <div class="grid-item mb-3">
            <div class="d-flex justify-content-between">
                <div>
                    <i class="fa-solid fa-circle-question" style="font-size:35px; vertical-align: middle;"></i>
                    <span class="ml-2" style="vertical-align: middle;">Security Question</span>
                </div>
                <a href="<?= base_url() ?>toForgot" class="btn btn-primary">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
    <span class="mb-2 ml-2" style="font-size:10px">*Atau Anda Dapat Menghubungi Administrator Untuk Mereset Password Akun Anda</span>
</div>
<?= $this->endsection() ?>