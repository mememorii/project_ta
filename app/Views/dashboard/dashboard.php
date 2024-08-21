<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
<style>
  .collapse.show-visibility {
    visibility: visible !important;
}
 .grid-item {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .custom-center {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}
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
  <div class="row">
    <div class="col-lg-3 col-6">
      <?php if(session()->get('role') == 2){ ?>
        <div class="small-box bg-success" id="openBox">
          <div class="inner">
            <h3><?= $tiketKelasOpen ?></h3>
            <p>Total Tiket Open</p>
          </div>
          <div class="icon">
            <i class="nav-icon fa-solid fa-file-invoice"></i>
          </div>
            <a href="<?= base_url() ?>crm" class="small-box-footer">Data Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
        </div>
      <?php }else{ ?>
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $hitungSiswa ?></h3>
            <p>Total Siswa</p>
          </div>
          <div class="icon">
            <i class="fa-solid fa-user"></i>
          </div>
            <a href="<?= base_url() ?>admin/siswa" class="small-box-footer">Data Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
        </div>
      <?php } ?>
    </div>
    <div class="col-lg-3 col-6">
      <?php if(session()->get('role') == 2){ ?>
        <div class="small-box bg-warning" id="progressBox">
          <div class="inner">
            <h3><?= $progress ?></h3>
            <p>Total Tiket Dalam Progress</p>
          </div>
          <div class="icon">
            <i class="nav-icon fa-solid fa-file-invoice"></i>
          </div>
            <a href="<?= base_url()?>crm" class="small-box-footer">Data Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
        </div>
      <?php }else{ ?>
        <div class="small-box bg-primary" id="">
          <div class="inner">
            <h3><?= $totalWali ?></h3>
            <p>Total Wali Siswa</p>
          </div>
          <div class="icon">
            <i class="nav-icon fa-solid fa-person-breastfeeding"></i>
          </div>
          <a href="<?= base_url()?>admin/wali" class="small-box-footer">Data Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
        </div>
      <?php } ?>
    </div>
    <div class="col-lg-3 col-6">
      <?php if(session()->get('role') == 2){ ?>
        <div class="small-box bg-danger" id="closedBox">
          <div class="inner">
            <h3><?= $tiketKelasClosed ?></h3>
            <p>Total Tiket Closed</p>
          </div>
          <div class="icon">
            <i class="nav-icon fa-solid fa-file-invoice"></i>
          </div>
            <a href="<?= base_url()?>crm" class="small-box-footer">Data Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
        </div>
      <?php }else{ ?>
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?= $totalGuru ?></h3>
            <p>Total Guru</p>
          </div>
          <div class="icon">
            <i class="nav-icon fa-solid fa-chalkboard-user"></i>
          </div>
          <a href="<?= base_url() ?>admin/guru" class="small-box-footer">Data Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
        </div>
      <?php } ?>
    </div>
    <div class="col-lg-3 col-6">
      <?php if(session()->get('role') == 2){ ?>
        <div class="small-box bg-info" id="todayBox">
          <div class="inner">
            <h3><?= $ticketsToday ?></h3>
            <p>Total Tiket Hari Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="<?= base_url()?>crm" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      <?php }else{ ?>
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?= $totalUser ?></h3>
            <p>Total User Account</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
            <a href="<?= base_url()?>user" class="small-box-footer">Data Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
        </div>
      <?php } ?>
    </div>
  </div>
  <div class="row phone">
    <?php if(session()->get('role') == 1){ ?>
      <div class="col-6">
      <div class="card">
        <div class="card-header">
          <p style="color:white">Jumlah User Account</p>
        </div>
        <div class="card-body">
          <div class="container">
            <canvas id="createdAtChart"  width="400" height="400"></canvas>
          </div>
        </div>
      </div>
    </div>
    <?php }else{ ?>
      <div class="col-6">
        <div class="card" id="grafikTotal">
          <div class="card-header">
            <p style="color:white">Jumlah Tiket Feedback</p>
          </div>
          <div class="card-body">
            <div class="container">
              <canvas id="statusChart" width="400" height="400"></canvas>
            </div>
          </div>
        </div>
    </div>
    <?php } ?>
    
    <?php if(session()->get('role') == 1){ ?>
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <p style="color:white">Jumlah Siswa per Kelas</p>
          </div>
          <div class="card-body">
            <div class="container">
              <canvas id="kelasChart" width="400" height="400"></canvas>
            </div>
          </div>
        </div>
      </div>
    <?php }else{ ?>
      <div class="col-6">
        <div class="card" id="ratingFeed">
          <div class="card-header">
            <p style="color:white">Rating Pelayanan Tanggapan Feedback</p>
          </div>
          <div class="card-body">
            <div class="container">
              <canvas id="ratingChart" width="400" height="400"></canvas>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
    <?php if(session()->get('role') == 'guru') { ?>
        <div class="row" id="kategoriBox">
            <?php 
            $index = 0;
            foreach ($kategoriStatusCounts as $category => $statuses): 
                $index++;
            ?>
                <div class="col-3 <?php if ($index == 5) echo 'offset-4'; ?>">
                    <?php if($category == 'Sarana Prasarana'){ ?>
                        <div class="small-box" style="background-color:#003049;color:white">
                    <?php }elseif($category == 'Akademik'){ ?>
                        <div class="small-box" style="background-color:#219EBC;color:white">
                    <?php }elseif($category == 'Administrasi'){ ?>
                        <div class="small-box" style="background-color:#F77F00;color:white">
                    <?php }elseif($category == 'Tenaga Pendidik'){ ?>
                        <div class="small-box" style="background-color:#FCBF49;color:white">
                    <?php }else{ ?>
                        <div class="small-box" style="background-color:#06d6a0;color:white">
                    <?php } ?>
                        <div class="inner">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="custom-center"><?= $statuses['open'] ?></h3>
                                    <span>Open</span>
                                </div>
                                <div>
                                    <h3 class="custom-center"><?= $statuses['progress'] ?></h3>
                                    <span>Dalam Progress</span>
                                </div>
                                <div>
                                    <h3 class="custom-center"><?= $statuses['closed'] ?></h3>
                                    <span>Closed</span>
                                </div>
                            </div>
                            <h3 style="font-size:20px" class="mt-3 custom-center"><?= $category ?></h3>
                        </div>
                        <a href="<?= base_url('crm') ?>" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="card" id="kategoriCard">
            <div class="card-header">
            <span style="color:white">Jumlah Tiket Feedback per Katergori</span>
            </div>
            <div class="card-body">
            <div class="container">
                <canvas id="kategoriChart" width="400" height="200"></canvas>
            </div>
            </div>
        </div>
    <?php } ?>
  <script>
    // Data
    var openCount = <?php echo $openCount; ?>;
    var closedCount = <?php echo $closedCount; ?>;
    var progressCount = <?php echo $progressCount; ?>;

    // Chart
    var ctx = document.getElementById('statusChart').getContext('2d');
    var statusChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Open', 'Dalam Progress', 'Closed'],
            datasets: [{
                label: 'Tiket',
                data: [openCount, progressCount, closedCount],
                backgroundColor: [
                    'rgba(0,128,0)',
                    'rgba(255,221,0)',
                    'rgba(255, 0, 0)'
                ],
                borderColor: [
                    'rgba(0,128,0)',
                    'rgba(255,221,0)',
                    'rgba(255, 0, 0)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            plugins: {
                legend: {
                  position: 'bottom',
                  display: false
                }
            }
        }
    });
    </script>
<script>
    var kelas1 = <?php echo $kelas1; ?>;
    var kelas2 = <?php echo $kelas2; ?>;
    var kelas3 = <?php echo $kelas3; ?>;
    var kelas4 = <?php echo $kelas4; ?>;
    var kelas5 = <?php echo $kelas5; ?>;
    var kelas6 = <?php echo $kelas6; ?>;

    var ctx = document.getElementById('kelasChart').getContext('2d');
    var kelasChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['kelas 1', 'kelas 2','kelas 3','kelas 4','kelas 5','kelas 6'],
            datasets: [{
                label: 'Anak',
                data: [kelas1, kelas2, kelas3, kelas4, kelas5, kelas6],
                backgroundColor: [
                    'rgba(202,240,248)',
                    'rgba(144,224,239)',
                    'rgba(0,180,216)',
                    'rgba(0,119,182)',
                    'rgba(58,134,255)',
                    'rgba(3,4,94)'
                ],
                borderColor: [
                    'rgba(202,240,248)',
                    'rgba(144,224,239)',
                    'rgba(0,180,216)',
                    'rgba(0,119,182)',
                    'rgba(58,134,255)',
                    'rgba(3,4,94)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            plugins: {
                legend: {
                  position: 'bottom',
                  display: false
                }
            }
        }
    });
