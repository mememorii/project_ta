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
                                <tr><th>Nama</th><td><?=$guru['nama']?></td></tr>
                                <tr><th>NIP</th><td><?=$guru['nip']?></td></tr>
                                <tr><th>NIK</th><td><?=$guru['nik']?></td></tr>
                                <tr><th>Jabatan</th><td><?=$guru['jabatan']?></td></tr>
                                <tr><th>Jenis Kelamin</th><td><?=$guru['jk']?></td></tr>
                                <tr><th>Agama</th><td><?=$guru['agama']?></td></tr>
                                <tr><th>Pendidikan</th><td><?=$guru['pendidikan']?></td></tr>
                                <tr><th>Pangkat</th><td><?=$guru['pangkat']?></td></tr>
                                <tr><th>Guru Kelas</th><td><?=$guru['guru_kelas'] ?? '-' ?></td></tr>
                                <tr><th>Rombel</th><td><?=$guru['rombel'] ?? '-' ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url() ?>guru/export/<?= $guru['id_guru'] ?>" class="btn btn-primary"><i class="fa-solid fa-print" style=""></i><span class="ml-2">Cetak Data</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection()?>