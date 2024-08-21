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
                                <tr><th>Nama</th><td><?=$guru['nama']?></td></tr>
                                <tr><th>NIP</th><td><?=$guru['nip']?></td></tr>
                                <tr><th>NIK</th><td><?=$guru['nik']?></td></tr>
                                <tr><th>Jabatan</th><td><?=$guru['jabatan']?></td></tr>
                                <tr><th>Jenis Kelamin</th><td><?=$guru['jenis_kelamin']?></td></tr>
                                <tr><th>Agama</th><td><?=$guru['agama']?></td></tr>
                                <tr><th>Pendidikan</th><td><?=$guru['pendidikan']?></td></tr>
                                <tr><th>Pangkat</th><td><?=$guru['pangkat']?></td></tr>
                                <tr><th>Guru Kelas</th>
                                    <td>
                                        <?php 
                                            if($guru['guru_kelas'] == 1){
                                                echo"Satu";
                                            }elseif($guru['guru_kelas'] == 2){
                                                echo"Dua";
                                            }elseif($guru['guru_kelas'] == 3){
                                                echo"Tiga";
                                            }elseif($guru['guru_kelas'] == 4){
                                                echo"Empat";
                                            }elseif($guru['guru_kelas'] == 5){
                                                echo"Lima";
                                            }elseif($guru['guru_kelas'] == 6){
                                                echo"Enam";
                                            }else{
                                                echo"-";
                                            }   
                                        ?>        
                                    </td>
                                </tr>
                                <tr><th>Rombel</th>
                                    <td>
                                        <?php if($guru['rombel'] != "A" && $guru['rombel'] != "B"){
                                            echo"-";
                                        }else{ 
                                            echo$guru['rombel']; 
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