</script>
<script>
  var ratings = <?php echo json_encode($ratings); ?>;
  var ctx = document.getElementById('ratingChart').getContext('2d');
  var ratingChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Sangat Jelek', 'Jelek', 'Biasa', 'Bagus', 'Sangat Bagus'],
        datasets: [{
            label: 'Tiket',
            data: [
                ratings[1] || 0,
                ratings[2] || 0,
                ratings[3] || 0,
                ratings[4] || 0,
                ratings[5] || 0
            ],
            backgroundColor: [
                'rgba(255,140,90)',
                'rgba(255,178,52)',
                'rgba(255,217,52)',
                'rgba(173,214,51)',
                'rgba(160,193,90)'
            ],
            borderColor: [
                'rgba(255,140,90)',
                'rgba(255,178,52',
                'rgba(255,217,52)',
                'rgba(173,214,51)',
                'rgba(160,193,90)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
  });
</script>
  <script>
    var saranaPrasarana = <?php echo $saranaPrasarana; ?>;
    var akademik = <?php echo $akademik; ?>;
    var administrasi = <?php echo $administrasi; ?>;
    var tenagaPendidik = <?php echo $tenagaPendidik; ?>;
    var lainnya = <?php echo $lainnya; ?>;

    var ctx = document.getElementById('kategoriChart').getContext('2d');
    var kategoriChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
              'Sarana Prasarana', 'Akademik', 'Administrasi', 'Tenaga Pendidik', 'Lainnya',
            ],
            datasets: [{
                label: 'Tiket',
                data: [
                  saranaPrasarana, akademik, administrasi, tenagaPendidik, lainnya,
                ],
                backgroundColor: [
                  'rgba(0, 48, 73)',
                  'rgba(33, 158, 188)',
                  'rgba(247, 127, 0)',
                  'rgba(252, 191, 73)',
                  'rgba(6, 214, 160)',
                ],
                borderColor: [
                  'rgba(0, 48, 73)',
                  'rgba(33, 158, 188)',
                  'rgba(247, 127, 0)',
                  'rgba(252, 191, 73)',
                  'rgba(6, 214, 160)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            plugins: {
                legend: {
                  position: 'bottom',
                  display: false
                }
            }
        }
    });
  </script>
  <script>
    var dates = <?php echo json_encode($dates); ?>;

    var dateCounts = {};
    dates.forEach(function(date) {
        var formattedDate = date.split(' ')[0]; // Extract the date part only
        if (dateCounts[formattedDate]) {
            dateCounts[formattedDate]++;
        } else {
            dateCounts[formattedDate] = 1;
        }
    });

    var labels = Object.keys(dateCounts);
    var data = Object.values(dateCounts);

    var ctx = document.getElementById('createdAtChart').getContext('2d');
    var createdAtChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Users Account Yang Dibuat',
                data: data,
                backgroundColor: 'rgba(123,179,255)',
                borderColor: 'rgba(123,179,255)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
  </script>
    <?php if($showForgotPopup == 'true' && session()->getFlashdata('error')){ ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    confirmButtonColor:'#7bb3ff',
                    text: '<?= session()->getFlashdata('error') ?>',
                    didClose: () => {
                        Swal.fire({
                            title: 'Amankan Akun',
                            html: `
                                <h1 class="mb-3">Untuk keamanan akun anda sebelum menggunakan sistem amankan akun anda dengan mengikuti langkah dibawah ini</h1>
                                <div class="accordion" id="accordionExample">
                                    <form action="<?= base_url() ?>security" id="form" method="post">
                                        <div class="card">
                                            <div class="grid-item" id="headingOne">
                                                <h5 class="mb-0">
                                                    <div class="d-flex justify-content-between">
                                                        <h3>Ganti Password</h3>
                                                        <button class="btn btn-primary collapsed toggle-visibility" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                            <i class="fa-solid fa-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <?php $validation = \Config\Services::validation(); ?>
                                                    <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama', session()->get('nama')) ?>" hidden>
                                                    <input type="number" class="form-control" name="nik" id="nik" value="<?= set_value('nik', session()->get('nik')) ?>" hidden>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" name="password" id="password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password_confirm">Konfirmasi Password</label>
                                                        <input type="password" class="form-control" name="password_confirm" id="password_confirm" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="grid-item" id="headingTwo">
                                                <h5 class="mb-0">
                                                    <div class="d-flex justify-content-between">
                                                        <h3>Buat Security Question</h3>
                                                        <button class="btn btn-primary collapsed toggle-visibility" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            <i class="fa-solid fa-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <input type="hidden" class="form-control" name="id_users" id="id_users" value="<?= session()->get('id') ?>">
                                                    <div class="form-group">
                                                        <label>Pertanyaan 1</label>
                                                        <select class="form-control" name="pertanyaan_1" id="pertanyaan_1" onchange="toggleInputField1()" required>
                                                            <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                                            <option value="Apa nama sekolah tempat Anda mengajar pertama kali?">Apa nama sekolah tempat Anda mengajar pertama kali?</option>
                                                            <option value="Di kota mana Anda lahir?">Di kota mana Anda lahir?</option>
                                                            <option value="Apa nama jalan tempat Anda tinggal saat masa kecil?">Apa nama jalan tempat Anda tinggal saat masa kecil?</option>           
                                                            <option value="Apa nama makanan favorit Anda?">Apa nama makanan favorit Anda?</option>
                                                            <option value="lainnya_1">Lainnya</option>
                                                        </select>
                                                        <div id="containerLain1" style="display:none; margin-top:10px;">
                                                            <input type="text" class="form-control" name="pertanyaanLain1" id="pertanyaanLain1" placeholder="Masukkan pertanyaan lainnya">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jawaban 1</label>
                                                        <input type="text" class="form-control" name="jawaban_1" id="jawaban_1" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pertanyaan 2</label>
                                                        <select class="form-control" name="pertanyaan_2" id="pertanyaan_2" onchange="toggleInputField2()" required>
                                                            <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                                            <option value="Apa nama sekolah tempat Anda mengajar pertama kali?">Apa nama sekolah tempat Anda mengajar pertama kali?</option>
                                                            <option value="Di kota mana Anda lahir?">Di kota mana Anda lahir?</option>
                                                            <option value="Apa nama jalan tempat Anda tinggal saat masa kecil?">Apa nama jalan tempat Anda tinggal saat masa kecil?</option>           
                                                            <option value="Apa nama makanan favorit Anda?">Apa nama makanan favorit Anda?</option>          
                                                            <option value="lainnya_2">Lainnya</option>
                                                        </select>
                                                        <div id="containerLain2" style="display:none; margin-top:10px;">
                                                            <input type="text" class="form-control" name="pertanyaanLain2" id="pertanyaanLain2" placeholder="Masukkan pertanyaan lainnya">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jawaban 2</label>
                                                        <input type="text" class="form-control" name="jawaban_2" id="jawaban_2" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pertanyaan 3</label>
                                                        <select class="form-control" name="pertanyaan_3" id="pertanyaan_3" onchange="toggleInputField3()" required>
                                                            <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                                            <option value="Apa nama sekolah tempat Anda mengajar pertama kali?">Apa nama sekolah tempat Anda mengajar pertama kali?</option>
                                                            <option value="Di kota mana Anda lahir?">Di kota mana Anda lahir?</option>
                                                            <option value="Apa nama jalan tempat Anda tinggal saat masa kecil?">Apa nama jalan tempat Anda tinggal saat masa kecil?</option>           
                                                            <option value="Apa nama makanan favorit Anda?">Apa nama makanan favorit Anda?</option>           
                                                            <option value="lainnya_3">Lainnya</option>
                                                        </select>    
                                                        <div id="containerLain3" style="display:none; margin-top:10px;">
                                                            <input type="text" class="form-control" name="pertanyaanLain3" id="pertanyaanLain3" placeholder="Masukkan pertanyaan lainnya">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password_confirm">Jawaban 3</label>
                                                        <input type="text" class="form-control" name="jawaban_3" id="jawaban_3" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pertanyaan 4 (Opsional)</label>
                                                        <select class="form-control" name="pertanyaan_4" id="pertanyaan_4" onchange="toggleInputField4()">
                                                            <option value="" selected hidden>Pilih Pertanyaan</option>
                                                            <option value="Apa nama sekolah tempat Anda mengajar pertama kali?">Apa nama sekolah tempat Anda mengajar pertama kali?</option>
                                                            <option value="Di kota mana Anda lahir?">Di kota mana Anda lahir?</option>
                                                            <option value="Apa nama jalan tempat Anda tinggal saat masa kecil?">Apa nama jalan tempat Anda tinggal saat masa kecil?</option>           
                                                            <option value="Apa nama makanan favorit Anda?">Apa nama makanan favorit Anda?</option>           
                                                            <option value="lainnya_4">Lainnya</option>
                                                        </select>
                                                        <div id="containerLain4" style="display:none; margin-top:10px;">
                                                            <input type="text" class="form-control" name="pertanyaanLain4" id="pertanyaanLain4" placeholder="Masukkan pertanyaan lainnya">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password_confirm">Jawaban 4</label>
                                                        <input type="text" class="form-control" name="jawaban_4" id="jawaban_4">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pertanyaan 5 (Opsional)</label>
                                                        <select class="form-control" name="pertanyaan_5" id="pertanyaan_5" onchange="toggleInputField5()">
                                                            <option value="" selected hidden>Pilih Pertanyaan</option>
                                                            <option value="Apa nama sekolah tempat Anda mengajar pertama kali?">Apa nama sekolah tempat Anda mengajar pertama kali?</option>
                                                            <option value="Di kota mana Anda lahir?">Di kota mana Anda lahir?</option>
                                                            <option value="Apa nama jalan tempat Anda tinggal saat masa kecil?">Apa nama jalan tempat Anda tinggal saat masa kecil?</option>           
                                                            <option value="Apa nama makanan favorit Anda?">Apa nama makanan favorit Anda?</option>
                                                            <option value="lainnya_5">Lainnya</option>
                                                        </select>
                                                        <div id="containerLain5" style="display:none; margin-top:10px;">
                                                            <input type="text" class="form-control" name="pertanyaanLain5" id="pertanyaanLain5" placeholder="Masukkan pertanyaan lainnya">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password_confirm">Jawaban 5</label>
                                                        <input type="text" class="form-control" name="jawaban_5" id="jawaban_5">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="grid-item" id="headingThree">
                                                <h5 class="mb-0">
                                                    <div class="d-flex justify-content-between">
                                                        <h3>
                                                            Masukkan Alamat Email (Opsional)
                                                        </h3>
                                                        <button class="btn btn-primary collapsed toggle-visibility" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                            <i class="fa-solid fa-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control" id="email" name="email">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            `,
                            focusConfirm: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            preConfirm: () => {
                                const password = document.getElementById('password').value;
                                const password_confirm = document.getElementById('password_confirm').value;
                                var pertanyaan1 = document.getElementById('pertanyaan_1').value;
                                var pertanyaan2 = document.getElementById('pertanyaan_2').value;
                                var pertanyaan3 = document.getElementById('pertanyaan_3').value;
                                var jawaban1 = document.getElementById('jawaban_1').value;
                                var jawaban2 = document.getElementById('jawaban_2').value;
                                var jawaban3 = document.getElementById('jawaban_3').value;
                                var email = document.getElementById('email').value;
                                var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                                
                                if (!password || !password_confirm) {
                                    Swal.showValidationMessage('Password dan konfirmasi password harus diisi.');
                                    return false;
                                }

                                if (password.length < 6) {
                                    Swal.showValidationMessage('Password harus memiliki minimal 6 karakter.');
                                    return false;
                                }

                                if(password !== password_confirm){
                                    Swal.showValidationMessage('Password dan konfirmasi password tidak sama.');
                                    return false;
                                }

                                if(!pertanyaan1 || !jawaban1){
                                    Swal.showValidationMessage('Pertanyaan 1 dan jawaban 1 harus diisi.');
                                    return false;
                                }

                                if(!pertanyaan2 || !jawaban2){
                                    Swal.showValidationMessage('Pertanyaan 2 dan jawaban 2 harus diisi.');
                                    return false;
                                }

                                if(!pertanyaan3 || !jawaban3){
                                    Swal.showValidationMessage('Pertanyaan 3 dan jawaban 3 harus diisi.');
                                    return false;
                                }

                            
                                if(email){

                                    if (!emailPattern.test(email)) {
                                    Swal.showValidationMessage('Email yang anda masukkan salah.');
                                    return false;
                                    }
                                }

                            

                                document.getElementById('form').submit();
                                
                            }
                        })
                    }
                });
                const toggleButtons = document.querySelectorAll('.toggle-visibility');

                toggleButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const targetSelector = button.getAttribute('data-target');
                        const targetElement = document.querySelector(targetSelector);
                        
                        if (targetElement) {
                            targetElement.classList.toggle('show-visibility');
                        }
                    });
                });
            });
        </script>
        <script>
            function toggleInputField1() {
                var selectElement1 = document.getElementById('pertanyaan_1');
                var containerLain1 = document.getElementById('containerLain1');
                var inputField = document.getElementById('pertanyaanLain1');
                if (selectElement1.value === 'lainnya_1') {
                    containerLain1.style.display = 'block';
                    inputField.value = '';
                    inputField.setAttribute('required', 'true');
                } else {
                    containerLain1.style.display = 'none';
                    inputField.value = selectElement1.value;
                
                }
        
            }

            function toggleInputField2() {
                var selectElement2 = document.getElementById('pertanyaan_2');
                var containerLain2 = document.getElementById('containerLain2');
                var inputField = document.getElementById('pertanyaanLain2');
                if (selectElement2.value === 'lainnya_2') {
                    containerLain2.style.display = 'block';
                    inputField.value = '';
                    inputField.setAttribute('required', 'true');
                } else {
                    containerLain2.style.display = 'none';
                    inputField.value = selectElement2.value;
                }
            }

            function toggleInputField3() {
                var selectElement3 = document.getElementById('pertanyaan_3');
                var containerLain3 = document.getElementById('containerLain3');
                var inputField = document.getElementById('pertanyaanLain3');
                if (selectElement3.value === 'lainnya_3') {
                    containerLain3.style.display = 'block';
                    inputField.value = '';
                    inputField.setAttribute('required', 'true');
                } else {
                    containerLain3.style.display = 'none';
                    inputField.value = selectElement3.value;
                }
            }

            function toggleInputField4() {
                var selectElement4 = document.getElementById('pertanyaan_4');
                var containerLain4 = document.getElementById('containerLain4');
                var inputField = document.getElementById('pertanyaanLain4');

                if (selectElement4.value === 'lainnya_4') {
                    containerLain4.style.display = 'block';
                    inputField.value = '';
                    inputField.setAttribute('required', 'true');
                } else {
                    containerLain4.style.display = 'none';
                    inputField.value = selectElement4.value;
                }
            }

            function toggleInputField5() {
                var selectElement5 = document.getElementById('pertanyaan_5');
                var containerLain5 = document.getElementById('containerLain5');
                var inputField = document.getElementById('pertanyaanLain5');
                if (selectElement5.value === 'lainnya_5') {
                    containerLain5.style.display = 'block';
                    inputField.value = '';
                    inputField.setAttribute('required', 'true');
                } else {
                    containerLain5.style.display = 'none';
                    inputField.value = selectElement5.value;
                }
            }
        </script>
    <?php }elseif($showForgotPopup == 'true'){ ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
        
            Swal.fire({
                title: 'Amankan Akun',
                html: `
                    <h1 class="mb-3">Untuk keamanan akun anda sebelum menggunakan sistem amankan akun anda dengan mengikuti langkah dibawah ini</h1>
                    <div class="accordion" id="accordionExample">
                        <form action="<?= base_url() ?>security" id="form" method="post">
                            <div class="card">
                                <div class="grid-item" id="headingOne">
                                    <h5 class="mb-0">
                                        <div class="d-flex justify-content-between">
                                            <h3>Ganti Password</h3>
                                            <button class="btn btn-primary collapsed toggle-visibility" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <?php $validation = \Config\Services::validation(); ?>
                                        <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama', session()->get('nama')) ?>" hidden>
                                        <input type="number" class="form-control" name="nik" id="nik" value="<?= set_value('nik', session()->get('nik')) ?>" hidden>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirm">Konfirmasi Password</label>
                                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="grid-item" id="headingTwo">
                                    <h5 class="mb-0">
                                        <div class="d-flex justify-content-between">
                                            <h3>Buat Security Question</h3>
                                            <button class="btn btn-primary collapsed toggle-visibility" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <input type="hidden" class="form-control" name="id_users" id="id_users" value="<?= session()->get('id') ?>">
                                        <div class="form-group">
                                            <label>Pertanyaan 1</label>
                                            <select class="form-control" name="pertanyaan_1" id="pertanyaan_1" onchange="toggleInputField1()" required>
                                                <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                                <option value="Apa nama sekolah tempat Anda mengajar pertama kali?">Apa nama sekolah tempat Anda mengajar pertama kali?</option>
                                                <option value="Di kota mana Anda lahir?">Di kota mana Anda lahir?</option>
                                                <option value="Apa nama jalan tempat Anda tinggal saat masa kecil?">Apa nama jalan tempat Anda tinggal saat masa kecil?</option>           
                                                <option value="Apa nama makanan favorit Anda?">Apa nama makanan favorit Anda?</option>
                                                <option value="lainnya_1">Lainnya</option>
                                            </select>
                                            <div id="containerLain1" style="display:none; margin-top:10px;">
                                                <input type="text" class="form-control" name="pertanyaanLain1" id="pertanyaanLain1" placeholder="Masukkan pertanyaan lainnya">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Jawaban 1</label>
                                            <input type="text" class="form-control" name="jawaban_1" id="jawaban_1" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Pertanyaan 2</label>
                                            <select class="form-control" name="pertanyaan_2" id="pertanyaan_2" onchange="toggleInputField2()" required>
                                                <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                                <option value="Apa nama sekolah tempat Anda mengajar pertama kali?">Apa nama sekolah tempat Anda mengajar pertama kali?</option>
                                                <option value="Di kota mana Anda lahir?">Di kota mana Anda lahir?</option>
                                                <option value="Apa nama jalan tempat Anda tinggal saat masa kecil?">Apa nama jalan tempat Anda tinggal saat masa kecil?</option>           
                                                <option value="Apa nama makanan favorit Anda?">Apa nama makanan favorit Anda?</option>          
                                                <option value="lainnya_2">Lainnya</option>
                                            </select>
                                            <div id="containerLain2" style="display:none; margin-top:10px;">
                                                <input type="text" class="form-control" name="pertanyaanLain2" id="pertanyaanLain2" placeholder="Masukkan pertanyaan lainnya">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Jawaban 2</label>
                                            <input type="text" class="form-control" name="jawaban_2" id="jawaban_2" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Pertanyaan 3</label>
                                            <select class="form-control" name="pertanyaan_3" id="pertanyaan_3" onchange="toggleInputField3()" required>
                                                <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                                <option value="Apa nama sekolah tempat Anda mengajar pertama kali?">Apa nama sekolah tempat Anda mengajar pertama kali?</option>
                                                <option value="Di kota mana Anda lahir?">Di kota mana Anda lahir?</option>
                                                <option value="Apa nama jalan tempat Anda tinggal saat masa kecil?">Apa nama jalan tempat Anda tinggal saat masa kecil?</option>           
                                                <option value="Apa nama makanan favorit Anda?">Apa nama makanan favorit Anda?</option>           
                                                <option value="lainnya_3">Lainnya</option>
                                            </select>    
                                            <div id="containerLain3" style="display:none; margin-top:10px;">
                                                <input type="text" class="form-control" name="pertanyaanLain3" id="pertanyaanLain3" placeholder="Masukkan pertanyaan lainnya">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirm">Jawaban 3</label>
                                            <input type="text" class="form-control" name="jawaban_3" id="jawaban_3" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Pertanyaan 4 (Opsional)</label>
                                            <select class="form-control" name="pertanyaan_4" id="pertanyaan_4" onchange="toggleInputField4()">
                                                <option value="" selected hidden>Pilih Pertanyaan</option>
                                                <option value="Apa nama sekolah tempat Anda mengajar pertama kali?">Apa nama sekolah tempat Anda mengajar pertama kali?</option>
                                                <option value="Di kota mana Anda lahir?">Di kota mana Anda lahir?</option>
                                                <option value="Apa nama jalan tempat Anda tinggal saat masa kecil?">Apa nama jalan tempat Anda tinggal saat masa kecil?</option>           
                                                <option value="Apa nama makanan favorit Anda?">Apa nama makanan favorit Anda?</option>           
                                                <option value="lainnya_4">Lainnya</option>
                                            </select>
                                            <div id="containerLain4" style="display:none; margin-top:10px;">
                                                <input type="text" class="form-control" name="pertanyaanLain4" id="pertanyaanLain4" placeholder="Masukkan pertanyaan lainnya">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirm">Jawaban 4</label>
                                            <input type="text" class="form-control" name="jawaban_4" id="jawaban_4">
                                        </div>
                                        <div class="form-group">
                                            <label>Pertanyaan 5 (Opsional)</label>
                                            <select class="form-control" name="pertanyaan_5" id="pertanyaan_5" onchange="toggleInputField5()">
                                                <option value="" selected hidden>Pilih Pertanyaan</option>
                                                <option value="Apa nama sekolah tempat Anda mengajar pertama kali?">Apa nama sekolah tempat Anda mengajar pertama kali?</option>
                                                <option value="Di kota mana Anda lahir?">Di kota mana Anda lahir?</option>
                                                <option value="Apa nama jalan tempat Anda tinggal saat masa kecil?">Apa nama jalan tempat Anda tinggal saat masa kecil?</option>           
                                                <option value="Apa nama makanan favorit Anda?">Apa nama makanan favorit Anda?</option>
                                                <option value="lainnya_5">Lainnya</option>
                                            </select>
                                            <div id="containerLain5" style="display:none; margin-top:10px;">
                                                <input type="text" class="form-control" name="pertanyaanLain5" id="pertanyaanLain5" placeholder="Masukkan pertanyaan lainnya">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirm">Jawaban 5</label>
                                            <input type="text" class="form-control" name="jawaban_5" id="jawaban_5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="grid-item" id="headingThree">
                                    <h5 class="mb-0">
                                        <div class="d-flex justify-content-between">
                                            <h3>
                                                Masukkan Alamat Email (Opsional)
                                            </h3>
                                            <button class="btn btn-primary collapsed toggle-visibility" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" id="email" name="email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                `,
                focusConfirm: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                preConfirm: () => {
                    const password = document.getElementById('password').value;
                    const password_confirm = document.getElementById('password_confirm').value;
                    var pertanyaan1 = document.getElementById('pertanyaan_1').value;
                    var pertanyaan2 = document.getElementById('pertanyaan_2').value;
                    var pertanyaan3 = document.getElementById('pertanyaan_3').value;
                    var jawaban1 = document.getElementById('jawaban_1').value;
                    var jawaban2 = document.getElementById('jawaban_2').value;
                    var jawaban3 = document.getElementById('jawaban_3').value;
                    var email = document.getElementById('email').value;
                    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                    
                    if (!password || !password_confirm) {
                        Swal.showValidationMessage('Password dan konfirmasi password harus diisi.');
                        return false;
                    }

                    if (password.length < 6) {
                        Swal.showValidationMessage('Password harus memiliki minimal 6 karakter.');
                        return false;
                    }

                    if(password !== password_confirm){
                        Swal.showValidationMessage('Password dan konfirmasi password tidak sama.');
                        return false;
                    }

                    if(!pertanyaan1 || !jawaban1){
                        Swal.showValidationMessage('Pertanyaan 1 dan jawaban 1 harus diisi.');
                        return false;
                    }

                    if(!pertanyaan2 || !jawaban2){
                        Swal.showValidationMessage('Pertanyaan 2 dan jawaban 2 harus diisi.');
                        return false;
                    }

                    if(!pertanyaan3 || !jawaban3){
                        Swal.showValidationMessage('Pertanyaan 3 dan jawaban 3 harus diisi.');
                        return false;
                    }

                
                    if(email){

                        if (!emailPattern.test(email)) {
                        Swal.showValidationMessage('Email yang anda masukkan salah.');
                        return false;
                        }
                    }

                

                    document.getElementById('form').submit();
                    
                }
            })
            const toggleButtons = document.querySelectorAll('.toggle-visibility');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetSelector = button.getAttribute('data-target');
                    const targetElement = document.querySelector(targetSelector);
                    
                    if (targetElement) {
                        targetElement.classList.toggle('show-visibility');
                    }
                });
            });
        });
        </script>
        <script>
            function toggleInputField1() {
                var selectElement1 = document.getElementById('pertanyaan_1');
                var containerLain1 = document.getElementById('containerLain1');
                var inputField = document.getElementById('pertanyaanLain1');
                if (selectElement1.value === 'lainnya_1') {
                    containerLain1.style.display = 'block';
                    inputField.value = '';
                    inputField.setAttribute('required', 'true');
                } else {
                    containerLain1.style.display = 'none';
                    inputField.value = selectElement1.value;
                
                }
        
            }

            function toggleInputField2() {
                var selectElement2 = document.getElementById('pertanyaan_2');
                var containerLain2 = document.getElementById('containerLain2');
                var inputField = document.getElementById('pertanyaanLain2');
                if (selectElement2.value === 'lainnya_2') {
                    containerLain2.style.display = 'block';
                    inputField.value = '';
                    inputField.setAttribute('required', 'true');
                } else {
                    containerLain2.style.display = 'none';
                    inputField.value = selectElement2.value;
                }
            }

            function toggleInputField3() {
                var selectElement3 = document.getElementById('pertanyaan_3');
                var containerLain3 = document.getElementById('containerLain3');
                var inputField = document.getElementById('pertanyaanLain3');
                if (selectElement3.value === 'lainnya_3') {
                    containerLain3.style.display = 'block';
                    inputField.value = '';
                    inputField.setAttribute('required', 'true');
                } else {
                    containerLain3.style.display = 'none';
                    inputField.value = selectElement3.value;
                }
            }

            function toggleInputField4() {
                var selectElement4 = document.getElementById('pertanyaan_4');
                var containerLain4 = document.getElementById('containerLain4');
                var inputField = document.getElementById('pertanyaanLain4');

                if (selectElement4.value === 'lainnya_4') {
                    containerLain4.style.display = 'block';
                    inputField.value = '';
                    inputField.setAttribute('required', 'true');
                } else {
                    containerLain4.style.display = 'none';
                    inputField.value = selectElement4.value;
                }
            }

            function toggleInputField5() {
                var selectElement5 = document.getElementById('pertanyaan_5');
                var containerLain5 = document.getElementById('containerLain5');
                var inputField = document.getElementById('pertanyaanLain5');
                if (selectElement5.value === 'lainnya_5') {
                    containerLain5.style.display = 'block';
                    inputField.value = '';
                    inputField.setAttribute('required', 'true');
                } else {
                    containerLain5.style.display = 'none';
                    inputField.value = selectElement5.value;
                }
            }
        </script>
    <?php } ?>
