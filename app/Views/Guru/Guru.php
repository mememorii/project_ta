<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <?php if (session()->get('role') == '1') { ?>
            <a href="<?= base_url("/guru/create") ?>"><button class="btn btn-primary"><i class="fa-solid fa-user-plus"></i><span class="ml-2">Tambah Data</span></button></a>
          <?php } ?>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nomor</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Guru Kelas</th>
                <th>Rombel</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
                foreach($getData as $row =>$value){
              ?>
                <tr>
                  <td><?=$no++?></td>
                  <td><?=$value['nama']?></td>
                  <td><?=$value['nip']?></td>
                  <td><?=$value['jenis_kelamin']?></td>
                  <td><?=$value['jabatan']?></td>
                  <td data-order="<?= $value['guru_kelas'] ?>">
                    <?php if($value['guru_kelas'] == 1){
                        echo"Satu";
                      }elseif($value['guru_kelas'] == 2){
                        echo"Dua";
                      }elseif($value['guru_kelas'] == 3){
                        echo"Tiga";
                      }elseif($value['guru_kelas'] == 4){
                        echo"Empat";
                      }elseif($value['guru_kelas'] == 5){
                        echo"Lima";
                      }elseif($value['guru_kelas'] == 6){
                        echo"Enam";
                      }else{
                        echo"-";
                      }   
                    ?>
                  </td>
                  <td>
                    <?php if($value['rombel'] != "A" && $value['rombel'] != "B"){
                      echo"-";
                    }else{ 
                      echo$value['rombel']; 
                    } ?> 
                  </td>
                  <td>
                    <?php if (session()->get('role') == '1') { ?>
                      <a href="<?= base_url() ?>admin/guru/detail/<?= $value['nip']?>" class="btn btn-sm btn-primary mb-1"><i class="fa-solid fa-circle-info"></i></a>
                      <a href="<?= base_url() ?>guru/edit/<?= $value['nip']?>" class="btn btn-sm btn-primary mb-1"><i class="fas fa-edit"></i></a>
                      <a href="<?= base_url() ?>guru/delete/<?= $value['nip']?>" class="btn btn-sm btn-danger konfirmasi"><i class="fas fa-trash" ></i></a>
                    <?php }else { ?>
                      <a href="<?= base_url() ?>guru/guru/detail/<?= $value['nip']?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
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
        icon: 'success',
        title: 'Sukses',
        confirmButtonColor:'#7bb3ff',
        text: '<?= session()->getFlashdata('success') ?>',})
    </script>
  <?php } ?>
<?= $this->endSection()?>