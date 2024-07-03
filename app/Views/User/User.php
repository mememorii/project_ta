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
                  <td>
                    <a href="<?= base_url() ?>user/detail/<?= $value['id'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></i></a>
                    <a href="<?= base_url() ?>user/edit/<?= $value['id'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
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
    $(function () {
      $('#example1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        columnDefs: [
                      { orderable: false, targets: '_all' }, 
                      { orderable: true, targets: 0 }]
      });
    });
  </script>
  <script>
    $(function(){

      <?php if(session()->has("success")){ ?>
      Swal.fire({
        icon:'success',
        title:'Great',
        text: '<?= session("success") ?>'
      })
    <?php } ?>
    });

    $('#konfirmasi').on('click',function(){
        var getLink = $(this).attr('href');
        // alert(getLink)
        Swal.fire({
            title: "Yakin hapus data?",            
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonColor: '#3085d6',
            cancelButtonText: "Batal"
        
        }).then(result => {
            //jika klik ya maka arahkan ke proses.php
            if(result.isConfirmed){
                window.location.href = getLink
            }
        })
        return false;
    });
  </script>
<?= $this->endSection()?>