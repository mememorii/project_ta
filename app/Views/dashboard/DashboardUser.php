<?= $this->extend('layout_user/master') ?>
<?= $this->section('content') ?>
<style>
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
/* styles.css */


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
<?php $uri = service('uri') ?>
<?php $this->config = config('Auth');
$redirect = $this->config->assignRedirect; ?>
<?php $this->config = config('Auth'); $redirect = $this->config->assignRedirect;?>
<button class="overlay-button" id="tourButton"><i class="fa-solid fa-circle-question mr-2"></i>Panduan Fitur</button>
<div class="container-fluid"  style="padding-left:100px;padding-right:100px">
    <?php if(!empty($unrated)){ ?>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span>Ada <?= $unrated ?> Feedback Yang Belum Anda Nilai</span>
                    <?php if(session()->get('role') == 3){ ?>
                        <a href="<?= base_url('siswa/crm') ?>" class="btn btn-primary">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    <?php }else{ ?>
                        <a href="<?= base_url('wali/crm') ?>" class="btn btn-primary">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-3">
            <div class="small-box bg-info" id="totalBox">
                <div class="inner">
                    <h3><?= $ticket ?></h3>
                    <p>Total Tiket Anda</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fa-solid fa-file-invoice"></i>
                </div>
                <?php if(session()->get('role') == 3){ ?>
                    <a href="<?= base_url('siswa/crm') ?>" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                <?php }else{ ?>
                    <a href="<?= base_url('wali/crm') ?>" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                <?php } ?>
            </div>
        </div>
        <div class="col-3">
            <div class="small-box bg-success" id="openBox">
                <div class="inner">
                    <h3><?= $open ?></h3>
                    <p>Total Tiket Open</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fa-solid fa-file-invoice"></i>
                </div>
                <?php if(session()->get('role') == 3){ ?>
                    <a href="<?= base_url('siswa/crm') ?>" id="btnOpen" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                <?php }else{ ?>
                    <a href="<?= base_url('wali/crm') ?>" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                <?php } ?>
            </div>
        </div>
        <div class="col-3">
            <div class="small-box bg-warning" id="progressBox">
                <div class="inner" style="color:white">
                    <h3><?= $progress ?></h3>
                    <p>Total Tiket Dalam Progress</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fa-solid fa-file-invoice"></i>
                </div>
                <?php if(session()->get('role') == 3){ ?>
                    <a href="<?= base_url('siswa/crm') ?>" class="small-box-footer" id="btnProgress" style="color:white">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                <?php }else{ ?>
                    <a href="<?= base_url('wali/crm') ?>" class="small-box-footer" style="color:white">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                <?php } ?>
            </div>
        </div>
        <div class="col-3">
            <div class="small-box bg-danger" id="closedBox">
                <div class="inner">
                    <h3><?= $closed ?></h3>
                    <p>Total Tiket Closed</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fa-solid fa-file-invoice"></i>
                </div>
                <?php if(session()->get('role') == 3){ ?>
                    <a href="<?= base_url('siswa/crm') ?>" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                <?php }else{ ?>
                    <a href="<?= base_url('wali/crm') ?>" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-6"> -->
            <div class="card" id="tiketCard">
                <div class="card-header" style="color:white">
                    <span>Jumlah Tiket Feedback</span>
                </div>
                <div class="card-body">
                    <div class="container">
                        <canvas id="ticketChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        <!-- </div> -->
        <!-- <div class="col-6"> -->
        <div class="row" id="kategoriBox">
            <?php 
                $index = 0;
                foreach ($kategoriStatusCountsUser as $category => $statuses): 
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
                            <p class="mt-3"><?= $category ?></p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fa-solid fa-file-invoice"></i>
                        </div>
                        <?php if(session()->get('role') == 3){ ?>
                            <a href="<?= base_url('siswa/crm') ?>" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                        <?php }else{ ?>
                            <a href="<?= base_url('wali/crm') ?>" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
            <div class="card" id="kategoriCard">
                <div class="card-header" style="color:white">
                    <span>Jumlah Tiket Feedback Per Kategori</span>
                </div>
                <div class="card-body">
                    <div class="container">
                        <canvas id="kategoriChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        <!-- </div> -->
    <!-- </div> -->
</div>
<script>
    // Data
    var openCount = <?php echo $open; ?>;
    var closedCount = <?php echo $closed; ?>;
    var progressCount = <?php echo $progress; ?>;

    // Chart
    var ctx = document.getElementById('ticketChart').getContext('2d');
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
                confirmButtonColor:'#7bb3ff',
                html: `
                    <h1 class="mb-3">Untuk keamanan akun anda sebelum menggunakan sistem amankan akun anda dengan mengikuti langkah dibawah ini</h1>
                    <div class="accordion" id="accordionExample">
                        <form action="<?= base_url() ?>security" id="form" method="post">
                            <div class="card">
                                <div class="grid-item" id="headingOne">
                                    <h5 class="mb-0">
                                        <div class="d-flex justify-content-between">
                                            <h3>Ganti Password</h3>
                                            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
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
                                            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <?php if(session()->get('role') == 3) { ?>
                                        <div class="card-body">
                                            <input type="hidden" class="form-control" name="id_users" id="id_users" value="<?= session()->get('id') ?>">
                                            <div class="form-group">
                                                <label>Pertanyaan 1</label>
                                                <select class="form-control" name="pertanyaan_1" id="pertanyaan_1" onchange="toggleInputField1()" required>
                                                    <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                                    <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                                    <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                                    <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>  
                                                    <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                                    <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                                    <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                                    <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                                    <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                                    <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                                    <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                                    <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                                    <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>              
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
                                                    <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                                    <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                                    <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option> 
                                                    <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                                    <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                                    <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                                    <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                                    <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                                    <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                                    <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                                    <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                                    <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>               
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
                                                    <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                                    <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                                    <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>   
                                                    <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                                    <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                                    <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                                    <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                                    <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                                    <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                                    <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                                    <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                                    <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>              
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
                                                    <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                                    <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                                    <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>   
                                                    <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                                    <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                                    <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                                    <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                                    <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                                    <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                                    <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                                    <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                                    <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>              
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
                                                    <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                                    <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                                    <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>
                                                    <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                                    <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                                    <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                                    <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                                    <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                                    <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                                    <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                                    <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                                    <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>      
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
                                    <?php }elseif(session()->get('role') == 4){ ?>
                                        <div class="card-body">
                                            <input type="hidden" class="form-control" name="id_users" id="id_users" value="<?= session()->get('id') ?>">
                                            <div class="form-group">
                                                <label>Pertanyaan 1</label>
                                                <select class="form-control" name="pertanyaan_1" id="pertanyaan_1" onchange="toggleInputField1()" required>
                                                    <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                                    <option value="Siapa guru wali kelas anak Anda saat ini?">Siapa guru wali kelas anak Anda saat ini?</option>
                                                    <option value="Di kota mana anak Anda lahir?">Di kota mana anak Anda lahir?</option>
                                                    <option value="Apa hobi favorit anak Anda?">Apa hobi favorit anak Anda?</option>  
                                                    <option value="Apa nama teman terbaik anak Anda di sekolah?">Apa nama teman terbaik anak Anda di sekolah?</option>           
                                                    <option value="Apa pelajaran favorit anak Anda di sekolah?">Apa pelajaran favorit anak Anda di sekolah?</option>           
                                                    <option value="Apa nama panggilan anak Anda di rumah?">Apa nama panggilan anak Anda di rumah?</option>           
                                                    <option value="Di kelas berapa anak Anda saat ini?">Di kelas berapa anak Anda saat ini?</option>           
                                                    <option value="Apa warna tas sekolah anak Anda?">Apa warna tas sekolah anak Anda?</option>           
                                                    <option value="Apa nama tokoh kartun favorit anak Anda?">Apa nama tokoh kartun favorit anak Anda?</option>           
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
                                                    <option value="Siapa guru wali kelas anak Anda saat ini?">Siapa guru wali kelas anak Anda saat ini?</option>
                                                    <option value="Di kota mana anak Anda lahir?">Di kota mana anak Anda lahir?</option>
                                                    <option value="Apa hobi favorit anak Anda?">Apa hobi favorit anak Anda?</option>  
                                                    <option value="Apa nama teman terbaik anak Anda di sekolah?">Apa nama teman terbaik anak Anda di sekolah?</option>           
                                                    <option value="Apa pelajaran favorit anak Anda di sekolah?">Apa pelajaran favorit anak Anda di sekolah?</option>           
                                                    <option value="Apa nama panggilan anak Anda di rumah?">Apa nama panggilan anak Anda di rumah?</option>           
                                                    <option value="Di kelas berapa anak Anda saat ini?">Di kelas berapa anak Anda saat ini?</option>           
                                                    <option value="Apa warna tas sekolah anak Anda?">Apa warna tas sekolah anak Anda?</option>           
                                                    <option value="Apa nama tokoh kartun favorit anak Anda?">Apa nama tokoh kartun favorit anak Anda?</option>           
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
                                                    <option value="Siapa guru wali kelas anak Anda saat ini?">Siapa guru wali kelas anak Anda saat ini?</option>
                                                    <option value="Di kota mana anak Anda lahir?">Di kota mana anak Anda lahir?</option>
                                                    <option value="Apa hobi favorit anak Anda?">Apa hobi favorit anak Anda?</option>  
                                                    <option value="Apa nama teman terbaik anak Anda di sekolah?">Apa nama teman terbaik anak Anda di sekolah?</option>           
                                                    <option value="Apa pelajaran favorit anak Anda di sekolah?">Apa pelajaran favorit anak Anda di sekolah?</option>           
                                                    <option value="Apa nama panggilan anak Anda di rumah?">Apa nama panggilan anak Anda di rumah?</option>           
                                                    <option value="Di kelas berapa anak Anda saat ini?">Di kelas berapa anak Anda saat ini?</option>           
                                                    <option value="Apa warna tas sekolah anak Anda?">Apa warna tas sekolah anak Anda?</option>           
                                                    <option value="Apa nama tokoh kartun favorit anak Anda?">Apa nama tokoh kartun favorit anak Anda?</option>                      
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
                                                    <option value="Siapa guru wali kelas anak Anda saat ini?">Siapa guru wali kelas anak Anda saat ini?</option>
                                                    <option value="Di kota mana anak Anda lahir?">Di kota mana anak Anda lahir?</option>
                                                    <option value="Apa hobi favorit anak Anda?">Apa hobi favorit anak Anda?</option>  
                                                    <option value="Apa nama teman terbaik anak Anda di sekolah?">Apa nama teman terbaik anak Anda di sekolah?</option>           
                                                    <option value="Apa pelajaran favorit anak Anda di sekolah?">Apa pelajaran favorit anak Anda di sekolah?</option>           
                                                    <option value="Apa nama panggilan anak Anda di rumah?">Apa nama panggilan anak Anda di rumah?</option>           
                                                    <option value="Di kelas berapa anak Anda saat ini?">Di kelas berapa anak Anda saat ini?</option>           
                                                    <option value="Apa warna tas sekolah anak Anda?">Apa warna tas sekolah anak Anda?</option>           
                                                    <option value="Apa nama tokoh kartun favorit anak Anda?">Apa nama tokoh kartun favorit anak Anda?</option>           
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
                                                    <option value="Siapa guru wali kelas anak Anda saat ini?">Siapa guru wali kelas anak Anda saat ini?</option>
                                                    <option value="Di kota mana anak Anda lahir?">Di kota mana anak Anda lahir?</option>
                                                    <option value="Apa hobi favorit anak Anda?">Apa hobi favorit anak Anda?</option>  
                                                    <option value="Apa nama teman terbaik anak Anda di sekolah?">Apa nama teman terbaik anak Anda di sekolah?</option>           
                                                    <option value="Apa pelajaran favorit anak Anda di sekolah?">Apa pelajaran favorit anak Anda di sekolah?</option>           
                                                    <option value="Apa nama panggilan anak Anda di rumah?">Apa nama panggilan anak Anda di rumah?</option>           
                                                    <option value="Di kelas berapa anak Anda saat ini?">Di kelas berapa anak Anda saat ini?</option>           
                                                    <option value="Apa warna tas sekolah anak Anda?">Apa warna tas sekolah anak Anda?</option>           
                                                    <option value="Apa nama tokoh kartun favorit anak Anda?">Apa nama tokoh kartun favorit anak Anda?</option>                 
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
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="card">
                                <div class="grid-item" id="headingThree">
                                    <h5 class="mb-0">
                                        <div class="d-flex justify-content-between">
                                            <h3>
                                                <?php if(session()->get('role') == 3) { ?>
                                                    Masukkan Alamat Email Wali (Opsional)
                                                <?php }else{ ?>
                                                    Masukkan Alamat Email (Opsional)                                            
                                                <?php } ?>
                                            </h3>
                                            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
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
    })
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
                confirmButtonColor:'#7bb3ff',
                html: `
                    <h1 class="mb-3">Untuk keamanan akun anda sebelum menggunakan sistem amankan akun anda dengan mengikuti langkah dibawah ini</h1>
                    <div class="accordion" id="accordionExample">
                        <form action="<?= base_url() ?>security" id="form" method="post">
                            <div class="card">
                                <div class="grid-item" id="headingOne">
                                    <h5 class="mb-0">
                                        <div class="d-flex justify-content-between">
                                            <h3>Ganti Password</h3>
                                            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
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
                                            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <?php if(session()->get('role') == 3) { ?>
                                        <div class="card-body">
                                            <input type="hidden" class="form-control" name="id_users" id="id_users" value="<?= session()->get('id') ?>">
                                            <div class="form-group">
                                                <label>Pertanyaan 1</label>
                                                <select class="form-control" name="pertanyaan_1" id="pertanyaan_1" onchange="toggleInputField1()" required>
                                                    <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                                    <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                                    <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                                    <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>  
                                                    <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                                    <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                                    <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                                    <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                                    <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                                    <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                                    <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                                    <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                                    <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>              
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
                                                    <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                                    <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                                    <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option> 
                                                    <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                                    <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                                    <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                                    <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                                    <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                                    <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                                    <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                                    <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                                    <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>               
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
                                                    <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                                    <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                                    <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>   
                                                    <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                                    <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                                    <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                                    <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                                    <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                                    <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                                    <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                                    <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                                    <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>              
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
                                                    <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                                    <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                                    <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>   
                                                    <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                                    <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                                    <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                                    <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                                    <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                                    <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                                    <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                                    <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                                    <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>              
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
                                                    <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                                    <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                                    <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>
                                                    <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                                    <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                                    <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                                    <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                                    <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                                    <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                                    <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                                    <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                                    <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>      
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
                                    <?php }elseif(session()->get('role') == 4){ ?>
                                        <div class="card-body">
                                            <input type="hidden" class="form-control" name="id_users" id="id_users" value="<?= session()->get('id') ?>">
                                            <div class="form-group">
                                                <label>Pertanyaan 1</label>
                                                <select class="form-control" name="pertanyaan_1" id="pertanyaan_1" onchange="toggleInputField1()" required>
                                                    <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                                    <option value="Siapa guru wali kelas anak Anda saat ini?">Siapa guru wali kelas anak Anda saat ini?</option>
                                                    <option value="Di kota mana anak Anda lahir?">Di kota mana anak Anda lahir?</option>
                                                    <option value="Apa hobi favorit anak Anda?">Apa hobi favorit anak Anda?</option>  
                                                    <option value="Apa nama teman terbaik anak Anda di sekolah?">Apa nama teman terbaik anak Anda di sekolah?</option>           
                                                    <option value="Apa pelajaran favorit anak Anda di sekolah?">Apa pelajaran favorit anak Anda di sekolah?</option>           
                                                    <option value="Apa nama panggilan anak Anda di rumah?">Apa nama panggilan anak Anda di rumah?</option>           
                                                    <option value="Di kelas berapa anak Anda saat ini?">Di kelas berapa anak Anda saat ini?</option>           
                                                    <option value="Apa warna tas sekolah anak Anda?">Apa warna tas sekolah anak Anda?</option>           
                                                    <option value="Apa nama tokoh kartun favorit anak Anda?">Apa nama tokoh kartun favorit anak Anda?</option>           
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
                                                    <option value="Siapa guru wali kelas anak Anda saat ini?">Siapa guru wali kelas anak Anda saat ini?</option>
                                                    <option value="Di kota mana anak Anda lahir?">Di kota mana anak Anda lahir?</option>
                                                    <option value="Apa hobi favorit anak Anda?">Apa hobi favorit anak Anda?</option>  
                                                    <option value="Apa nama teman terbaik anak Anda di sekolah?">Apa nama teman terbaik anak Anda di sekolah?</option>           
                                                    <option value="Apa pelajaran favorit anak Anda di sekolah?">Apa pelajaran favorit anak Anda di sekolah?</option>           
                                                    <option value="Apa nama panggilan anak Anda di rumah?">Apa nama panggilan anak Anda di rumah?</option>           
                                                    <option value="Di kelas berapa anak Anda saat ini?">Di kelas berapa anak Anda saat ini?</option>           
                                                    <option value="Apa warna tas sekolah anak Anda?">Apa warna tas sekolah anak Anda?</option>           
                                                    <option value="Apa nama tokoh kartun favorit anak Anda?">Apa nama tokoh kartun favorit anak Anda?</option>           
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
                                                    <option value="Siapa guru wali kelas anak Anda saat ini?">Siapa guru wali kelas anak Anda saat ini?</option>
                                                    <option value="Di kota mana anak Anda lahir?">Di kota mana anak Anda lahir?</option>
                                                    <option value="Apa hobi favorit anak Anda?">Apa hobi favorit anak Anda?</option>  
                                                    <option value="Apa nama teman terbaik anak Anda di sekolah?">Apa nama teman terbaik anak Anda di sekolah?</option>           
                                                    <option value="Apa pelajaran favorit anak Anda di sekolah?">Apa pelajaran favorit anak Anda di sekolah?</option>           
                                                    <option value="Apa nama panggilan anak Anda di rumah?">Apa nama panggilan anak Anda di rumah?</option>           
                                                    <option value="Di kelas berapa anak Anda saat ini?">Di kelas berapa anak Anda saat ini?</option>           
                                                    <option value="Apa warna tas sekolah anak Anda?">Apa warna tas sekolah anak Anda?</option>           
                                                    <option value="Apa nama tokoh kartun favorit anak Anda?">Apa nama tokoh kartun favorit anak Anda?</option>                      
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
                                                    <option value="Siapa guru wali kelas anak Anda saat ini?">Siapa guru wali kelas anak Anda saat ini?</option>
                                                    <option value="Di kota mana anak Anda lahir?">Di kota mana anak Anda lahir?</option>
                                                    <option value="Apa hobi favorit anak Anda?">Apa hobi favorit anak Anda?</option>  
                                                    <option value="Apa nama teman terbaik anak Anda di sekolah?">Apa nama teman terbaik anak Anda di sekolah?</option>           
                                                    <option value="Apa pelajaran favorit anak Anda di sekolah?">Apa pelajaran favorit anak Anda di sekolah?</option>           
                                                    <option value="Apa nama panggilan anak Anda di rumah?">Apa nama panggilan anak Anda di rumah?</option>           
                                                    <option value="Di kelas berapa anak Anda saat ini?">Di kelas berapa anak Anda saat ini?</option>           
                                                    <option value="Apa warna tas sekolah anak Anda?">Apa warna tas sekolah anak Anda?</option>           
                                                    <option value="Apa nama tokoh kartun favorit anak Anda?">Apa nama tokoh kartun favorit anak Anda?</option>           
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
                                                    <option value="Siapa guru wali kelas anak Anda saat ini?">Siapa guru wali kelas anak Anda saat ini?</option>
                                                    <option value="Di kota mana anak Anda lahir?">Di kota mana anak Anda lahir?</option>
                                                    <option value="Apa hobi favorit anak Anda?">Apa hobi favorit anak Anda?</option>  
                                                    <option value="Apa nama teman terbaik anak Anda di sekolah?">Apa nama teman terbaik anak Anda di sekolah?</option>           
                                                    <option value="Apa pelajaran favorit anak Anda di sekolah?">Apa pelajaran favorit anak Anda di sekolah?</option>           
                                                    <option value="Apa nama panggilan anak Anda di rumah?">Apa nama panggilan anak Anda di rumah?</option>           
                                                    <option value="Di kelas berapa anak Anda saat ini?">Di kelas berapa anak Anda saat ini?</option>           
                                                    <option value="Apa warna tas sekolah anak Anda?">Apa warna tas sekolah anak Anda?</option>           
                                                    <option value="Apa nama tokoh kartun favorit anak Anda?">Apa nama tokoh kartun favorit anak Anda?</option>                 
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
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="card">
                                <div class="grid-item" id="headingThree">
                                    <h5 class="mb-0">
                                        <div class="d-flex justify-content-between">
                                            <h3>
                                                <?php if(session()->get('role') == 3) { ?>
                                                    Masukkan Alamat Email Wali (Opsional)
                                                <?php }else{ ?>
                                                    Masukkan Alamat Email (Opsional)                                            
                                                <?php } ?>
                                            </h3>
                                            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
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
                        { element: '#homeNav', popover: { title: 'Home', 
                            description: 'Ini adalah tombol home. Anda dapat menekannya untuk melihat dasborard Anda dan melihat berbagai informasi feedback-feedback anda.' } },
                        { element: '#feedNav', popover: { title: 'Feedback', 
                            description: 'Ini adalah tombol Feedback. Anda dapat menekannya untuk melihat dan mengelola feedback yang anda kirimkan.' } },
                        { element: '#openNav', popover: { title: 'Open Tiket', 
                            description: 'Ini adalah tombol Open Tiket. Anda dapat menekannya untuk membuat tiket feedback.' } },
                        { element: '#profileNav', popover: { title: 'Profile', 
                            description: 'Tekan tombol ini untuk mengelola informasi profil Anda. Anda dapat memperbarui detail akun di sini.' } },
                        { element: '#totalBox', popover: { title: 'Total Tiket', 
                            description: 'Kotak ini menampilkan total jumlah tiket, memberikan gambaran umum tentang semua tiket di sistem.' } },
                        { element: '#openBox', popover: { title: 'Total Tiket Open', 
                            description: 'Di sini Anda dapat melihat jumlah tiket yang saat ini terbuka dan menunggu penyelesaian.' } },
                        { element: '#progressBox', popover: { title: 'Total Tiket Dalam Progress', 
                            description: 'Bagian ini menunjukkan jumlah tiket yang sedang dalam proses dan sedang dikerjakan.' } },
                        { element: '#closedBox', popover: { title: 'Total Tiket Closed', 
                            description: 'Lihat jumlah tiket yang telah ditutup dan diselesaikan.' } },
                        { element: '#tiketCard', popover: { title: 'Grafik Tiket', 
                            description: 'Kartu ini menyajikan wawasan grafis tentang data tiket, membantu Anda menganalisis tren dan pola.' } },
                        { element: '#kategoriBox', popover: { title: 'Jumlah Tiket per Kategori', 
                            description: 'Menampilkan jumlah tiket yang dikelompokkan berdasarkan kategori, memberikan gambaran umum tentang distribusi tiket.' } },
                        { element: '#kategoriCard', popover: { title: 'Grafik Tiket per Kategori', 
                            description: 'Grafik ini menunjukkan pembagian tiket berdasarkan kategori, membantu Anda memahami tren di masing-masing kategori.' } },
                    ]
                })

                tour.drive()
            }
        });
    </script>
