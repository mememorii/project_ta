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
                    <select class="form-control" style="width: 100%;" name="jk" id="jk" required>
                      <option selected="selected" hidden disabled>Pilih Jenis Kelamin</option>
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
                <label>Siswa</label>
                <select class="form-control select2" style="width: 100%;" name="id_siswa" id="id_siswa" required>
                  <option hidden disabled selected>Pilih Siswa</option>
                  <?php foreach($getData as $value) { ?>
                      <option value="<?= $value['id_siswa'] ?>" data-kelas="<?= $value['kelas'] ?>" data-rombel="<?= $value['rombel'] ?>">
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