<?= $this->extend('layout_login/header_forgot') ?>
<?= $this->section('content') ?>
    <?php $uri = service('uri') ?>
    <?php $this->config = config('Auth'); ?>
    <style>
        .grid-item {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .toForgot2{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
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
        <div class="container-fluid">
            <div class="card toForgot2">
                <div class="card-header">
                    <h3 class="card-title">Reset Password</h3>
                </div>
                <div class="card-body">
                    <div class="grid-item custom-center mb-3" style="color:gray">
                        <i class="fa-solid fa-unlock mb-3" style="font-size:55px"></i>
                        <span>Hallo, <?= $user['nama'] ?></span>
                        <span>Isi kolom dibawah ini untuk mengganti password anda</span>
                    </div>
                    <form action="<?= base_url() ?>user/update" id="form" method="post">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?= set_value('id', $user['id_users']) ?>">
                        <input type="hidden" class="form-control" name="nama" id="nama" value="<?= set_value('nama', $user['nama']) ?>">
                        <input type="hidden" class="form-control" name="nik" id="nik" value="<?= set_value('nik',$user['nik']) ?>" >
                        <input type="hidden" class="form-control" name="role" id="role" value="<?= set_value('role',$user['role']) ?>">
                        <input type="hidden" class="form-control" name="id_referensi" id="id_referensi" value="<?= set_value('id_referensi',$user['id_referensi']) ?>">
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
                            text: 'Password harus memiliki minimal 6 karakter.',
                        });
                    }else if(password !== password_confirm){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Password dan konfirmasi password tidak sama.',
                        });
                    }else{
                        form.submit();
                    }
                });
            });
        </script>
<?= $this->endSection()?>







     