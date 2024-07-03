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
          <form action="<?= base_url("wali/update") ?>" method="post" id="text-editor">
            <input type="hidden" name="id_wali" value="<?= $wali['id_wali'] ?>">
            <div class="card-body">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" value="<?= $wali['nama'] ?>">
                <?php if ($validation->getError('nama')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('nama'); ?>
                    </div>
                <?php } ?>
              </div>
              <div class="row">
              <div class="col-md-3">  
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" style="width: 100%;" name="jk" id="jk" required>
                      <option selected="selected" value="<?= $wali['jk'] ?>" hidden><?= $wali['jk'] ?></option>
                      <option value="Laki Laki">Laki Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">  
                  <div class="form-group">
                    <label>NIK</label>
                    <input type="number" class="form-control" name="nik" id="nik" value="<?= $wali['nik'] ?>">
                    <?php if ($validation->getError('nik')) { ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('nik'); ?>
                        </div>
                    <?php } ?>
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
                      <input type="text" class="form-control" name="pendidikan" id="pendidikan" placeholder="<?= $wali['pendidikan'] ?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                  <label>Siswa</label>
                  <select class="form-control select2" style="width: 100%;" name="id_siswa" id="id_siswa" required>
                    <?php 
                      $siswaWali = '';
                      foreach ($getData as $value) {
                          if ($value['id_siswa'] == $wali['id_siswa']) {
                              $siswaWali = $value['nama'];
                              break;
                          }
                      }
                    ?>
                    <option selected="selected" value="<?= $value['id_siswa'] ?>" hidden>
                      <?= $siswaWali ?>
                    </option>
                    <?php foreach($getData as $value) { ?>
                        <option value="<?= $value['id_siswa'] ?>" data-kelas="<?= $value['kelas'] ?>" data-rombel="<?= $value['rombel'] ?>">
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
  <script>
    $(document).ready(function() {
        $('#id_siswa').change(function() {
            var selectedOption = $(this).find('option:selected');
            
            var kelas = selectedOption.data('kelas');
            var rombel = selectedOption.data('rombel');

            $('#kelas').val(kelas);
            $('#rombel').val(rombel);
        });
    });
</script>
  <script>
          document.addEventListener('DOMContentLoaded', (event) => {
              const form = document.getElementById('text-editor');

              form.addEventListener('submit', function(event) {
                  event.preventDefault(); 

                  Swal.fire({
                      title: 'Apakah anda yakin?',
                      text: "Pastikan data yang dimasukkan benar",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#28a745',
                      cancelButtonColor: '#d33',
                      cancelButtonText: 'Tidak',
                      confirmButtonText: 'Iya'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          form.submit(); 
                      }
                  });
              });
          });
  </script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form');
 
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Ambil nilai input
        const nama = document.getElementById('nama').value;
        const nik = document.getElementById('nik').value;

        // Validasi karakter minimal
        if (nama.length < 3) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Nama harus memiliki minimal 3 karakter.',
            });
        } else if(nama.length > 60) {
            // Proses form jika valid
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Nama tidak boleh memiliki lebih dari 60 karakter.',
            });
        } else if(nik.length < 16 || nik.length > 16) {
            // Proses form jika valid
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'NIK harus memiliki 16 karakter.',
            });
        } else {
            // Proses form jika valid
          
              event.preventDefault(); 

              const href = this.getAttribute('href');

              Swal.fire({
                  title: 'Apakah Data Yang Dimasukkan Benar?',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#28a745',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Tidak',
                  confirmButtonText: 'Iya'
              }).then((result) => {
                  if (result.isConfirmed) {
                    form.submit(); 
                  }
              });
         
     
           
        }
    });
});
</script>
<?= $this->endSection()?>