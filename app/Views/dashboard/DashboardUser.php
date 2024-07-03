<?= $this->extend('layout_user/master') ?>
<?= $this->section('content') ?>
<div class="row" style="padding-left:100px">
    <div class="col-lg-2 col-6">
        <div class="small-box bg-info">
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
    <div class="col-lg-2 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $open ?></h3>
                <p>Total Tiket Open</p>
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
    <div class="col-lg-2 col-6">
        <div class="small-box bg-danger">
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
    <div class="col-5">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <p>Grafik Tiket</p>
                    <canvas id="ticketChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        // Data
        var openCount = <?php echo $open; ?>;
        var closedCount = <?php echo $closed; ?>;

        // Chart
        var ctx = document.getElementById('ticketChart').getContext('2d');
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

<?= $this->endSection()?>