<?php endif; ?>
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
                                { element: '#homeNav', popover: { title: 'Home', 
                                    description: 'Ini adalah tombol home. Anda dapat menekannya untuk melihat dasborard Anda dan melihat berbagai informasi feedback-feedback anda.' } },
                                { element: '#feedNav', popover: { title: 'Feedback', 
                                    description: 'Ini adalah tombol home. Anda dapat menekannya untuk melihat dan mengelola feedback yang anda kirimkan.' } },
                                { element: '#openNav', popover: { title: 'Open Tiket', 
                                    description: 'Di sini Anda dapat melihat semua tiket yang saat ini terbuka dan memerlukan perhatian serta penyelesaian Anda.' } },
                                { element: '#profileNav', popover: { title: 'Profile', 
                                    description: 'Tekan tombol ini untuk mengelola informasi profil Anda. Anda dapat memperbarui detail akun di sini.' } },
                                { element: '#totalBox', popover: { title: 'Total Tiket', 
                                    description: 'Kotak ini menampilkan total jumlah tiket, memberikan gambaran umum tentang semua tiket di sistem.' } },
                                { element: '#openBox', popover: { title: 'Total Tiket Open', 
                                    description: 'Di sini Anda dapat melihat jumlah tiket yang saat ini terbuka dan menunggu penyelesaian.' } },
                                { element: '#progressBox', popover: { title: 'Total Tiket Dalam Progress', 
                                    description: 'Bagian ini menunjukkan jumlah tiket yang sedang dalam proses dan sedang dikerjakan.' } },
                                { element: '#closedBox', popover: { title: 'Total Tiket Closed', 
                                    description: 'Lihat jumlah tiket yang telah ditutup dan diselesaikan.' } },
                                { element: '#tiketCard', popover: { title: 'Grafik Tiket', 
                                    description: 'Kartu ini menyajikan wawasan grafis tentang data tiket, membantu Anda menganalisis tren dan pola.' } },
                                { element: '#kategoriBox', popover: { title: 'Jumlah Tiket per Kategori', 
                                    description: 'Menampilkan jumlah tiket yang dikelompokkan berdasarkan kategori, memberikan gambaran umum tentang distribusi tiket.' } },
                                { element: '#kategoriCard', popover: { title: 'Grafik Tiket per Kategori', 
                                    description: 'Grafik ini menunjukkan pembagian tiket berdasarkan kategori, membantu Anda memahami tren di masing-masing kategori.' } },
                            ]
                        })

                        tour.drive()
            }
        });
    </script>

<?= $this->endSection()?>