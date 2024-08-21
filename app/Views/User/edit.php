<?php if (session()->get('role') == 1 || session()->get('role') == 2) {  ?>
    <?= $this->extend('layouts/master') ?>
<?php }else{ ?>
    <?= $this->extend('layout_user/master') ?>
<?php } ?>
    <?= $this->section('content') ?>
    <?php $uri = service('uri') ?>
    <?php $this->config = config('Auth'); ?>
        <?php if (session()->get('role') == 1 || session()->get('role') == 2) {  ?>
            <div class="container-fluid">
        <?php }else{ ?>
            <div class="container-fluid" style="padding-left:99px;padding-right:99px">
        <?php } ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit User Account</h3>
                    </div>
                    <div class="card-body">
                            <form action="<?= base_url() ?>user/update" id="form" method="post">
                                <input type="hidden" class="form-control" name="id" id="id" value="<?= set_value('id', $user['id_users']) ?>">
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama', $user['nama']) ?>" hidden>
                                <input type="number" class="form-control" name="nik" id="nik" value="<?= set_value('nik',$user['nik']) ?>" hidden>
                                <input type="number" class="form-control" name="role" id="role" value="<?= set_value('role',$user['role']) ?>" hidden>
                                <input type="number" class="form-control" name="id_referensi" id="id_referensi" value="<?= set_value('id_referensi',$user['id_referensi']) ?>" hidden>
                                <div class="row">
                                    <div class="col-md-6">    
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">    
                                        <div class="form-group">
                                            <label for="password_confirm">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="col-12 col-sm-4">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
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







     