<?= $this->extend('layout_user/master') ?>
<?= $this->section('content') ?>
<div class="container-fluid" style="padding-left:99px;padding-right:99px">
  <div class="card">
    <div class="card-header">
      <?php if(session()->role == 3){ ?>
      <a href="<?= base_url("siswa/crm/create") ?>"><button class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i></i><span class="ml-2">Open Tiket</button></a>
    <?php }else{ ?>
      <a href="<?= base_url("wali/crm/create") ?>"><button class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i><span class="ml-2">Open Tiket</button></a>
    <?php } ?>
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
          <?php if ($value['id_referensi'] == session()->get('id_referensi')){ ?>
            <tr>
              <td><?=$no++?></td>
              <td><?=$value['tanggal']?></td>
              <td><?=$value['judul']?></td>
              <td><?=$value['deskripsi']?></td>
              <td style=" text-align: center;vertical-align: middle;">
                  <?php if($value['status'] == 'open'){?>
                    <span class="badge badge-success" style="text-align: center;">Open</span>
                  <?php }else{ ?>
                    <span class="badge badge-danger" style="text-align: center;">Closed</span>
                  <?php } ?>
              <td><?=$value['rating'] ?? 'Belum Dirating' ?></td>
              </td>
              <td>
                <a href="<?= base_url() ?>crm/detail/<?= $value['id_crm'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
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
</div>
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
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
</script>
<?= $this->endSection()?>