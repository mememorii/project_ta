<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
  <div class="row">
            <div class="col-lg-3 col-6">
              <?php if(session()->get('role') == 2){ ?>
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?= $tiketKelasOpen ?></h3>
                    <p>Total Tiket Kelas Open</p>
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
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?= $tiketKelasClosed ?></h3>
                    <p>Total Tiket Kelas Closed</p>
                  </div>
                  <div class="icon">
                    <i class="nav-icon fa-solid fa-file-invoice"></i>
                  </div>
                    <a href="<?= base_url()?>crm" class="small-box-footer">Data Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
                </div>
              <?php }else{ ?>
                <div class="small-box bg-primary">
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
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?= $ticketsToday ?></h3>
                    <p>Total Tiket Hari Ini</p>
                  </div>
                  <div class="icon">
                    <i class="nav-icon fa-solid fa-file-invoice"></i>
                  </div>
                  <a href="<?= base_url()?>crm" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
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
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?= $tiketKelas ?></h3>
                    <p>Total Tiket Kelas</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                    <a href="<?= base_url()?>crm" class="small-box-footer">Data Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
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
  <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <b><p style="color:white">Grafik Tiket</p></b>
        </div>
        <div class="card-body">
          <div class="container">
            <canvas id="statusChart" width="400" height="400"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <b><p style="color:white">Grafik Siswa</p></b>
        </div>
        <div class="card-body">
          <div class="container">
            <canvas id="kelasChart" width="400" height="400"></canvas>
          </div>
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
          // Data
          var openCount = <?php echo $openCount; ?>;
          var closedCount = <?php echo $closedCount; ?>;

          // Chart
          var ctx = document.getElementById('statusChart').getContext('2d');
          var statusChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: ['Open', 'Closed'],
                  datasets: [{
                      label: 'Tiket',
                      data: [openCount, closedCount],
                      backgroundColor: [
                          'rgba(0,128,0)',
                          'rgba(255, 0, 0)'
                      ],
                      borderColor: [
                          'rgba(0,128,0)',
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
          // Data
          var kelas1 = <?php echo $kelas1; ?>;
          var kelas2 = <?php echo $kelas2; ?>;
          var kelas3 = <?php echo $kelas3; ?>;
          var kelas4 = <?php echo $kelas4; ?>;
          var kelas5 = <?php echo $kelas5; ?>;
          var kelas6 = <?php echo $kelas6; ?>;

          // Chart
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>
<?= $this->endSection()?>