<?php if(session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            confirmButtonColor:'#7bb3ff',
            text: '<?= session()->getFlashdata('success') ?>',
        }).then((result) => {
            if (result.isConfirmed) {
                const driver = window.driver.js.driver;

                const driverObj = driver();

                const tour = driver({
                    showProgress: true,
                    steps: [
                        { element: '#profileNav', popover: { title: 'Profile', 
                            description: 'Tekan tombol ini untuk mengelola informasi profil Anda. Anda dapat memperbarui detail akun di sini.' } },
                        { element: '#dashNav', popover: { title: 'Dashboard', 
                            description: 'Ini adalah tombol Dashboard. Anda dapat menekannya untuk melihat dasborard Anda dan melihat berbagai informasi feedback-feedback yang disampaikan oleh siswa dan wali siswa.' } },
                        <?php if(session()->get('role') == 2) { ?>
                            { element: '#feedNav', popover: { title: 'Feedback', 
                                description: 'Ini adalah tombol Feedback. Anda dapat menekannya untuk melihat dan mengelola feedback yang disampaikan oleh siswa dan wali siswa.' } },
                        <?php } ?>
                        { element: '#dataNav', popover: { title: 'Data', 
                          description: 'Ini adalah tombol dropdown Data. Anda dapat menekannya untuk melihat dasborard Anda dan melihat berbagai informasi feedback-feedback anda.' } },
                        { element: '#logoutNav', popover: { title: 'Logout', 
                          description: 'Ini adalah tombol Logout. Anda dapat menekannya untuk keluar dari sistem.' } },
                        <?php if(session()->get('role') == 2) { ?>
                            { element: '#openBox', popover: { title: 'Total Tiket Open', 
                                description: 'Di sini Anda dapat melihat jumlah tiket yang saat ini terbuka dan menunggu direspon.' } },
                            { element: '#progressBox', popover: { title: 'Total Tiket Dalam Progress', 
                                description: 'Di sini Anda dapat melihat jumlah tiket yang sedang dalam proses penyelesaian.' } },
                            { element: '#closedBox', popover: { title: 'Total Tiket Closed', 
                                description: 'Di sini Anda dapat melihat jumlah tiket yang telah ditutup dan diselesaikan.' } },
                            { element: '#todayBox', popover: { title: 'Grafik Tiket', 
                                description: 'Di sini Anda dapat melihat jumlah tiket baru yang masuk hari ini.' } },
                            { element: '#grafikTotal', popover: { title: 'Grafik Tiket', 
                                description: 'Kartu ini menyajikan wawasan grafis tentang data tiket, membantu Anda menganalisis tren dan pola.' } },
                            { element: '#ratingFeed', popover: { title: 'Jumlah Tiket per Kategori', 
                                description: 'Menampilkan jumlah tiket yang dikelompokkan berdasarkan kategori, memberikan gambaran umum tentang distribusi tiket.' } },
                            { element: '#kategoriBox', popover: { title: 'Jumlah Tiket per Kategori', 
                                description: 'Menampilkan jumlah tiket yang dikelompokkan berdasarkan kategori.' } },
                            { element: '#kategoriCard', popover: { title: 'Grafik Tiket per Kategori', 
                                description: 'Grafik ini menunjukkan pembagian tiket berdasarkan kategori.' } },
                        <?php } ?>
                    ]
                })

                tour.drive()
            }
        });
    </script>
