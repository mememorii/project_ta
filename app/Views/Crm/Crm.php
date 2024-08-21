<?= $this->extend('layouts/master') ?>
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
<div class="card">
  <div class="card-header">
    <ul class="nav nav-pills">
      <li class="nav-item" id="feedkesel"><a class="nav-link" href="#tab1default" data-toggle="tab">Semua feedback</a></li>
      <li class="nav-item" id="feedtang"><a class="nav-link active" href="#tab2default" data-toggle="tab">Feedback yang ditanggapi</a></li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane" id="tab1default">
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
              <th>Dibuat Oleh</th>
              <th>Tanggal</th>
              <th>Judul</th>
              <th>Kelas</th>
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
                <td>
                  <span><?=$value['nama']?></span>
                  <span class="badge bg-primary ml-2">
                    <?php if( $value['role'] == 3) {
                      echo "Siswa";
                    }else{
                      echo "wali";}?>
                  </span>
                </td>
                <td><?= date('Y-m-d', strtotime($value['tanggal'])) ?></td>
                <td><?=$value['judul']?></td>
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
                <td style="text-align: center;vertical-align: middle;">
                    <?php if($value['status'] == 'open'){ ?>
                      <span class="badge badge-success">Open</span>
                    <?php }elseif($value['status'] == 'progress'){ ?>
                      <span class="badge badge-warning">Dalam Progress</span>
                    <?php }else{ ?>
                      <span class="badge badge-danger">Closed</span>
                    <?php } ?>
                </td>
                <td><?= $value['kategori'] ?></td>
                <td>
                  <?php if(empty($value['responden'])){ ?>
                    <span>Belum Ada</span>
                  <?php }else{ ?>
                    <?= $value['responder'] ?>
                  <?php } ?>
                </td>
                <td>
                  <a href="<?= base_url() ?>crm/detail/<?= $value['id_feedback'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
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
      <div class="tab-pane active" id="tab2default">
        <form method="get" action="" style="margin-bottom:15px">
            <div class="row">
              <div class="col-2">
                <div class="form-group">
                  <label >Status</label><br>
                  <select id="status2" name="status2" class="form-control-sm" style="border: 1px solid #ced4da;" onchange="this.form.submit()">
                    <option value="all" <?= $selectedStatus2 === 'all' ? 'selected' : '' ?>>Semua</option>  
                    <option value="progress" <?= $selectedStatus2 === 'progress' ? 'selected' : '' ?>>Dalam Progress</option>
                    <option value="closed" <?= $selectedStatus2 === 'closed' ? 'selected' : '' ?>>Closed</option>
                  </select>
                </div>
              </div>
              <div class="col-1">
                <div class="form-group">
                  <label >Kategori</label><br>
                  <select id="kategori2" name="kategori2" class="form-control-sm" style="border: 1px solid #ced4da;" onchange="this.form.submit()">
                    <option value="Semua" <?= $selectedKategori2 === 'Semua' ? 'selected' : '' ?>>Semua</option>
                    <option value="Sarana Prasarana" <?= $selectedKategori2 === 'Sarana Prasarana' ? 'selected' : '' ?>>Sarana Prasarana</option>
                    <option value="Akademik" <?= $selectedKategori2 === 'Akademik' ? 'selected' : '' ?>>Akademik</option>
                    <option value="Administrasi" <?= $selectedKategori2 === 'Administrasi' ? 'selected' : '' ?>>Administrasi</option>
                    <option value="Tenaga Pendidik" <?= $selectedKategori2 === 'Tenaga Pendidik' ? 'selected' : '' ?>>Tenaga Pendidik</option>
                    <option value="Lainnya" <?= $selectedKategori2 === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                  </select>
                </div>
              </div>
            </div>
        </form>
        <table id="example2" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nomor</th>
              <th>Dibuat Oleh</th>
              <th>Tanggal</th>
              <th>Judul</th>
              <th>Kelas</th>
              <th>Status</th>
              <th>Kategori</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
              foreach($crmData2 as $value){
            ?>
              <tr>
                <td><?=$no++?></td>
                <td>
                  <span><?=$value['nama']?></span>
                  <span class="badge bg-primary ml-2">
                    <?php if( $value['role'] == 3) {
                      echo "Siswa";
                    }else{
                      echo "wali";}?>
                  </span>
                </td>
                <td><?= date('Y-m-d', strtotime($value['tanggal'])) ?></td>
                <td><?=$value['judul']?></td>
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
                    <?php } ?>
                </td>
                <td><?= $value['kategori'] ?></td>
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
</div>
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
                        { element: '#feedtang', popover: { title: 'Feedback yang ditanggapi', 
                            description: 'Ini adalah tombol tab Feedback yang ditanggapi. Anda dapat menekannya untuk melihat semua Feedback yang ditanggapi oleh Anda.' } },
                        { element: '#feedkesel', popover: { title: 'Semua Feedback', 
                          description: 'Ini adalah tombol tab Semua Feedback. Anda dapat menekannya untuk melihat semua Feedback yang disampaikan oleh siswa dan wali siswa.' } },
                        { element: '#status2', popover: { title: 'Status', 
                          description: 'Ini adalah tombol dropdown Status. Anda dapat menekannya untuk mengatur status feedback yang ditampilkan ditabel.' } },
                        { element: '#kategori2', popover: { title: 'Kategori', 
                          description: 'Ini adalah tombol dropdown Kategori. Anda dapat menekannya untuk mengatur kategori feedback yang ditampilkan ditabel.' } },
                        { element: '#example2_length', popover: { title: 'Show Entries', 
                          description: 'Ini adalah tombol Show Entries. Anda dapat menekannya untuk mengatur berapa banyak feedback yang ditampilkan di satu halaman tabel.' } },
                        { element: '#example2_filter', popover: { title: 'Search', 
                          description: 'Ini adalah kolom Search. Anda dapat mengisinya dengan kata yang ingin anda tampilkan.' } },
                        { element: '#example2', popover: { title: 'Tabel Feedback', 
                          description: 'Ini adalah Tabel Feedback. Anda dapat melihat Feedback Feedback yang disampaikan oleh siswa dan wali siswa disini.' } },
                        { element: '#example2_paginate', popover: { title: 'Halaman Tabel', 
                          description: 'Ini adalah tombol Halaman Tabel. Anda dapat menekannya untuk melihat halaman tabel yang lain.' } },
                        <?php if(!empty($value['judul'])) { ?>
                          { element: '#detail', popover: { title: 'Detail Feedback', 
                            description: 'Ini adalah tombol Detail Feedback. Anda dapat menekannya untuk melihat dan merespon feedback yang telah dikirimkan oleh siswa dan wali siswa.' } },
                        <?php } ?>
                    ]
                })

                tour.drive()
    }
});
    </script>
<?= $this->endSection()?>