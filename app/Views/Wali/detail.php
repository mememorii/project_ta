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
                        <table id="example1" class="table table-bordered table-striped">
                            <tbody>
                                <tr><th>Nama</th><td><?=$wali['nama']?></td></tr>
                                <tr><th>NIK</th><td><?=$wali['nik']?></td></tr>
                                <tr><th>Jenis Kelamin</th><td><?=$wali['jk']?></td></tr>
                                <tr><th>Pekerjaan</th><td><?=$wali['pekerjaan']?></td></tr>
                                <tr><th>Pendidikan</th><td><?=$wali['pendidikan']?></td></tr>
                                <tr><th>Nama siswa</th><td><?=$wali['nama_siswa']?></td></tr>
                                <tr><th>Kelas siswa</th><td><?=$wali['kelas_siswa']?></td></tr>
                                <tr><th>Rombel siswa</th><td><?= $wali['rombel_siswa'] ?? '-' ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url() ?>wali/export/<?= $wali['id_wali'] ?>" class="btn btn-primary"><i class="fa-solid fa-print" style=""></i><span class="ml-2">Cetak Data</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection()?>