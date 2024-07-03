<?php if (session()->get('role') == 2) {  ?>
    <?= $this->extend('layouts/master') ?>
<?php }else{ ?>
    <?= $this->extend('layout_user/master') ?>
<?php } ?>

<?= $this->section('content') ?>
<style>
  /* Styles for the modal */
  .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }

  .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 30%;
  }

  .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
  }

  .close:hover,
  .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
  }

  /* Styles for star rating input */
  .star-rating {
      display: flex;
      flex-direction: row-reverse;
      justify-content: center;
  }

  .star-rating input {
      display: none;
  }

  .star-rating label {
      font-size: 50px; /* Adjust star size */
      color: #ccc; /* Default star color */
      cursor: pointer;
  }

  .star-rating input:checked ~ label,
  .star-rating input:hover ~ label,
  .star-rating label:hover ~ label {
      color: #ffa500; /* Change color of selected stars */
  }

  .star-rating label:hover,
  .star-rating label:hover ~ label {
      color: #ffa500;
  }
</style>
<?php if (session()->get('role') == '1') {  ?>
  <div class="container-fluid">
<?php }elseif(session()->get('role') == '2'){ ?>
  <div class="container-fluid">
<?php }else{ ?>
  <div class="container-fluid" style="padding-left:99px;padding-right:99px">
<?php } ?>
  <div class="row">
    <div class="col-md-4">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Profile</h3>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-striped">
            <tbody>
              <tr>
                <td>Dibuat Oleh</td>
                <td>:</td>
                <td><?=$crm['nama']?></td>  
                <td>
                    <span class="badge bg-primary">
                      <?php if( $crm['role'] == 3) {
                        echo "Siswa";
                      }else{
                        echo "wali";}?>
                    </span>
                </td>              
              </tr>
            </tbody>
          </table><br>
          <?php if ($crm['status'] == 'closed') {  ?>
           
          <?php }elseif(session()->get('role') == 3 || session()->get('role') == 4){ ?>
            <form action="<?=base_url()?>crm/close" method="post" id="myForm">
              <input type="hidden" id="id_crm" name="id_crm" value="<?=$crm['id_crm']?>">
              <input type="hidden" name="rating" id="ratingValue" value="">
              <button type="submit" class="btn btn-primary btn-block" id="closeButton">Close Tiket</button><br>
            </form>
          <?php }else{ ?>
          <?php } ?>
        </div>
      </div>
      <?php if ($crm['rating'] !== null): ?>
        <!-- <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Rating Pelayanan</h3>
          </div>
          <div class="card-body">
           
          </div>
        </div> -->
      <?php endif; ?>
     
    </div>
    <div class="col-md-8">
      <div class="card card-primary" style="zoom: 0.90;">
        <div class="card-header">
          <h3 class="card-title">Detail</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <p><b>Judul</b></p>
              <p><?=$crm['judul']?></p>
              <p><b>Deskripsi</b></p>
              <p><?=$crm['deskripsi']?></p>
              <p><b>Foto</b></p>
              <div class="image-container">
              <?php if (!empty($images) && is_array($images)): ?>
                <?php foreach ($images as $image): ?>
                  <div>
                    <a href="<?= base_url($image['filepath']) ?>" data-lightbox="crm-images" data-title="<?= $image['filename'] ?>">
                        <img src="<?= base_url($image['filepath']) ?>" alt="<?= $image['filename'] ?>" width="200">
                    </a>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <p>Foto Tidak Ditemukan.</p>
              <?php endif; ?>
              </div><br>
            </div>
          </div>
          <div class="row">
            <form action="<?=base_url()?>crm/update_komentar" method="post">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="hidden" id="id_crm" name="id_crm" value="<?=$crm['id_crm']?>">
                  <input type="hidden" id="user_comment" name="user_comment" value="<?= session()->get('nama') ?>">
                  <label>Komentar</label>
                  <textarea id="komentar" rows="3" name="komentar"></textarea>
                </div>
                <?php if($crm['status'] == 'closed'){ ?>
                  <button type="submit" class="btn btn-primary btn-block" disabled>Tiket Telah Ditutup</button><br>
                <?php }else{ ?>
                  <button type="submit" class="btn btn-primary btn-block">Kirim</button><br>
                <?php } ?>
              </div>
            </form>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="timeline">
                <?php foreach ($komentar as $key => $value) { ?>
                <div class="time-label">
                  <span class="bg-red"><?=$key?></span>
                </div>
                <?php foreach ($value as $keys => $values) { ?>
                <div>
                  <i class="fas fa-solid fa-comment bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> <?=substr($values->timestamp,10,9)?></span>
                    <h3 class="timeline-header"><b>Comment By</b> <?=$values->user_comment?>
                    <?php if($crm['status'] == 'open'){ ?>
                      <?php if (session()->get('nama') == $values->user_comment) { ?>
                      <a href="<?= base_url() ?>comment/delete/<?= $values->id_komentar ?>?id_crm=<?= $crm['id_crm'] ?>" class="btn btn-sm btn-danger" id="konfirmasi" style="margin-left:10px;">Delete</a></h3>
                      <?php }else{ ?>
                        </h3>
                      <?php } ?>
                    <?php }else{ ?>
                      </h3>
                    <?php } ?>
                    <div class="timeline-body">
                      <?=$values->notes?>
                    </div>
                  </div>
                </div>
                <?php } ?>
                
                <?php } ?>
              </div>
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
                <label for="rating-5">☆</label>
                <input type="radio" name="rating" id="rating-4" value="4" class="rating-input">
                <label for="rating-4">☆</label>
                <input type="radio" name="rating" id="rating-3" value="3" class="rating-input">
                <label for="rating-3">☆</label>
                <input type="radio" name="rating" id="rating-2" value="2" class="rating-input">
                <label for="rating-2">☆</label>
                <input type="radio" name="rating" id="rating-1" value="1" class="rating-input">
                <label for="rating-1">☆</label>
            </div>
    </div>
