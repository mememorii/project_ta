<?= $this->extend('layout_user/master') ?>
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
<button class="overlay-button" id="tourButton"><i class="fa-solid fa-circle-question mr-2"></i>Panduan Fitur</button>
<div class="container-fluid" style="padding-left:99px;padding-right:99px">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Form Feedback</h3>
        </div>
        <form action="<?= base_url() ?>crm/store" method="post" enctype="multipart/form-data" id="feedback-form">
          <input type="hidden" id="id_referensi" name="id_referensi" value="<?= session()->get('id_referensi') ?>">
          <input type="hidden" id="jenis_id" name="jenis_id" value="<?= session()->get('role') ?>">
          <input type="hidden" id="user_create" name="user_create" value="<?= session()->get('firstname') ?>">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label>Judul</label>
                    <input required type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan Judul">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label>Kategori</label>
                    <select type="text" class="form-control" name="kategori" id="kategori" required>
                      <option value="" selected hidden disabled>Pilih Kategori</option>
                      <option value="Sarana Prasarana">Sarana Prasarana</option>
                      <option value="Akademik">Akademik</option>
                      <option value="Administrasi">Administrasi</option>
                      <option value="Tenaga Pendidik">Tenaga Pendidik</option>
                      <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
              </div>
            </div>
            <!-- <div class="star-rating">
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
            </div> -->
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="form-control"  required></textarea>
            </div>
            <div class="form-group">
              <label>Foto (Opsional)</label><br>
              <div class="grid-item">
                <h3 for="fileInput" class="file-input-wrapper">
                  <i class="fa-solid fa-plus"></i> Pilih Foto
                  <input type="file" id="fileInput" name="fileuploads[]" accept="image/*" multiple onchange="loadFile(event)">
                </h3>
                <div id="output" class="gallery"></div>
               </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('feedback-form');

    form.addEventListener('submit', function(event) {
      event.preventDefault();

      const judul = document.getElementById('judul').value;
      const deskripsi = document.getElementById('deskripsi').value;
      
      if (judul.length < 20) {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Panjang judul tidak boleh kurang dari 20 karakter.',
        });
        return false;
      }

      if (judul.length > 40) {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Panjang judul tidak boleh lebih dari 40 karakter.',
        });
        return false;
      }

      if (deskripsi.length < 40) {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Panjang deskripsi tidak boleh kurang dari 40 karakter.',
        });
        return false;
      }

         // Proses form jika valid
        
         

        const href = this.getAttribute('href');

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Pastikan data yang anda masukkan benar.',
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
    const img = (src, index, name) => `
        <div class="gallery-item">
            <a href="${src}" data-lightbox="gallery" data-title="${name}"><img src="${src}" width="50px" data-index="${index}" /></a>
        </div>`;

    var loadFile = function (event) {
        var output = document.getElementById('output');
        output.innerHTML = '';

        [...event.target.files].forEach((file, index) => {
            output.innerHTML += img(URL.createObjectURL(file), index, file.name);
        });

        // Initialize Lightbox
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        });
    };
</script>
<script>
           // ketika user menekan rating maka updaate input hidden lalu submit
      ratingInputs.forEach(function(input) {
          input.addEventListener('change', function() {
              ratingSelected = true;
              ratingValueInput.value = this.value; // update input hidden ke pilihan
              popup.style.display = "none";
              form.submit(); 
          });
      });

      const stars = document.querySelectorAll('.star-rating input');
    stars.forEach(star => {
        star.addEventListener('change', () => {
            document.querySelectorAll('.star-rating label').forEach(label => {
                label.style.color = '#ddd'; // reset color
            });
            for (let i = star.value; i >= 1; i--) {
                document.querySelector(`label[for="rating-${i}"]`).style.color = 'gold';
            }
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
                        { element: '#judul', popover: { title: 'Home', 
                            description: 'Ini adalah tombol home. Anda dapat menekannya untuk melihat dasborard Anda dan melihat berbagai informasi feedback-feedback anda.' } },
                        { element: '#kategori', popover: { title: 'Feedback', 
                            description: 'Ini adalah tombol home. Anda dapat menekannya untuk melihat dan mengelola feedback yang anda kirimkan.' } },
                        { element: '#deskripsi', popover: { title: 'Open Tiket', 
                            description: 'Di sini Anda dapat melihat semua tiket yang saat ini terbuka dan memerlukan perhatian serta penyelesaian Anda.' } },
                        { element: '#fileInput', popover: { title: 'Profile', 
                            description: 'Tekan tombol ini untuk mengelola informasi profil Anda. Anda dapat memperbarui detail akun di sini.' } },
                        { element: '#submitBtn', popover: { title: 'Total Tiket', 
                            description: 'Kotak ini menampilkan total jumlah tiket, memberikan gambaran umum tentang semua tiket di sistem.' } },
                        { element: '#kembali', popover: { title: 'Total Tiket Open', 
                            description: 'Di sini Anda dapat melihat jumlah tiket yang saat ini terbuka dan menunggu penyelesaian.' } },
                    ]
                })

                tour.drive()
    }
});
    </script>
<?= $this->endSection()?>