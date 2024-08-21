<?= $this->extend('layout_login/header_forgot') ?>
<?= $this->section('content') ?>
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


.wrapper{
    
    display: flex;
    align-items: center;
    justify-content: space-evenly;
}
.wrapper .option{
  background: #fff;
  height: 100%;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  cursor: pointer;
  padding:  5px;
  border: 2px solid lightgrey;
  transition: all 0.3s ease;
 
}
.wrapper .option .dot{
  height: 20px;
  width: 20px;
  background: #d9d9d9;
  border-radius: 50%;
  position: relative;
}
.wrapper .option .dot::before{
  position: absolute;
  content: "";
  top: 4px;
  left: 4px;
  width: 12px;
  height: 12px;
  background: #7bb3ff;
  border-radius: 50%;
  opacity: 0;
  transform: scale(1.5);
  transition: all 0.3s ease;
}
input[type="radio"]{
  display: none;
}
#option-1:checked:checked ~ .option-1,
#option-2:checked:checked ~ .option-2,
#option-3:checked:checked ~ .option-3{
  border-color: #7bb3ff;
  background: #7bb3ff;
}
#option-1:checked:checked ~ .option-1 .dot,
#option-2:checked:checked ~ .option-2 .dot,
#option-3:checked:checked ~ .option-3 .dot{
  background: #fff;
}
#option-1:checked:checked ~ .option-1 .dot::before,
#option-2:checked:checked ~ .option-2 .dot::before,
#option-3:checked:checked ~ .option-3 .dot::before{
  opacity: 1;
  transform: scale(1);
}
.wrapper .option span{
 
  color: #808080;
}
#option-1:checked:checked ~ .option-1 span,
#option-2:checked:checked ~ .option-2 span,
#option-3:checked:checked ~ .option-3 span{
  color: #fff;
}
</style>
    <div class="card toForgot2">
        <div class="card-header" style="color:white">
            <span>NIK</span>
        </div>
        <div class="card-body">
            <div class="grid-item" style="color:gray">
                <div>
                    <i class="fa-solid fa-address-card mb-3 custom-center" style="font-size:55px;vertical-align: middle;"></i>
                </div>
                    <span class="custom-center mb-3" style="vertical-align: middle;">Isi kolom kolom dibawah untuk mengidentifikasi akun anda</span>
                    <span class="custom-center mb-2">Pilih Role Akun Anda</span>
                <div class="wrapper">
                    <input type="radio" name="select" id="option-1" data-href="#tab1default" data-toggle="tab"checked>
                    <input type="radio" name="select" id="option-2" data-href="#tab2default" data-toggle="tab">
                    <input type="radio" name="select" id="option-3" data-href="#tab3default" data-toggle="tab">
                    <label for="option-1" class="option option-1">
                        <div class="dot"></div>
                        <span style="font-weight: 400;">Guru</span>
                    </label>
                    <label for="option-2" class="option option-2">
                        <div class="dot"></div>
                        <span style="font-weight: 400;">Siswa</span>
                    </label>
                    <label for="option-3" class="option option-3">
                        <div class="dot"></div>
                        <span style="font-weight: 400;">Wali Siswa</span>
                    </label>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="tab1default">
                    <form action="<?= base_url() ?>securityQuestion" class="mt-4" id="form" method="post">
                        <label>NIK</label>
                        <input type="hidden" id="role" name="role" value="2"> 
                        <input type="number" class="form-control" name="nik" id="nik" placeholder="Masukkan NIK Akun Anda">
                        <label class="mt-2">NIP</label>
                        <input type="number" class="form-control" name="id_referensi" id="id_referensi" placeholder="Masukkan NIP Akun Anda">
                        <button type="submit"  class="btn btn-block btn-primary" style="margin-top:20px">Submit</button>
                    </form>
                </div>
                <div class="tab-pane" id="tab2default">
                    <form action="<?= base_url() ?>securityQuestion" class="mt-4" id="form" method="post">
                        <label>NIK</label>
                        <input type="hidden" id="role" name="role" value="3"> 
                        <input type="number" class="form-control" name="nik" id="nik" placeholder="Masukkan NIK Akun Anda">
                        <label class="mt-2">NISN</label>
                        <input type="number" class="form-control" name="id_referensi" id="id_referensi" placeholder="Masukkan NISN Akun Anda">
                        <button type="submit"  class="btn btn-block btn-primary" style="margin-top:20px">Submit</button>
                    </form>
                </div>
                <div class="tab-pane" id="tab3default">
                    <form action="<?= base_url() ?>securityQuestionWali" class="mt-4" id="form" method="post">
                        <label>NIK</label>
                        <input type="hidden" id="role" name="role" value="4"> 
                        <input type="number" class="form-control" name="id_referensi" id="id_referensi" placeholder="Masukkan NIK Akun Anda">
                        <label class="mt-2">NISN Siswa</label>
                        <input type="number" class="form-control" name="nisn" id="nisn" placeholder="Masukkan NISN Siswa Akun Anda">
                        <button type="submit"  class="btn btn-block btn-primary" style="margin-top:20px">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleInputField1() {
            var selectElement1 = document.getElementById('pertanyaan_1');
            var containerLain1 = document.getElementById('containerLain1');
            var inputField = document.getElementById('pertanyaanLain1');
            if (selectElement1.value === 'lainnya_1') {
                containerLain1.style.display = 'block';
                inputField.value = '';
                inputField.setAttribute('required', 'true');
            } else {
                containerLain1.style.display = 'none';
                inputField.value = selectElement1.value;
            
            }
    
        }

        function toggleInputField2() {
            var selectElement2 = document.getElementById('pertanyaan_2');
            var containerLain2 = document.getElementById('containerLain2');
            var inputField = document.getElementById('pertanyaanLain2');
            if (selectElement2.value === 'lainnya_2') {
                containerLain2.style.display = 'block';
                inputField.value = '';
                inputField.setAttribute('required', 'true');
            } else {
                containerLain2.style.display = 'none';
                inputField.value = selectElement2.value;
            }
        }

        function toggleInputField3() {
            var selectElement3 = document.getElementById('pertanyaan_3');
            var containerLain3 = document.getElementById('containerLain3');
            var inputField = document.getElementById('pertanyaanLain3');
            if (selectElement3.value === 'lainnya_3') {
                containerLain3.style.display = 'block';
                inputField.value = '';
                inputField.setAttribute('required', 'true');
            } else {
                containerLain3.style.display = 'none';
                inputField.value = selectElement3.value;
            }
        }

        function toggleInputField4() {
            var selectElement4 = document.getElementById('pertanyaan_4');
            var containerLain4 = document.getElementById('containerLain4');
            var inputField = document.getElementById('pertanyaanLain4');

            if (selectElement4.value === 'lainnya_4') {
                containerLain4.style.display = 'block';
                inputField.value = '';
                inputField.setAttribute('required', 'true');
            } else {
                containerLain4.style.display = 'none';
                inputField.value = selectElement4.value;
            }
        }

        function toggleInputField5() {
            var selectElement5 = document.getElementById('pertanyaan_5');
            var containerLain5 = document.getElementById('containerLain5');
            var inputField = document.getElementById('pertanyaanLain5');
            if (selectElement5.value === 'lainnya_5') {
                containerLain5.style.display = 'block';
                inputField.value = '';
                inputField.setAttribute('required', 'true');
            } else {
                containerLain5.style.display = 'none';
                inputField.value = selectElement5.value;
            }
        }
</script>
<script>
        $(document).ready(function(){
            $('input[type="radio"][data-toggle="tab"]').on('click', function(){
                var target = $(this).data('href');
                $('.tab-content .tab-pane').removeClass('in active');
                $(target).addClass('in active');
            });
        });
    </script>
    <?php if(session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "<?= session()->getFlashdata('error') ?>"
        });
    </script>
<?php endif; ?>
<?= $this->endSection()?>