</div>

<script>
ClassicEditor
    .create( document.querySelector( '#komentar' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'imageUpload', 'undo', 'redo' ],
        image: {
            toolbar: [ 'imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight' ],
            upload: {
                // Konfigurasi upload gambar
                uploadUrl: '<?= base_url() ?>/uploadHandler.php' // Sesuaikan dengan alamat server lokal Anda
            },
            // Atur untuk menampilkan upload gambar yang berhasil
            shouldUpload: function( file ) {
                console.log( file );
                return true;
            }
        }
    } )
    .catch( function( error ) {
        console.error( error );
    } );
</script>

<!-- <script>
$(document).ready(function() {
    $('#komentar').summernote({
        height: 300,
        callbacks: {
            onImageUpload: function(files) {
                uploadImage(files[0]);
            }
        }
    });

    function uploadImage(file) {
        var formData = new FormData();
        formData.append('file', file);

        $.ajax({
            url: 'public/assets/dist/uploads/uploadHandler.php', // Ganti dengan path ke skrip upload.php di server Anda
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                var data = JSON.parse(response);
                $('#komentar').summernote('insertImage', data.url);
            },
            error: function(xhr, status, error) {
                console.error('Gagal mengunggah gambar: ' + error);
            }
        });
    }
});
</script> -->

</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Get form 
    var form = document.getElementById("myForm");
    // Get hidden input
    var ratingValueInput = document.getElementById("ratingValue");
    // Get modal
    var popup = document.getElementById("ratingPopup");
    // get close
    var closeSpan = document.getElementsByClassName("close")[0];
    // get semua rat input
    var ratingInputs = document.querySelectorAll(".rating-input");
    // cek apa udah milih
    var ratingSelected = false;
    // ketika submit cegah dan display modal 
    form.onsubmit = function(event) {
        if (!ratingSelected) {
            event.preventDefault(); // cegah submit
            popup.style.display = "flex"; 
        }
    }

    // ketika user menekan x = close
    closeSpan.onclick = function() {
        popup.style.display = "none";
    }

    //ketika user menekan diluar modal maka close
    window.onclick = function(event) {
        if (event.target == popup) {
            popup.style.display = "none";
        }
    }

    // ketika user menekan rating maka updaate input hidden lalu submit
    ratingInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            ratingSelected = true;
            ratingValueInput.value = this.value; // update input hidden ke pilihan
            popup.style.display = "none";
            form.submit(); 
        });
    });
});

</script>

<?= $this->endSection()?>