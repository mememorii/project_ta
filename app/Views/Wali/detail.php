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
                                <tr><th>Nama</th><td><?=$wali['nama']?></td></tr>
                                <tr><th>NIK</th><td><?=$wali['nik']?></td></tr>
                                <tr><th>Jenis Kelamin</th><td><?=$wali['jenis_kelamin']?></td></tr>
                                <tr><th>Pekerjaan</th><td><?=$wali['pekerjaan']?></td></tr>
                                <tr><th>Pendidikan</th><td><?=$wali['pendidikan']?></td></tr>
                                <tr><th>Alamat</th><td><?=$wali['alamat']?></td></tr>
                                <tr><th>Nama siswa</th><td><?=$wali['nama_siswa']?></td></tr>
                                <tr><th>Kelas siswa</th>
                                    <td>
                                        <?php 
                                            if($wali['kelas_siswa'] == 1){
                                                echo"Satu";
                                            }elseif($wali['kelas_siswa'] == 2){
                                                echo"Dua";
                                            }elseif($wali['kelas_siswa'] == 3){
                                                echo"Tiga";
                                            }elseif($wali['kelas_siswa'] == 4){
                                                echo"Empat";
                                            }elseif($wali['kelas_siswa'] == 5){
                                                echo"Lima";
                                            }else{
                                                echo"Enam";
                                            }   
                                        ?>
                                    </td>
                                </tr>
                                <tr><th>Rombel siswa</th>
                                    <td>
                                        <?php if($wali['rombel_siswa'] != "A" && $wali['rombel_siswa'] != "B"){
                                            echo"-";
                                        }else{ 
                                            echo$wali['rombel_siswa']; 
                                        } ?> 
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