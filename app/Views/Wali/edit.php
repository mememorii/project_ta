<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
  <?php $validation = \Config\Services::validation(); ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Form Edit Data</h3>
          </div>
          <form action="<?= base_url("wali/update") ?>" method="post" id="form">
            <input type="hidden" name="id_data" id="id_data" value="<?= $wali['nik'] ?>">
            <div class="card-body">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" value="<?= $wali['nama'] ?>">
               
              </div>
              <div class="row">
              <div class="col-md-3">  
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" style="width: 100%;" name="jenis_kelamin" id="jenis_kelamin" required>
                      <option selected="selected" value="<?= $wali['jenis_kelamin'] ?>" hidden><?= $wali['jenis_kelamin'] ?></option>
                      <option value="Laki Laki">Laki Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">  
                  <div class="form-group">
                    <label>NIK</label>
                    <input type="number" class="form-control" name="nik" id="nik" value="<?= $wali['nik'] ?>">
                   
                  </div>  
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                      <label>Pekerjaan</label>
                      <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="<?= $wali['pekerjaan'] ?>">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                      <label>Pendidikan</label>
                      <input type="text" class="form-control" name="pendidikan" id="pendidikan" value="<?= $wali['pendidikan'] ?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" id="alamat" rows="4" class="form-control"><?= $wali['alamat'] ?></textarea>
              </div>
              <div class="form-group">
                  <label>Siswa</label>
                  <select class="form-control select2" style="width: 100%;" name="nisn_siswa" id="nisn_siswa" required>
                    <?php 
                      $siswaWali = '';
                      foreach ($getData as $value) {
                          if ($value['nisn'] == $wali['nisn_siswa']) {
                              $siswaWali = $value['nama'];
                              break;
                          }
                      }
                    ?>
                    <option selected="selected" value="<?= $value['nisn'] ?>" hidden>
                      <?= $siswaWali ?>
                    </option>
                    <?php foreach($getData as $value) { ?>
                        <option value="<?= $value['nisn'] ?>" data-kelas="<?= $value['kelas'] ?>" data-rombel="<?= $value['rombel'] ?>">
                          <?= $value['nama'] ?>
                        </option>
                    <?php } ?> 
                  </select>
                  <input type="hidden" class="form-control" name="kelas" id="kelas" value="<?= $wali['kelas_siswa'] ?>">
                  <input type="hidden" class="form-control" name="rombel" id="rombel" value="<?= $wali['rombel_siswa'] ?>">
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
  <script src="<?= base_url()?>public/assets/dist/js/editWali.js"></script>
  <script>
  $(function(){

    <?php if(session()->has("error")){ ?>
    Swal.fire({
      icon:'error',
      title:'error',
      confirmButtonColor:'#7bb3ff',
      text: '<?= session("error") ?>'
    })
  <?php } ?>
  });
</script>
<?= $this->endSection()?>