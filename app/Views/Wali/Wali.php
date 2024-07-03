<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <?php if (session()->get('role') == '1') { ?>
            <a href="<?= base_url("/wali/create") ?>"><button class="btn btn-primary"><i class="fa-solid fa-user-plus"></i><span class="ml-2">Tambah Data</span></button></a>
          <?php }else{} ?>
          <a href="<?= base_url() ?>wali/all/export" class="btn btn-primary"><i class="fa-solid fa-print" style=""></i><span class="ml-2">Cetak Data</span></a>
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
                  <td><?=$value['jk']?></td>
                  <td><?=$value['nama_siswa']?></td>
                  <td><?=$value['kelas_siswa']?></td>
                  <td><?=$value['rombel_siswa']?></td>
                  <td>
                    <?php if (session()->get('role') == '1') { ?>
                      <a href="<?= base_url() ?>admin/wali/detail/<?= $value['id_wali'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
                      <a href="<?= base_url() ?>wali/edit/<?= $value['id_wali'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                      <a href="<?= base_url() ?>wali/delete/<?= $value['id_wali'] ?>" class="btn btn-sm btn-danger konfirmasi"><i class="fas fa-trash"></i></a>
                    <?php }else{ ?>
                      <a href="<?= base_url() ?>guru/wali/detail/<?= $value['id_wali'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
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