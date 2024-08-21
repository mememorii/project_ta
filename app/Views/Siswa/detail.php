<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Detail Data</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr><th>Nama</th><td><?=$siswa['nama']?></td></tr>
                            <tr><th>NIK</th><td><?=$siswa['nik'] ?? '-' ?></td></tr>
                            <tr><th>NIPD</th><td><?=$siswa['nipd'] ?? '-' ?></td></tr>
                            <tr><th>NISN</th><td><?=$siswa['nisn'] ?? '-' ?></td></tr>
                            <tr><th>Jenis Kelamin</th><td><?=$siswa['jenis_kelamin']?></td></tr>
                            <tr><th>Tempat Lahir</th><td><?=$siswa['tempat_lahir']?></td></tr>
                            <tr><th>Tanggal Lahir</th><td><?=$siswa['tanggal_lahir']?></td></tr>
                            <tr><th>Agama</th><td><?=$siswa['agama']?></td></tr>
                            <tr><th>Alamat</th><td><?=$siswa['alamat']?></td></tr>
                            <tr><th>RT</th><td><?=$siswa['rt']?></td></tr>
                            <tr><th>RW</th><td><?=$siswa['rw']?></td></tr>
                            <tr><th>Kelurahan</th><td><?=$siswa['kelurahan']?></td></tr>
                            <tr><th>Kelas</th>
                                <td>
                                    <?php 
                                        if($siswa['kelas'] == 1){
                                            echo"Satu";
                                        }elseif($siswa['kelas'] == 2){
                                            echo"Dua";
                                        }elseif($siswa['kelas'] == 3){
                                            echo"Tiga";
                                        }elseif($siswa['kelas'] == 4){
                                            echo"Empat";
                                        }elseif($siswa['kelas'] == 5){
                                            echo"Lima";
                                        }else{
                                            echo"Enam";
                                        }   
                                    ?>    
                                </td>
                            </tr>
                            <tr><th>Rombel</th>
                                <td>
                                    <?php if($siswa['rombel'] != "A" && $siswa['rombel'] != "B"){
                                        echo"-";
                                    }else{ 
                                        echo$siswa['rombel']; 
                                    } ?>         
                                </td>
                            </tr>
                            <tr><th>Status</th>
                                <td> 
                                    <?php if($siswa['status'] == 'Aktif'){ ?>
                                    <span class="badge badge-success">Aktif</span>
                                    <?php }else{ ?>
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                  
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection()?>