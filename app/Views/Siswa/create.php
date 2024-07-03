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
                                    <select class="form-control" style="width: 100%;" name="jk" id="jk" required>
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
                                        <option selected hidden>Pilih Kelas</option>
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
                                    <input type="number" class="form-control" name="nipd" id="nipd" placeholder="Masukkan NIPD" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>NISN</label>
                                    <input type="number" class="form-control" name="nisn" id="nisn" placeholder="Masukkan NISN" required>
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
<script>
    function updateRombel() {
                var kelas = document.getElementById("kelas").value;
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
        const nisn = document.getElementById('nisn').value;
        const nipd = document.getElementById('nipd').value;
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
                text: 'Nama tidak boleh memiliki karakter lebih dari 60.',
            });
        }else if(nisn.length > 10 || nisn.length < 10) {
            // Proses form jika valid
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'NISN harus memiliki 10 karakter.',
            });
        }else if(nipd.length > 4 || nipd.length < 4) {
            // Proses form jika valid
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'NIPD harus memiliki 4 karakter.',
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