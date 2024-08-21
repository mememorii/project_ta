<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Form Edit Data</h3>
          </div>
          <form action="<?= base_url() ?>guru/update" method="post" id="form">
            <input type="hidden" name="id_data" value="<?= $guru['nip'] ?>">
            <div class="card-body">
              <div class="form-group">
                <label>Nama</label>
                <input required type="text" class="form-control" name="nama" id="nama" value="<?= $guru['nama'] ?>">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                      <select class="form-control" style="width: 100%;" name="jenis_kelamin" id="jenis_kelamin" required>
                        <option selected="selected" value="<?= $guru['jenis_kelamin'] ?>" hidden><?= $guru['jenis_kelamin'] ?></option>
                        <option value="Laki Laki">Laki Laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                  </div>
                </div>  
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Agama</label>
                    <select class="form-control" style="width: 100%;" name="agama" id="agama" required>
                      <option selected="selected" value="<?= $guru['agama'] ?>" hidden><?= $guru['agama'] ?></option>
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
                    <input required type="number" class="form-control" name="nip" id="nip" value="<?= $guru['nip'] ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>NIK</label>
                    <input required type="number" class="form-control" name="nik" id="nik" value="<?= $guru['nik'] ?>">
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Jabatan</label>
                      <input required type="text" class="form-control" name="jabatan" id="jabatan" value="<?= $guru['jabatan'] ?>">
                    </div>
                </div>
              </div>
              <div class="row">   
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Pendidikan</label>
                        <input required type="text" class="form-control" name="pendidikan" id="pendidikan" value="<?= $guru['pendidikan'] ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Pangkat</label>
                        <input required type="text" class="form-control" name="pangkat" id="pangkat" value="<?= $guru['pangkat'] ?>">
                    </div>
                  </div>  
                </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Guru Kelas</label>
                      <select class="form-control" style="width: 100%;" name="guru_kelas" id="guru_kelas" onchange="updateRombel()">
                        <option value="">Guru Mata pelajaran</option>
                        <option selected="selected" value="<?= $guru['guru_kelas'] ?>" hidden>
                          <?php 
                            if($guru['guru_kelas'] == 1){
                                echo"Satu";
                            }elseif($guru['guru_kelas'] == 2){
                                echo"Dua";
                            }elseif($guru['guru_kelas'] == 3){
                                echo"Tiga";
                            }elseif($guru['guru_kelas'] == 4){
                                echo"Empat";
                            }elseif($guru['guru_kelas'] == 5){
                                echo"Lima";
                            }elseif($guru['guru_kelas'] == 6){
                                echo"Enam";
                            }else{
                              echo"Guru Mata Pelajaran";
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
                      <select class="form-control" style="width: 100%;" name="rombel" id="rombel" disabled>
                        <?php if($guru['rombel'] == ""){ ?>
                          <option selected="selected" value="" selected hidden>-</option>
                        <?php }else{ ?>
                          <option selected="selected" value="<?= $guru['rombel'] ?>" selected hidden><?= $guru['rombel'] ?></option>
                        <?php } ?>
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
  <script src="<?= base_url()?>public/assets/dist/js/editGuru.js"></script>
  <?php if(session()->getFlashdata('error')) { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Error',
        confirmButtonColor:'#7bb3ff',
        text: '<?= session()->getFlashdata('error') ?>',})
    </script>
  <?php } ?>
<?= $this->endSection()?>