<?php if(session()->get('role') == 1 || session()->get('role') == 2){ ?>
    <?= $this->extend('layouts/master') ?>
    <?= $this->section('content') ?>
    <div class="container-fluid">
<?php }else{ ?>
    <?= $this->extend('layout_user/master') ?>
    <?= $this->section('content') ?>
    <div class="container-fluid" style="padding-left:99px;padding-right:99px">
<?php } ?>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">User Account</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <tbody>
                        <tr><th>Nama</th><td><?= set_value('nama', session()->get('nama')) ?></td></tr>
                        <tr><th>NIK</th><td><?= set_value('nama', session()->get('nik')) ?></td></tr>
                        <tr>
                            <th>Role</th>
                            <td>
                                <?php if(session()->get('role') == 1){ ?>
                                    Admin
                                <?php }elseif(session()->get('role') == 2){ ?>
                                    Guru
                                <?php }elseif(session()->get('role') == 3){ ?>
                                    Siswa
                                <?php }else{ ?>
                                    Wali Siswa
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="<?= base_url() ?>user/account" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i><span class="ml-2">Edit Password</span></a>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Data</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <tbody>
                        <?php if(session()->get('role') == 3 ){ ?>
                            <tr><th>Nama</th><td><?=$profile['nama']?></td></tr>
                            <tr><th>NIK</th><td><?=$profile['nik'] ?? '-' ?></td></tr>
                            <tr><th>NIPD</th><td><?=$profile['nipd'] ?? '-' ?></td></tr>
                            <tr><th>NISN</th><td><?=$profile['nisn'] ?? '-' ?></td></tr>
                            <tr><th>Jenis Kelamin</th><td><?=$profile['jk']?></td></tr>
                            <tr><th>Tempat Lahir</th><td><?=$profile['tempat_lahir']?></td></tr>
                            <tr><th>Tanggal Lahir</th><td><?=$profile['tanggal_lahir']?></td></tr>
                            <tr><th>Kelas</th><td><?=$profile['kelas']?></td></tr>
                            <tr><th>Rombel</th><td><?=$profile['rombel'] ?? '-' ?></td></tr>
                            <tr><th>Status</th>
                                <td> 
                                    <?php if($profile['status'] == 'Aktif'){ ?>
                                    <span class="badge badge-success">Aktif</span>
                                    <?php }else{ ?>
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php }elseif(session()->get('role') == 1 || session()->get('role') == 2){ ?>
                            <tr><th>Nama</th><td><?=$profile['nama']?></td></tr>
                            <tr><th>NIP</th><td><?=$profile['nip']?></td></tr>
                            <tr><th>NIK</th><td><?=$profile['nik']?></td></tr>
                            <tr><th>Jabatan</th><td><?=$profile['jabatan']?></td></tr>
                            <tr><th>Jenis Kelamin</th><td><?=$profile['jk']?></td></tr>
                            <tr><th>Pendidikan</th><td><?=$profile['pendidikan']?></td></tr>
                            <tr><th>Pangkat</th><td><?=$profile['pangkat']?></td></tr>
                            <tr><th>Agama</th><td><?=$profile['agama']?></td></tr>
                            <tr><th>Guru Kelas</th><td><?=$profile['guru_kelas'] ?? '-' ?></td></tr>
                            <tr><th>Rombel</th><td><?=$profile['rombel'] ?? '-' ?></td></tr>
                        <?php }else{ ?>
                            <tr><th>Nama</th><td><?=$profile['nama']?></td></tr>
                            <tr><th>NIK</th><td><?=$profile['nik']?></td></tr>
                            <tr><th>Jenis Kelamin</th><td><?=$profile['jk']?></td></tr>
                            <tr><th>Pekerjaan</th><td><?=$profile['pekerjaan']?></td></tr>
                            <tr><th>Nama siswa</th><td><?=$profile['nama_siswa']?></td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection()?>