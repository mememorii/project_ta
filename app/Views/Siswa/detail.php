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
                            <tr><th>Nama</th><td><?=$siswa['nama']?></td></tr>
                            <tr><th>NIK</th><td><?=$siswa['nik'] ?? '-' ?></td></tr>
                            <tr><th>NIPD</th><td><?=$siswa['nipd'] ?? '-' ?></td></tr>
                            <tr><th>NISN</th><td><?=$siswa['nisn'] ?? '-' ?></td></tr>
                            <tr><th>Jenis Kelamin</th><td><?=$siswa['jk']?></td></tr>
                            <tr><th>Tempat Lahir</th><td><?=$siswa['tempat_lahir']?></td></tr>
                            <tr><th>Tanggal Lahir</th><td><?=$siswa['tanggal_lahir']?></td></tr>
                            <tr><th>Agama</th><td><?=$siswa['agama']?></td></tr>
                            <tr><th>Alamat</th><td><?=$siswa['alamat']?></td></tr>
                            <tr><th>RT</th><td><?=$siswa['rt']?></td></tr>
                            <tr><th>RW</th><td><?=$siswa['rw']?></td></tr>
                            <tr><th>Kelurahan</th><td><?=$siswa['kelurahan']?></td></tr>
                            <tr><th>Kelas</th><td><?=$siswa['kelas']?></td></tr>
                            <tr><th>Rombel</th><td><?=$siswa['rombel'] ?? '-' ?></td></tr>
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
                    <a href="<?= base_url() ?>siswa/export/<?= $siswa['id_siswa'] ?>" class="btn btn-primary"><i class="fa-solid fa-print" style=""></i><span class="ml-2">Cetak Data</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection()?>