<?php endif; ?>
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
                        { element: '#profileNav', popover: { title: 'Profile', 
                            description: 'Tekan tombol ini untuk mengelola informasi profil Anda. Anda dapat memperbarui detail akun di sini.' } },
                        { element: '#dashNav', popover: { title: 'Dashboard', 
                            description: 'Ini adalah tombol Dashboard. Anda dapat menekannya untuk melihat dasborard Anda dan melihat berbagai informasi feedback-feedback yang disampaikan oleh siswa dan wali siswa.' } },
                        <?php if(session()->get('role') == 2) { ?>
                            { element: '#feedNav', popover: { title: 'Feedback', 
                                description: 'Ini adalah tombol Feedback. Anda dapat menekannya untuk melihat dan mengelola feedback yang disampaikan oleh siswa dan wali siswa.' } },
                        <?php } ?>
                        { element: '#dataNav', popover: { title: 'Data', 
                          description: 'Ini adalah tombol dropdown Data. Anda dapat menekannya untuk melihat dasborard Anda dan melihat berbagai informasi feedback-feedback anda.' } },
                        { element: '#logoutNav', popover: { title: 'Logout', 
                          description: 'Ini adalah tombol Logout. Anda dapat menekannya untuk keluar dari sistem.' } },
                        <?php if(session()->get('role') == 2) { ?>
                            { element: '#openBox', popover: { title: 'Total Tiket Open', 
                                description: 'Di sini Anda dapat melihat jumlah tiket yang saat ini terbuka dan menunggu direspon.' } },
                            { element: '#progressBox', popover: { title: 'Total Tiket Dalam Progress', 
                                description: 'Di sini Anda dapat melihat jumlah tiket yang sedang dalam proses penyelesaian.' } },
                            { element: '#closedBox', popover: { title: 'Total Tiket Closed', 
                                description: 'Di sini Anda dapat melihat jumlah tiket yang telah ditutup dan diselesaikan.' } },
                            { element: '#todayBox', popover: { title: 'Grafik Tiket', 
                                description: 'Di sini Anda dapat melihat jumlah tiket baru yang masuk hari ini.' } },
                            { element: '#grafikTotal', popover: { title: 'Grafik Tiket', 
                                description: 'Kartu ini menyajikan wawasan grafis tentang data tiket, membantu Anda menganalisis tren dan pola.' } },
                            { element: '#ratingFeed', popover: { title: 'Jumlah Tiket per Kategori', 
                                description: 'Menampilkan jumlah tiket yang dikelompokkan berdasarkan kategori, memberikan gambaran umum tentang distribusi tiket.' } },
                            { element: '#kategoriBox', popover: { title: 'Jumlah Tiket per Kategori', 
                                description: 'Menampilkan jumlah tiket yang dikelompokkan berdasarkan kategori.' } },
                            { element: '#kategoriCard', popover: { title: 'Grafik Tiket per Kategori', 
                                description: 'Grafik ini menunjukkan pembagian tiket berdasarkan kategori.' } },
                        <?php } ?>
                    ]
                })

                tour.drive()
    }
});
    </script>
<?= $this->endSection()?>