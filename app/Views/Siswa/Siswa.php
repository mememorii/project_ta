<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>


<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <?php if (session()->get('role') == '1') { ?>
          <a href="<?= base_url("/siswa/create") ?>"><button class="btn btn-primary"><i class="fa-solid fa-user-plus"></i><span class="ml-2">Tambah Data</span></button></a>
        <?php } ?>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nomor</th>
              <th>Nama</th>
              <th>NIK</th>
              <th>Jenis Kelamin</th>
              <th>Kelas</th>
              <th>Rombel</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
              foreach($getData as $row =>$value){
            ?>
              <tr>
                <td><?=$no++?></td>
                <td><?=$value['nama'] ?></td>
                <td><?=$value['nik'] ?></td>
                <td><?=$value['jenis_kelamin'] ?></td>
                <td data-order="<?= $value['kelas'] ?>">
                  <?php 
                    if($value['kelas'] == 1){
                      echo"Satu";
                    }elseif($value['kelas'] == 2){
                      echo"Dua";
                    }elseif($value['kelas'] == 3){
                      echo"Tiga";
                    }elseif($value['kelas'] == 4){
                      echo"Empat";
                    }elseif($value['kelas'] == 5){
                      echo"Lima";
                    }else{
                      echo"Enam";
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
                <td style="text-align: center;vertical-align: middle;">
                    <?php if($value['status'] == 'Aktif'){ ?>
                      <span class="badge badge-success">Aktif</span>
                    <?php }else{ ?>
                      <span class="badge badge-danger">Tidak Aktif</span>
                    <?php } ?>  
                </td>
                <td>
                <?php if (session()->get('role') == '1') {  ?>
                  <a href="<?= base_url() ?>admin/siswa/detail/<?= $value['nisn'] ?>" class="btn btn-sm btn-primary mb-1"><i class="fa-solid fa-circle-info"></i></a>
                  <a href="<?= base_url() ?>siswa/delete/<?= $value['nisn'] ?>" class="btn btn-sm btn-danger konfirmasi mb-1"><i class="fas fa-trash" ></i></a>
                  <a href="<?= base_url() ?>siswa/edit/<?= $value['nisn'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                <?php }else{ ?>
                  <a href="<?= base_url() ?>guru/siswa/detail/<?= $value['nisn'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
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
<script>
  <?php if(session()->has("success")){ ?>
    Swal.fire({
      icon:'success',
      title:'Sukses',
      confirmButtonColor:'#7bb3ff',
      text: '<?= session("success") ?>'
    })
  <?php } ?>
</script>
<?= $this->endSection()?>