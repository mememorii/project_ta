
$(document).ready(function() {
    $('#nisn_siswa').change(function() {
        var selectedOption = $(this).find('option:selected');
        
        var kelas = selectedOption.data('kelas');
        var rombel = selectedOption.data('rombel');

        $('#kelas').val(kelas);
        $('#rombel').val(rombel);
    });
});


      document.addEventListener('DOMContentLoaded', (event) => {
          const form = document.getElementById('text-editor');

          form.addEventListener('submit', function(event) {
              event.preventDefault(); 

              Swal.fire({
                  title: 'Apakah anda yakin?',
                  text: "Pastikan data yang dimasukkan benar",
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


document.addEventListener('DOMContentLoaded', function() {
const form = document.getElementById('form');

form.addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Ambil nilai input
    const nama = document.getElementById('nama').value;
    const nik = document.getElementById('nik').value;

    // Validasi karakter minimal
    if (nama.length < 3) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Nama harus memiliki minimal 3 karakter.',
        });
    } else if(nama.length > 60) {
        // Proses form jika valid
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Nama tidak boleh memiliki lebih dari 60 karakter.',
        });
    } else if(nik.length < 16 || nik.length > 16) {
        // Proses form jika valid
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'NIK harus memiliki 16 karakter.',
        });
    } else {
        // Proses form jika valid
      
          event.preventDefault(); 

          const href = this.getAttribute('href');

          Swal.fire({
              title: 'Apakah Data Yang Dimasukkan Benar?',
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
     
 
       
    }
});
});
