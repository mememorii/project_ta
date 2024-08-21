<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Form Tambah Data</h3>
                </div>
                <form action="<?= base_url() ?>siswa/update" method="post" id="form-edit">
                    <input type="hidden" name="id_data" value="<?= $siswa['nisn'] ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?= $siswa['nama'] ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control" style="width: 100%;" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="<?= $siswa['jenis_kelamin'] ?>" selected hidden><?= $siswa['jenis_kelamin'] ?></option>
                                        <option value="Laki Laki">Laki Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>    
                            <div class="col-md-3">    
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?= $siswa['tempat_lahir'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">    
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="<?= $siswa['tanggal_lahir'] ?>" required>
                                </div>
                            </div>    
                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label>Agama</label>
                                    <select class="form-control" style="width: 100%;" name="agama" id="agama">
                                    <option value="<?= $siswa['agama'] ?>" selected hidden><?= $siswa['agama'] ?></option>
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
                                        <option value="<?= $siswa['kelas'] ?>"selected hidden>
                                            <?php 
                                                if($siswa['kelas'] == 1){
                                                    echo"Satu";
                                                }elseif($siswa['kelas'] == 2){
                                                    echo"Dua";
                                                }elseif($siswa['kelas'] == 3){
                                                    echo"Tiga";
                                                }elseif($siswa['kelas'] == 4){
                                                    echo"Empat";
                                                }elseif($siswa['kelas'] == 5){
                                                    echo"Lima";
                                                }else{
                                                    echo"Enam";
                                                }   
                                            ?>
                                        </option>
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
                                    <option value="<?= $siswa['rombel'] ?>" selected hidden><?= $siswa['rombel'] ?></option>
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
                                    <input type="number" class="form-control" name="nik" id="nik" value="<?= $siswa['nik'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>NIPD</label>
                                    <input type="number" class="form-control" name="nipd" id="nipd" value="<?= $siswa['nipd'] ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>NISN</label>
                                    <input type="number" class="form-control" name="nisn" id="nisn" value="<?= $siswa['nisn'] ?>">
                                </div>
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>RT</label>
                                    <input type="number" class="form-control" name="rt" id="rt" value="<?= $siswa['rt'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>RW</label>
                                    <input type="number" class="form-control" name="rw" id="rw" value="<?= $siswa['rw'] ?>" required>
                                </div>    
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input type="text" class="form-control" name="kelurahan" id="kelurahan" value="<?= $siswa['kelurahan'] ?>" required>
                                </div>
                            </div>
                        </div>            
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea id="alamat" name="alamat" rows="4" class="form-control" required><?= $siswa['alamat'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" id="status" required >
                                <option value="<?= $siswa['status'] ?>" selected hidden><?= $siswa['status'] ?></option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
    </div>
</div>
<script src="<?= base_url()?>public/assets/dist/js/editSiswa.js"></script>
<script>
    <?php if(session()->has("error")){ ?>
    Swal.fire({
      icon:'error',
      title:'error',
      confirmButtonColor:'#7bb3ff',
      text: '<?= session("error") ?>'
    })
  <?php } ?>
</script>
<?= $this->endSection()?>