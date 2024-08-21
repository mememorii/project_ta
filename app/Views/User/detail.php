<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Detail Data</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr><th>Nama</th><td><?=$account['nama']?></td></tr>
                                <tr><th>NIK</th><td><?=$account['nik']?></td></tr>
                                <tr><th>Email</th><td><?=$account['email']?></td></tr>
                                <tr><th>Role</th>
                                    <td>
                                        <?php 
                                            if ($account['role'] == 1) { 
                                                echo"Admin";
                                            }elseif($account['role'] == 2){ 
                                                echo"Guru";
                                                if(session()->get('role') == 1){
                                                    echo'<a href = "' . base_url() . 'admin/hak/' . $account['id_users'] . '" class="btn-sm btn-primary ml-2 hak"><i class="fa-solid fa-key mr-1"></i>Transfer Hak Admin</a>';
                                                }
                                            }elseif($account['role'] == 3){ 
                                                echo"Siswa";
                                            }else{ 
                                                echo"Wali Siswa";
                                            } 
                                        ?>
                                    </td>
                                </tr>
                                <tr><th>Waktu Akun Dibuat</th><td><?=$account['created_at']?></td></tr>
                                <tr><th>Data Selengkapnya</th>
                                    <td>
                                        <?php if($account['role'] == 1){ ?>
                                            <a href="<?= base_url() ?>admin/guru/detail/<?= $account['id_referensi'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
                                        <?php }elseif($account['role'] == 2){ ?>
                                            <a href="<?= base_url() ?>admin/guru/detail/<?= $account['id_referensi'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
                                        <?php }elseif($account['role'] == 3){ ?>
                                            <a href="<?= base_url() ?>admin/siswa/detail/<?= $account['id_referensi'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
                                        <?php }else{ ?>
                                            <a href="<?= base_url() ?>admin/wali/detail/<?= $account['id_referensi'] ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const konfirmasiButtons = document.querySelectorAll('.hak');

            konfirmasiButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); 

                    const href = this.getAttribute('href');

                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Anda akan kehilangan hak akses admin",
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