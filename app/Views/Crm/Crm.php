<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
<div class="card">
  <div class="card-header">
    <a href="<?= base_url() ?>crm/all/export" class="btn btn-primary"><i class="fa-solid fa-print" style=""></i><span class="ml-2">Cetak Data</span></a>
  </div>
  <div class="card-body">
    <form method="get" action="" style="margin-bottom:15px">
      <label >Status Tiket</label><br>
      <select id="status" name="status" class="form-control-sm" onchange="this.form.submit()">
        <option value="all" <?= $selectedStatus === 'all' ? 'selected' : '' ?>>Semua</option>  
        <option value="open" <?= $selectedStatus === 'open' ? 'selected' : '' ?>>Open</option>
        <option value="closed" <?= $selectedStatus === 'closed' ? 'selected' : '' ?>>Closed</option>
      </select>
    </form>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nomor</th>
          <th>Created By</th>
          <th>Tanggal</th>
          <th>Judul</th>
          <th>Deskripsi</th>
          <th>Status</th>
          <th>Rating</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1;
          foreach($crmData as $value){
        ?>
         <?php if ($value['kelas_siswa'] == session()->get('kelas')){ ?>
          <tr>
            <td><?=$no++?></td>
            <td><?=$value['nama']?></td>
            <td><?=$value['tanggal']?></td>
            <td><?=$value['judul']?></td>
            <td><?=$value['deskripsi']?></td>
            <td style="text-align: center;vertical-align: middle;">
                <?php if($value['status'] == 'open'){ ?>
                  <span class="badge badge-success">Open</span>
                <?php }else{ ?>
                  <span class="badge badge-danger">Closed</span>
                <?php } ?>
            </td>
            <td><?=$value['rating'] ?? 'Belum Dirating' ?></td>
            <td>
              <?php 
                if ($value['status'] == 'closed'){ ?>
                <a href="<?= base_url() ?>crm/delete/<?= $value['id_crm'] ?>" class="btn btn-sm btn-danger" id="konfirmasi"><i class="fas fa-trash" ></i></a>
                <a href="<?= base_url() ?>crm/detail/<?= $value['id_crm'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
              <?php }else{ ?>
                <a href="<?= base_url() ?>crm/detail/<?= $value['id_crm'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
              <?php } ?>
            </td>
          </tr>
          <?php }else{} ?>
        <?php 
          } 
        ?>
      </tbody>
      <tfoot>
      </tfoot>
    </table>
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