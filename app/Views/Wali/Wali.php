<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <?php if (session()->get('role') == '1') { ?>
            <a href="<?= base_url("/wali/create") ?>"><button class="btn btn-primary"><i class="fa-solid fa-user-plus"></i><span class="ml-2">Tambah Data</span></button></a>
          <?php } ?>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nomor</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Jenis kelamin</th>
                <th>Nama Siswa</th>
                <th>Kelas Siswa</th>
                <th>Rombel Siswa</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
                foreach($getData as $key =>$value){
              ?>
                <tr>
                  <td><?=$no++?></td>
                  <td><?=$value['nama']?></td>
                  <td><?=$value['nik']?></td>
                  <td><?=$value['jenis_kelamin']?></td>
                  <td><?=$value['nama_siswa']?></td>
                  <td data-order="<?= $value['kelas_siswa'] ?>">
                    <?php if($value['kelas_siswa'] == 1){
                      echo"Satu";
                    }elseif($value['kelas_siswa'] == 2){
                      echo"Dua";
                    }elseif($value['kelas_siswa'] == 3){
                      echo"Tiga";
                    }elseif($value['kelas_siswa'] == 4){
                      echo"Empat";
                    }elseif($value['kelas_siswa'] == 5){
                      echo"Lima";
                    }else{
                      echo"Enam";
                    }   
                    ?>
                  </td>
                  <td>
                    <?php if($value['rombel_siswa'] != "A" && $value['rombel_siswa'] != "B"){
                      echo"-";
                    }else{ 
                      echo$value['rombel_siswa']; 
                    } ?> 
                  </td>
                  <td>
                    <?php if (session()->get('role') == '1') { ?>
                      <a href="<?= base_url() ?>admin/wali/detail/<?= $value['nik'] ?>" class="btn btn-sm btn-primary mb-1"><i class="fa-solid fa-circle-info"></i></a>
                      <a href="<?= base_url() ?>wali/edit/<?= $value['nik'] ?>" class="btn btn-sm btn-primary mb-1"><i class="fas fa-edit"></i></a>
                      <a href="<?= base_url() ?>wali/delete/<?= $value['nik'] ?>" class="btn btn-sm btn-danger konfirmasi"><i class="fas fa-trash"></i></a>
                    <?php }else{ ?>
                      <a href="<?= base_url() ?>guru/wali/detail/<?= $value['nik'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
                    <?php } ?>
                  </td>
                </tr>
              <?php 
                } 
              ?>
            </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php if(session()->getFlashdata('success')) { ?>
  <script>
    Swal.fire({
      icon:'success',
      title:'Sukses',
      confirmButtonColor:'#7bb3ff',
      text: '<?= session("success") ?>'
    })
  </script>
  <?php } ?>
<?= $this->endSection()?>