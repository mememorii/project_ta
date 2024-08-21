<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Form Tambah Data</h3>
          </div>
          <form action="<?= base_url("guru/store") ?>" method="post" id="form">
            <div class="card-body">
              <div class="form-group">
                <label>Nama</label>
                <input required type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                      <select class="form-control" style="width: 100%;" name="jenis_kelamin" id="jenis_kelamin" required>
                        <option value="" selected="selected" hidden disabled>Pilih Jenis Kelamin</option>
                        <option value="Laki Laki">Laki Laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                  </div>
                </div>  
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Agama</label>
                    <select class="form-control" style="width: 100%;" name="agama" id="agama" required>
                      <option value="" selected="selected" hidden disabled>Pilih Agama</option>
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
                <div class="col-md-4">
                  <div class="form-group">
                    <label>NIP</label>
                    <input required type="number" class="form-control" name="nip" id="nip" placeholder="Masukkan NIP">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>NIK</label>
                    <input required type="number" class="form-control" name="nik" id="nik" placeholder="Masukkan NIK">
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Jabatan</label>
                      <input required type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Masukkan Jabatan">
                    </div>
                </div>
              </div>
              <div class="row">   
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Pendidikan</label>
                        <input required type="text" class="form-control" name="pendidikan" id="pendidikan" placeholder="Masukkan Pendidikan">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Pangkat</label>
                        <input required type="text" class="form-control" name="pangkat" id="pangkat" placeholder="Masukkan Pangkat">
                    </div>
                  </div>  
                </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Guru Kelas</label>
                      <select class="form-control" style="width: 100%;" name="guru_kelas" id="guru_kelas" onchange="updateRombel()">
                        <option value="" selected="selected" hidden disabled>Pilih Kelas</option>
                        <option value="">Guru Mata Pelajaran</option>
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
            </div> 
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= base_url()?>public/assets/dist/js/addGuru.js"></script>
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