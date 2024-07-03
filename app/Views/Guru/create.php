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
                      <select class="form-control" style="width: 100%;" name="jk" id="jk" required>
                        <option selected="selected" hidden disabled>Pilih Jenis Kelamin</option>
                        <option value="Laki Laki">Laki Laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                  </div>
                </div>  
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Agama</label>
                    <select class="form-control" style="width: 100%;" name="agama" id="agama" required>
                      <option selected="selected" hidden disabled>Pilih Agama</option>
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
                        <option selected="selected" hidden disabled>Pilih Kelas</option>
                        <option value="Satu">Satu</option>
                        <option value="Dua">Dua</option>
                        <option value="Tiga">Tiga</option>
                        <option value="Empat">Empat</option>
                        <option value="Lima">Lima</option>
                        <option value="Enam">Enam</option>
                      </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Rombel</label>
                      <select class="form-control" style="width: 100%;" name="rombel" id="rombel" disabled required>
                          <option selected hidden>Pilih Rombel</option>
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
  <script>
      function updateRombel() {
        var kelas = document.getElementById("guru_kelas").value;
        var rombel = document.getElementById("rombel");

        // Clear existing options
        rombel.innerHTML = '<option value="" hidden>Pilih Rombel</option>';

        if (kelas === "Satu") {

            rombel.disabled = false; // Enable rombel select
            var optionA = document.createElement("option");
            optionA.value = "A";
            optionA.text = "A";
            rombel.appendChild(optionA);

            var optionB = document.createElement("option");
            optionB.value = "B";
            optionB.text = "B";
            rombel.appendChild(optionB);
        } else if (kelas === "Empat") {
            rombel.disabled = false; // Enable rombel select
            var optionA = document.createElement("option");
            optionA.value = "A";
            optionA.text = "A";
            rombel.appendChild(optionA);

            var optionB = document.createElement("option");
            optionB.value = "B";
            optionB.text = "B";
            rombel.appendChild(optionB);
        } else if (kelas === "Lima") {
            rombel.disabled = false; // Enable rombel select
            var optionA = document.createElement("option");
            optionA.value = "A";
            optionA.text = "A";
            rombel.appendChild(optionA);

            var optionB = document.createElement("option");
            optionB.value = "B";
            optionB.text = "B";
            rombel.appendChild(optionB);
        }else if (kelas === "Enam") {
            rombel.disabled = false; // Enable rombel select
            var optionA = document.createElement("option");
            optionA.value = "A";
            optionA.text = "A";
            rombel.appendChild(optionA);

            var optionB = document.createElement("option");
            optionB.value = "B";
            optionB.text = "B";
            rombel.appendChild(optionB);
        } else {
            rombel.disabled = true; // Disable rombel select
        }
        // You can add more conditions for other classes if needed
      }
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.getElementById('form');
  
      form.addEventListener('submit', function(event) {
          event.preventDefault();
          
          // Ambil nilai input
          const nama = document.getElementById('nama').value;
          const nik = document.getElementById('nik').value;
          const nip = document.getElementById('nip').value;
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
          }else if(nip.length > 18 || nip.length < 18) {
              // Proses form jika valid
              Swal.fire({
                  icon: 'error',
                  title: 'Error!',
                  text: 'NIP harus memiliki 18 karakter.',
              }); 
          }else if(nik.length < 16 || nik.length > 16) {
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