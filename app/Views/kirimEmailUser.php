<?= $this->extend('layout_login/header_forgot') ?>
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
    .custom-center {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}
</style>
<div class="card toForgot">
    <div class="card-header" style="background-color:#14406B;">
        <span style="color:white;font-size:20px">Reset Password</span>
    </div>
    <div class="card-body">
        <div class="custom-center grid-item" style="color:gray">
            <i class="fa-solid fa-envelope mb-3" style="font-size:50px; vertical-align: middle;"></i>
            <span>Masukkan alamat email wali anda untuk mereset password</span>
        </div>
        <div class="mt-4">
            <form class="" action="<?= base_url() ?>kirimEmailUser" method="post" id="emailForm">
                <div class="form-group">
                    <label for="email">Alamat Email Wali</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-block" id="btnfetch">Reset</button>
            </form>
        </div>
    </div>
</div>
<?php if(session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?= session()->getFlashdata('error') ?>',
        });
    </script>
<?php endif; ?>
<script>
        document.getElementById('emailForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var email = document.getElementById('email').value;
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

            if (!emailPattern.test(email)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Alamat Email Invalid',
                    text: 'Alamat Email Yang Anda Masukkan Salah.',
                });
            } else{
                this.submit();
            }
        });
    </script>
<?= $this->endsection() ?>