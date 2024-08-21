<?php if (session()->get('role') == 2) {  ?>
    <?= $this->extend('layouts/master') ?>
<?php }else{ ?>
    <?= $this->extend('layout_user/master') ?>
<?php } ?>

<?= $this->section('content') ?>
<style>
 .grid-item {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 10px;
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
<link rel="stylesheet" href="<?= base_url()?>public/assets/dist/css/feedback.css">
<button class="overlay-button" id="tourButton"><i class="fa-solid fa-circle-question mr-2"></i>Panduan Fitur</button>
<?php if (session()->get('role') == '1') {  ?>
  <div class="container-fluid">
<?php }elseif(session()->get('role') == '2'){ ?>
  <div class="container-fluid">
<?php }else{ ?>
  <div class="container-fluid" style="padding-left:99px;padding-right:99px">
<?php } ?>
  <div class="row">
    <div class="col-md-4">
      <div class="card card-primary" id="profileCard">
        <div class="card-header">
          <h3 class="card-title">Profile</h3>
        </div>
        <div class="card-body">
        <div style="margin-bottom:20px">
          <label>Dibuat Oleh :</label><br>
          <div class="grid-item">
            <span><?= $crm['nama'] ?></span>
            <span class="badge bg-primary ml-2">
              <?php if( $crm['role'] == 3) {
                echo "Siswa";
              }else{
                echo "wali";}?>
            </span>
          </div>
        </div>
          <?php if(!empty($crm['responden']) || session()->get('role') == 4 && !empty($crm['responden'])){ ?>
            <div style="margin-bottom:20px">
              <label>Direspon Oleh :</label><br>
              <div class="grid-item">
                <span><?= $crm['responder'] ?></span>
              </div>
            </div>
          <?php } ?>
          <?php if($crm['status'] == 'closed'){ ?>
            <label>Tiket Feedback Ditutup Pada : </label>
            <div class="mt-1 mb-4 grid-item">
              <span><?= $crm['closed_at'] ?></span>
            </div>
          <?php } ?>
          <?php if(session()->get('role') == 2 && empty($crm['responden']) && $crm['status'] == 'open'){ ?>
            <form action="<?=base_url()?>respond" id="respondBtn" method="post">
              <input type="hidden" id="id_feedback" name="id_feedback" value="<?=$crm['id_feedback']?>">
              <button type="submit" class="btn btn-primary btn-block" id="closeButton">Respond</button><br>
            </form>
          <?php } ?>
          <?php if(session()->get('role') == 3 && $crm['status'] == 'closed' && empty($crm['rating']) || session()->get('role') == 4 && $crm['status'] == 'closed' && empty($crm['rating'])){ ?>
            <form action="<?=base_url()?>rate" method="post" id="myForm">
              <input type="hidden" id="id_feedback" name="id_feedback" value="<?=$crm['id_feedback']?>">
              <input type="hidden" name="rating" id="ratingValue" value="">
              <button type="submit" class="btn btn-primary btn-block" id="closeButton">Nilai Pelayanan</button>
            </form>
          <?php } ?>
          <?php if(session()->get('id_referensi') == $crm['responden'] && $crm['status'] == 'progress'){ ?>
            <form action="<?=base_url()?>crm/close" method="post" id="closeForm">
              <input type="hidden" id="id_feedback" name="id_feedback" value="<?=$crm['id_feedback']?>">
              <?php if(empty($crm['resolusi'])) { ?>
                <button type="submit" class="btn btn-primary btn-block" id="closeButton" disabled>Close Tiket</button>
              <?php }else{ ?>
                <button type="submit" class="btn btn-primary btn-block" id="closeButton">Close Tiket</button>
              <?php } ?>
            </form>
          <?php } ?>
        </div>
      </div>
      <?php if ($crm['status'] == 'closed' && !empty($crm['rating'])): ?>
        <div class="card card-primary" id="ratingCard">
          <div class="card-header">
            <h3 class="card-title">Rating Pelayanan</h3>
          </div>
          <div class="card-body">
            <div class="rating-item">
              <span class="rating-stars">
                  <?php
                  $ratingValue = $crm['rating'];
                  for ($i = $ratingValue; $i >= 1; $i--) {
                      echo '<i class="fa-solid fa-star" style="color:gold;font-size:45px"></i>';
                  }
                  ?>
              </span><br>
              <span class="centered-span mt-3"><?= $ratingLabel ?></span>
            </div>
          </div>
        </div>
      <?php endif; ?>
     
    </div>
    <div class="col-md-8" id="detailCard">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Detail</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <p><b>Judul</b></p>
              <p class="grid-item" style="margin-top:15px;"><?=$crm['judul']?></p>
              <p style="margin-top:15px;"><b>Kategori</b></p>
              <p class="grid-item" style="margin-top:15px;"><?=$crm['kategori']?></p>
              <p style="margin-top:15px;"><b>Deskripsi</b></p>
              <p class="grid-item"style="margin-top:15px;"><?=$crm['deskripsi']?></p>
              <p style="margin-top:15px;"><b>Foto</b></p>
              <div class="image-container" style="margin-top:15px;">
                <?php if (!empty($images) && is_array($images)): ?>
                  <?php foreach ($images as $image): ?>
                    <div>
                      <a href="<?= base_url($image['filepath']) ?>" data-lightbox="crm-images" data-title="<?= $image['filename'] ?>">
                          <img src="<?= base_url($image['filepath']) ?>" alt="<?= $image['filename'] ?>" width="150">
                      </a>
                    </div>
                  <?php endforeach; ?>
                <?php else: ?>
                  <p style="margin-top:15px;">Foto Tidak Ditemukan.</p>
                <?php endif; ?>
              </div><br>
            </div>
          </div>
          <?php if($crm['status'] !== 'open') { ?>
            <div class="card-header p-2" id="detailTab">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#tab1default" data-toggle="tab">Komentar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab2default" data-toggle="tab">Resolusi</a></li>
                </ul>
            </div>
          <?php } ?>
          <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="tab1default">
                  <?php if(session()->get('id_referensi') == $crm['responden'] && $crm['status'] == 'progress' || session()->get('id_referensi') == $crm['id_referensi'] && $crm['status'] == 'progress'){ ?>
                    <form action="<?=base_url()?>crm/update_komentar" method="post">
                        <div class="form-group">
                          <input type="hidden" id="id_feedback" name="id_feedback" value="<?=$crm['id_feedback']?>">
                          <input type="hidden" id="user_comment" name="user_comment" value="<?= session()->get('id_referensi') ?>">
                          <label>Komentar</label>
                          <textarea id="komentar" rows="3" name="komentar"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Kirim</button><br>
                    </form>
                  <?php } ?>
                  <div class="timeline" id="timeline">
                    <?php foreach ($komentar as $key => $value) { ?>
                      <div class="time-label">
                        <span class="bg-red"><?=$key?></span>
                      </div>
                      <?php foreach ($value as $keys => $values) { ?>
                        <div>
                          <i class="fas fa-solid fa-comment bg-blue"></i>
                          <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> <?=substr($values->timestamp,10,9)?></span>
                            <h3 class="timeline-header"><b>Komentar Oleh</b> <?=$values->namaKomentar?></h3>
                            <div class="timeline-body">
                              <?=$values->notes?>
                            </div>
                            <div class="timeline-footer">
                              <?php if($crm['status'] == 'open' || $crm['status'] == 'progress'){ ?>
                                <?php if (session()->get('id_referensi') == $values->user_comment) { ?>
                                  <a href="<?= base_url() ?>comment/delete/<?= $values->id_komentar ?>?id_feedback=<?= $crm['id_feedback'] ?>" class="btn btn-sm konfirmasi" id="konfirmasi">Delete</a></h3>
                                <?php } ?>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    <?php } ?>
                  </div>
                </div>
                <div class="tab-pane" id="tab2default">
                  <?php if(session('role') == 2 && session()->get('id_referensi') == $crm['responden'] && $crm['status'] == 'progress' && empty($crm['resolusi']) || isset($editData)) { ?>
                    <form action="<?=base_url()?>crm/resolusi" method="post">
                        <div class="form-group">
                          <input type="hidden" id="id_feedback" name="id_feedback" value="<?=$crm['id_feedback']?>">
                          <label>Resolusi</label>
                          <textarea id="resolusi" rows="3" name="resolusi">
                            <?php if(isset($editData)) { ?>
                              <?= $crm['resolusi'] ?>
                            <?php } ?>
                          </textarea>
                        </div>
                        <?php if($crm['status'] == 'closed'){ ?>
                          <button type="submit" class="btn btn-primary btn-block" disabled>Tiket Telah Ditutup</button><br>
                        <?php }else{ ?>
                          <button type="submit" class="btn btn-primary btn-block">Kirim</button><br>
                        <?php } ?>
                    </form>
                  <?php }elseif(empty($crm['resolusi'])) { ?>
                    <div class="grid-item">
                      <div>
                        <i class="fa-solid fa-circle-info" style="margin-right:10px;font-size:30px;color:gray;vertical-align: middle"></i>
                        <span style="vertical-align: middle">Resolusi Feedback Belum Ditentukan</span>
                      </div>
                    </div>
                  <?php }else{ ?>
                    <label>Resolusi</label>
                    <div class="grid-item">
                      <p><?= $crm['resolusi'] ?></p>
                      <?php if(session()->get('id_referensi') == $crm['responden'] && $crm['status'] == 'progress') { ?>
                        <a href="<?= base_url() ?>crm/editResolusi/<?= $crm['id_feedback'] ?>" class="btn btn-primary mt-3">Edit</a>
                      <?php } ?>
                    </div>
                  <?php } ?>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="ratingPopup" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <center><h2>Nilai Pelayanan</h2></center>
        <!-- Star rating input -->
        <div class="star-rating">
          <input type="radio" name="rating" id="rating-5" value="5" class="rating-input">
          <label for="rating-5"><i class="fa-solid fa-star"></i></label>
          <input type="radio" name="rating" id="rating-4" value="4" class="rating-input">
          <label for="rating-4"><i class="fa-solid fa-star"></i></label>
          <input type="radio" name="rating" id="rating-3" value="3" class="rating-input">
          <label for="rating-3"><i class="fa-solid fa-star"></i></label>
          <input type="radio" name="rating" id="rating-2" value="2" class="rating-input">
          <label for="rating-2"><i class="fa-solid fa-star"></i></label>
          <input type="radio" name="rating" id="rating-1" value="1" class="rating-input">
          <label for="rating-1"><i class="fa-solid fa-star"></i></label>
        </div>
    </div>
</div>
<script src="<?= base_url()?>public/assets/dist/js/feedback.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#komentar'),{
        ckfinder:{
            uploadUrl: "<?= base_url('feedback/save') ?>",
        },
    }).then(editor=>{
        console.log(editor);
    }).catch(error=>{
        console.log(error);
    });
</script>
<script>
ClassicEditor
    .create(document.querySelector('#resolusi'),{
        ckfinder:{
            uploadUrl: "<?= base_url('feedback/save') ?>",
        },
    }).then(editor=>{
        console.log(editor);
    }).catch(error=>{
        console.log(error);
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('closeForm');

  form.addEventListener('submit', function(event) {
    event.preventDefault(); 
    const href = this.getAttribute('href');

    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: 'Feedback Tidak Bisa Dibuka Kembali.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Iya'
    }).then((result) => {
        if (result.isConfirmed) {
          form.submit(); 
        }
    });
  });
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
                        <?php if(session()->get('role') == 2) { ?>
                          { element: '#start', popover: { title: 'Detail Feedback', 
                              description: 'Dihalaman ini anda dapat melihat detail dari feedback yang disampaikan oleh siswa atau wali siswa.' } },
                        <?php }else{ ?>
                          { element: '#start', popover: { title: 'Detail Feedback', 
                            description: 'Dihalaman ini anda dapat melihat detail dari feedback yang anda kirim serta tanggapan dan resolusi feedback dari guru.' } },
                        <?php } ?>
                        <?php if($crm['status'] == 'open' && session()->get('role') == 2) { ?>
                          { element: '#respondBtn', popover: { title: 'Respond Feedback', 
                            description: 'Tekan tombol ini untuk merespon tiket feedback ini.' } },
                        <?php } ?>
                        <?php if($crm['status'] == 'progress' && session()->get('role') == 2) { ?>
                          { element: '#closeButton', popover: { title: 'Close Button', 
                            description: 'Tekan tombol ini apabila resolusi feedback sudah ditentukan untuk menutup tiket feedback ini.' } },
                        <?php } ?>
                        <?php if($crm['status'] == 'progress' || $crm['status'] == 'closed') { ?>
                          { element: '#detailTab', popover: { title: 'Tab', 
                            description: 'Tekan tombol ini untuk melihat komentar atau resolusi.' } },
                        <?php } ?>
                        <?php if(!empty($crm['rating']) && session()->get('role') == 2) { ?>
                          { element: '#ratingCard', popover: { title: 'Profile', 
                            description: 'Disini anda dapat melihat rating yang diberikan oleh siswa atau wali siswa.' } },
                        <?php } ?>
                        { element: '#profileCard', popover: { title: 'Profile', 
                            description: 'Disini anda dapat melihat nama siswa atau wali siswa yang menyampaikan feedback ini serta nama guru yang merespon feedback dan tanggal feedback ditutup.' } },
                        { element: '#detailCard', popover: { title: 'Detail', 
                            description: 'Disini Anda dapat melihat semua data tiket feedback ini.' } },
                        { element: '#timeline', popover: { title: 'Timeline', 
                          description: 'Disini Anda dapat melihat semua komentar yang anda dan guru sampaikan.' } },
                    ]
                })

                tour.drive()
    }
});
    </script>
    <?php if(session()->getFlashdata('success')) { ?>
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Sukses',
          confirmButtonColor:'#7bb3ff',
          text: '<?= session()->getFlashdata('success') ?>',})
      </script>
    <?php } ?>
<?= $this->endSection()?>