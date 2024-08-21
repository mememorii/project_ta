<?= $this->extend('layout_user/master') ?>
<?= $this->section('content') ?>
<style>
.overlay-button {
    position: fixed;
    bottom: 20px; /* Distance from the bottom */
    right: 20px;  /* Distance from the right */
    padding: 10px 20px;
    background-color: #7bb3ff; /* Button color */
    color: #fff; /* Text color */
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    z-index: 1000; /* Ensure it stays on top of other elements */
}

.overlay-button:hover {
    background-color: #0056b3; /* Darker shade on hover */
}
</style>
<button class="overlay-button" id="tourButton"><i class="fa-solid fa-circle-question mr-2"></i>Panduan Fitur</button>
<div class="container-fluid" style="padding-left:99px;padding-right:99px">
  <div class="card">
    <div class="card-header">
      <?php if(session()->role == 3){ ?>
      <a href="<?= base_url("siswa/crm/create") ?>" id="open"><button class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i></i><span class="ml-2">Open Tiket</button></a>
    <?php }else{ ?>
      <a href="<?= base_url("wali/crm/create") ?>" id="open"><button class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i><span class="ml-2">Open Tiket</button></a>
    <?php } ?>
    </div>
    <div class="card-body">
    <form method="get" action="" style="margin-bottom:15px">
      <div class="row">
        <div class="col-2">
          <div class="form-group">
            <label >Status</label><br>
            <select id="status" name="status" class="form-control-sm" style="border: 1px solid #ced4da;" onchange="this.form.submit()">
              <option value="all" <?= $selectedStatus === 'all' ? 'selected' : '' ?>>Semua</option>  
              <option value="open" <?= $selectedStatus === 'open' ? 'selected' : '' ?>>Open</option>
              <option value="progress" <?= $selectedStatus === 'progress' ? 'selected' : '' ?>>Dalam Progress</option>
              <option value="closed" <?= $selectedStatus === 'closed' ? 'selected' : '' ?>>Closed</option>
            </select>
          </div>
        </div>
        <div class="col-1">
          <div class="form-group">
            <label >Kategori</label><br>
            <select id="kategori" name="kategori" class="form-control-sm" style="border: 1px solid #ced4da;" onchange="this.form.submit()">
              <option value="Semua" <?= $selectedKategori === 'Semua' ? 'selected' : '' ?>>Semua</option>
              <option value="Sarana Prasarana" <?= $selectedKategori === 'Sarana Prasarana' ? 'selected' : '' ?>>Sarana Prasarana</option>
              <option value="Akademik" <?= $selectedKategori === 'Akademik' ? 'selected' : '' ?>>Akademik</option>
              <option value="Administrasi" <?= $selectedKategori === 'Administrasi' ? 'selected' : '' ?>>Administrasi</option>
              <option value="Tenaga Pendidik" <?= $selectedKategori === 'Tenaga Pendidik' ? 'selected' : '' ?>>Tenaga Pendidik</option>
              <option value="Lainnya" <?= $selectedKategori === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
            </select>
          </div>
        </div>
      </div>
    </form>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nomor</th>
            <th>Tanggal</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Kategori</th>
            <th>Responden</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
            foreach($crmData as $value){
          ?>
            <tr>
              <td><?=$no++?></td>
              <td><?= date('Y-m-d', strtotime($value['tanggal'])) ?></td>
              <td><?=$value['judul']?></td>
              <td style="text-align: center;vertical-align: middle;">
                <?php if($value['status'] == 'open'){ ?>
                  <span class="badge badge-success">Open</span>
                <?php }elseif($value['status'] == 'progress'){ ?>
                  <span class="badge badge-warning">Dalam Progress</span>
                  <div>
                    <?php if(!empty($value['unread_count'])){ ?>
                      <span class="badge badge-danger">
                        <?= $value['unread_count'] ?>  Komentar Baru
                      </span>
                    <?php } ?>
                  </div>
                <?php }else{ ?>
                  <span class="badge badge-danger">Closed</span>
                  <div>
                    <?php if(empty($value['rating'])) { ?>
                      <span class="badge badge-warning">Belum Dinilai</span>
                    <?php } ?>
                  </div>
                <?php } ?>
              </td>
              <td><?=$value['kategori']?></td>
              <td>
                <?php if(empty($value['responden'])){ ?>
                  <span>-</span>
                <?php }else{ ?>
                  <?= $value['responder'] ?>
                <?php } ?>
              </td>
              <td>
                <a href="<?= base_url() ?>crm/detail/<?= $value['id_feedback'] ?>" id="detail" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
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
<?php if(session()->getFlashdata('success')) { ?>
<script>
 Swal.fire({
            icon: 'success',
            title: 'Sukses',
            confirmButtonColor:'#7bb3ff',
            text: '<?= session()->getFlashdata('success') ?>',
        })
</script>
<?php } ?>
<script>
// script.js
document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('tourButton');
    
    button.addEventListener('click', function() {
        startTour();
    });

    function startTour() {
        const driver = window.driver.js.driver;

                const driverObj = driver();

                const tour = driver({
                    showProgress: true,
                    steps: [
                        { element: '#open', popover: { title: 'Open Tiket', 
                          description: 'Ini adalah tombol Open Tiket. Anda dapat menekannya untuk membuat tiket feedback.' } },
                        { element: '#status', popover: { title: 'Status', 
                          description: 'Ini adalah tombol dropdown Status. Anda dapat menekannya untuk mengatur status feedback yang ditampilkan ditabel.' } },
                        { element: '#kategori', popover: { title: 'Kategori', 
                          description: 'Ini adalah tombol dropdown Kategori. Anda dapat menekannya untuk mengatur kategori feedback yang ditampilkan ditabel.' } },
                        { element: '#example1_length', popover: { title: 'Show Entries', 
                          description: 'Ini adalah tombol Show Entries. Anda dapat menekannya untuk mengatur berapa banyak feedback yang ditampilkan di satu halaman tabel.' } },
                        { element: '#example1_filter', popover: { title: 'Search', 
                          description: 'Ini adalah kolom Search. Anda dapat mengisinya dengan kata yang ingin anda tampilkan.' } },
                        { element: '#example1', popover: { title: 'Tabel Feedback', 
                          description: 'Ini adalah Tabel Feedback. Anda dapat melihat Feedback Feedback yang disampaikan oleh anda.' } },
                        { element: '#example1_paginate', popover: { title: 'Halaman Tabel', 
                          description: 'Ini adalah tombol Halaman Tabel. Anda dapat menekannya untuk melihat halaman tabel yang lain.' } },
                        <?php if(!empty($value['judul'])) { ?>
                        { element: '#detail', popover: { title: 'Detail Feedback', 
                          description: 'Ini adalah tombol Detail Feedback. Anda dapat menekannya untuk melihat dan merespon tanggapan feedback yang dikirimkan oleh guru.' } },
                        <?php } ?>
                       
                    ]
                })

                tour.drive()
    }
});
    </script>
<?= $this->endSection()?>