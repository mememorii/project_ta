<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nomor</th>
                <th>Role</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
                foreach($getData as $row =>$value){
              ?>
                <tr>
                  <td><?=$no++?></td>
                  <td><?php 
                  if ($value['role'] == 1){
                    echo"Admin";
                  }elseif($value['role'] == 2){
                      echo"Guru";
                  }elseif($value['role'] == 3){
                      echo"Siswa";
                  }else{
                      echo"Wali Siswa";
                  }?></td>
                  <td><?=$value['nama']?></td>
                  <td><?=$value['nik']?></td>
                  <td><?=$value['email']?></td>
                  <td>
                    <a href="<?= base_url() ?>user/detail/<?= $value['id_users'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></i></a>
                    <a href="<?= base_url() ?>user/edit/<?= $value['id_users'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
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
<?= $this->endSection()?>