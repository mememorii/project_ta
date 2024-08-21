<?php if(session()->get('role') == 1 || session()->get('role') == 2){ ?>
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
<div class="card toForgot2">
    <div class="card-header" style="background-color:#14406B;">
        <span style="color:white;font-size:20px">Edit Email</span>
    </div>
    <div class="card-body">
        <div class="custom-center grid-item" style="color:gray">
            <i class="fa-solid fa-envelope mb-3" style="font-size:50px; vertical-align: middle;"></i>
            <span>Masukkan alamat email baru anda</span>
        </div>
        <div class="mt-4">
            <form class="" action="<?= base_url() ?>changeEmail" method="post" id="emailForm">
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?= $email['email'] ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-block" id="btnfetch">Ganti</button>
            </form>
        </div>
    </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('emailForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        var email = document.getElementById('email').value;
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
       

        if (!email) {
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              confirmButtonColor:'#7bb3ff',
              text: 'Email harus diisi.',
            });
            return false;
        }

        if (!emailPattern.test(email)) {
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              confirmButtonColor:'#7bb3ff',
              text: 'Format email yang anda masukkan salah.',
            });
            return false;
        }

        form.submit(); 
    })
  });
</script>
<?= $this->endSection()?>