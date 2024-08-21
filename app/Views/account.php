<?php if (session()->get('role') == 1 || session()->get('role') == 2) {  ?>
    <?= $this->extend('layouts/master') ?>
<?php }else{ ?>
    <?= $this->extend('layout_user/master') ?>
<?php } ?>
<?= $this->section('content') ?>
<style>
        .grid-item {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .toForgot2{
            margin: 0 auto; /* Added */
            float: none; /* Added */
            width:500px;
            border-width:0px;
        }
        .custom-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
    </style>
    <?php $uri = service('uri') ?>
    <?php $this->config = config('Auth');
    $redirect = $this->config->assignRedirect; ?>
    <?php $this->config = config('Auth'); $redirect = $this->config->assignRedirect;?>
    <?php if (session()->get('role') == 1 || session()->get('role') == 2) {  ?>
        <div class="container-fluid">
    <?php }else{ ?>
        <div class="container-fluid" style="padding-left:99px;padding-right:99px">
    <?php } ?>
            <div class="card toForgot2 mb-5">
                <div class="card-header">
                    <h3 class="card-title">Edit Password</h3>
                </div>
                <div class="card-body">
                    <div class="grid-item custom-center mb-3" style="color:gray">
                        <i class="fa-solid fa-unlock mb-3" style="font-size:55px"></i>
                        <span>Isi kolom dibawah ini untuk mengganti password anda</span>
                    </div>
                    <?php $validation = \Config\Services::validation(); ?>
                    <form action="<?= base_url() ?><?php echo $redirect[session()->get('role')] ?>/account" id="form" method="post">
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama', session()->get('nama')) ?>" hidden>
                        <input type="number" class="form-control" name="nik" id="nik" value="<?= set_value('nik', session()->get('nik')) ?>" hidden>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" value="">
                            
                        </div>
                        <div class="form-group">
                            <label for="password_confirm">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </form>
                </div>
            </div>
        </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('form');

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                
                // Ambil nilai input
                const password = document.getElementById('password').value;
                const password_confirm = document.getElementById('password_confirm').value;

                // Validasi karakter minimal
                if (password.length < 6 || password_confirm < 6) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        confirmButtonColor:'#7bb3ff',
                        text: 'Password harus memiliki minimal 6 karakter.',
                    });
                }else if(password !== password_confirm){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        confirmButtonColor:'#7bb3ff',
                        text: 'Password dan konfirmasi password tidak sama.',
                    });
                }else{
                    form.submit();
                }
            });
        });
    </script>
<?= $this->endSection()?>







     