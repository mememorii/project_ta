<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>


<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <?php if (session()->get('role') == '1') { ?>
          <a href="<?= base_url("/siswa/create") ?>"><button class="btn btn-primary"><i class="fa-solid fa-user-plus"></i><span class="ml-2">Tambah Data</span></button></a>
        <?php }else{} ?>
        <a href="<?= base_url() ?>siswa/all/export" class="btn btn-primary"><i class="fa-solid fa-print" style=""></i><span class="ml-2">Cetak Data</span></a>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nomor</th>
              <th>Nama</th>
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
                <td><?=$value['jk'] ?></td>
                <td><?=$value['kelas'] ?></td>
                <td><?=$value['rombel' ?? '-' ] ?></td>
                <td style="text-align: center;vertical-align: middle;">
                    <?php if($value['status'] == 'Aktif'){ ?>
                      <span class="badge badge-success">Aktif</span>
                    <?php }else{ ?>
                      <span class="badge badge-danger">Tidak Aktif</span>
                    <?php } ?>  
                </td>
                <td>
                <?php if (session()->get('role') == '1') {  ?>
                  <a href="<?= base_url() ?>admin/siswa/detail/<?= $value['id_siswa'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
                  <a href="<?= base_url() ?>siswa/delete/<?= $value['id_siswa'] ?>" class="btn btn-sm btn-danger konfirmasi"><i class="fas fa-trash" ></i></a>
                  <a href="<?= base_url() ?>siswa/edit/<?= $value['id_siswa'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                <?php }else{ ?>
                  <a href="<?= base_url() ?>guru/siswa/detail/<?= $value['id_siswa'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
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
      title:'Sukses',
      confirmButtonColor:'#7bb3ff',
      text: '<?= session("success") ?>'
    })
  <?php } ?>
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', (event) => {
      const konfirmasiButtons = document.querySelectorAll('.konfirmasi');

      konfirmasiButtons.forEach(button => {
          button.addEventListener('click', function(event) {
              event.preventDefault(); 

              const href = this.getAttribute('href');

              Swal.fire({
                  title: 'Apakah anda yakin?',
                  text: "Data Tidak Akan Bisa Dikembalikan",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#28a745',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Tidak',
                  confirmButtonText: 'Iya'
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = href; 
                  }
              });
          });
      });
  });
</script>
              <?= $this->endSection()?>