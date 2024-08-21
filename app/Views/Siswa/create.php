<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Form Tambah Data</h3>
                </div>
                <form action="<?= base_url("siswa/store") ?>" method="post" id="form">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control" style="width: 100%;" name="jenis_kelamin" id="jenis_kelamin" required>
                                        <option value="" selected hidden disabled>Pilih Jenis Kelamin</option>
                                        <option value="Laki Laki">Laki Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>    
                            <div class="col-md-3">    
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir" required>
                                </div>
                            </div>
                            <div class="col-md-3">    
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Masukkan Tanggal Lahir" required>
                                </div>
                            </div>    
                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label>Agama</label>
                                    <select class="form-control" style="width: 100%;" name="agama" id="agama" required>
                                        <option value="" selected dsiabled hidden>Pilih Agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Khonghucu">Khonghucu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select class="form-control" style="width: 100%;" name="kelas" id="kelas" onchange="updateRombel()" required>
                                        <option value="" selected hidden>Pilih Kelas</option>
                                        <option value="1">Satu</option>
                                        <option value="2">Dua</option>
                                        <option value="3">Tiga</option>
                                        <option value="4">Empat</option>
                                        <option value="5">Lima</option>
                                        <option value="6">Enam</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rombel</label>
                                    <select class="form-control" style="width: 100%;" name="rombel" id="rombel" disabled required>
                                        <option value="" selected hidden>Pilih Rombel</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="number" class="form-control" name="nik" id="nik" placeholder="Masukkan NIK" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>NIPD</label>
                                    <input type="number" class="form-control" name="nipd" id="nipd" placeholder="Masukkan NIPD">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>NISN</label>
                                    <input type="number" class="form-control" name="nisn" id="nisn" placeholder="Masukkan NISN">
                                </div>
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>RT</label>
                                    <input type="number" class="form-control" name="rt" id="rt" placeholder="Masukkan RT" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>RW</label>
                                    <input type="number" class="form-control" name="rw" id="rw" placeholder="Masukkan RW" required>
                                </div>    
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input type="text" class="form-control" name="kelurahan" id="kelurahan" placeholder="Masukkan Kelurahan" required>
                                </div>
                            </div>
                        </div>            
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea id="alamat" name="alamat" rows="4" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
    </div>
</div>
<script src="<?= base_url()?>public/assets/dist/js/addSiswa.js"></script>
<?php if(session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?= session()->getFlashdata('error') ?>',
        });
    </script>
<?php endif; ?>
<?= $this->endSection()?>