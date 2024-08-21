<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Form Tambah Data</h3>
          </div>
          <form action="<?= base_url("wali/store") ?>" method="post" id="form">
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
                      <option value="" selected="selected" hidden disabled>Pilih Jenis Kelamin</option>
                      <option value="Laki Laki">Laki Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">  
                  <div class="form-group">
                    <label>NIK</label>
                    <input type="number" class="form-control" name="nik" id="nik" placeholder="Masukkan NIK" required>
                  </div>  
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                      <label>Pekerjaan</label>
                      <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Masukkan Pekerjaan" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                      <label>Pendidikan</label>
                      <input type="text" class="form-control" name="pendidikan" id="pendidikan" placeholder="Masukkan Pendidikan" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" id="alamat" rows="4" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <label>Siswa</label>
                <select class="form-control select2" style="width: 100%;" name="nisn_siswa" id="nisn_siswa" required>
                  <option value="" hidden disabled selected>Pilih Siswa</option>
                  <?php foreach($getData as $value) { ?>
                      <option value="<?= $value['nisn'] ?>" data-kelas="<?= $value['kelas'] ?>" data-rombel="<?= $value['rombel'] ?>">
                        <?= $value['nama'] ?>
                      </option>
                  <?php } ?> 
                </select>
                <input type="hidden" class="form-control" name="kelas" id="kelas">
                <input type="hidden" class="form-control" name="rombel" id="rombel">
              </div>  
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>       
  </div>
  <script src="<?= base_url()?>public/assets/dist/js/addWali.js"></script>
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