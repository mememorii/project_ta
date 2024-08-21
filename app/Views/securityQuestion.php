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
        width:600px;
        border-width:0px;
    }
    .custom-center {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .custom-center2 {
        vertical-align: middle;
    }
</style>
<div class="container-fluid">
    <div class="card toForgot2">
        <div class="card-header">
            <h3 class="card-title">Security Question</h3>
        </div>
        <div class="card-body">
            <span class="custom-center mb-4 grid-item" style="color:gray">
                <i class="fa-solid fa-circle-question mb-4" style="font-size:55px; vertical-align: middle;"></i>
                <span>Hallo, <?= $nama['nama'] ?></span>
                Jawab Pertanyaan Berikut Untuk Mereset Password Anda
            </span>
            <hr>
            <div class="row mt-1">
                <div class="col-md-6">    
                    <label>Pertanyaan</label>
                </div>
                <div class="col-md-6">    
                    <label>Jawaban</label>
                </div>
            </div>
            <form class="grid-item custom-center2" action="<?= base_url() ?>cekPertanyaan" id="form" method="post">
                <input type="hidden" class="form-control" name="id_referensi" id="id_referensi" value="<?= $forgot['id_referensi'] ?>">
                <input type="hidden" class="form-control" name="nik" id="nik" value="<?= $nik ?>">
                <input type="hidden" class="form-control" name="id_referensi2" id="id_referensi2" value="<?= $id_referensi2 ?>">
                <div class="row ">
                    <div class="col-md-6">    
                       
                       <div>
                            <span><?= $forgot['pertanyaan_1'] ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">    
                        <div class="form-group">
                           
                            <input type="text" class="form-control" name="jawaban_1" id="jawaban_1" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">    
                       
                       <div>
                            <span><?= $forgot['pertanyaan_2'] ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">    
                        <div class="form-group">
                       
                        <input type="text" class="form-control" name="jawaban_2" id="jawaban_2" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">    
                       
                       <div>
                            <span><?= $forgot['pertanyaan_3'] ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">    
                        <div class="form-group">
                            
                            <input type="text" class="form-control" name="jawaban_3" id="jawaban_3" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">    
                        <div>
                            <?php if(!empty($forgot['pertanyaan_4'])) { ?>
                                <span><?= $forgot['pertanyaan_4'] ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-6">    
                        <div class="form-group">
                            <?php if(!empty($forgot['pertanyaan_4'])) { ?>
                                <input type="text" class="form-control" name="jawaban_4" id="jawaban_4">
                            <?php }else{ ?>
                                <input type="hidden" class="form-control" name="jawaban_4" id="jawaban_4">
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">    
                        <div>
                        <?php if(!empty($forgot['pertanyaan_5'])) { ?>
                            <span><?= $forgot['pertanyaan_5'] ?></span>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-6">    
                        <div class="form-group">
                            <?php if(!empty($forgot['pertanyaan_5'])) { ?>
                                <input type="text" class="form-control" name="jawaban_5" id="jawaban_5">
                            <?php }else{ ?>
                                <input type="hidden" class="form-control" name="jawaban_5" id="jawaban_5">
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <center><button type="submit" class="btn btn-primary">Submit</button></center>
            </div>
        </form>
    </div>
</div>
<?php if(session()->getFlashdata('error')){ ?>
<script>
  Swal.fire({
        icon: "error",
        title: "Error",
        text: "<?= session()->getFlashdata('error') ?>"
    }).then(() => {
                    <?php session()->remove('error'); ?>
                });
</script>
<?php } ?>
<?= $this->endSection()?>







     