
document.addEventListener('DOMContentLoaded', function() {
    var kelas = document.getElementById("guru_kelas").value;
   // Select the element with id 'rombel'
    var rombel = document.getElementById('rombel');
    if (kelas == 1 || kelas == 4 || kelas == 5 || kelas == 6) {
        rombel.disabled = false;
    } else {
        rombel.disabled = true;
    }
});
 function updateRombel() {
   var kelas = document.getElementById("guru_kelas").value;
   var rombel = document.getElementById("rombel");

   // Clear existing options
   rombel.innerHTML = '<option value="" hidden>Pilih Rombel</option>';

   if (kelas == 1 || kelas == 4 || kelas == 5 || kelas == 6) {

       rombel.disabled = false; // Enable rombel select
       var optionA = document.createElement("option");
       optionA.value = "A";
       optionA.text = "A";
       rombel.appendChild(optionA);

       var optionB = document.createElement("option");
       optionB.value = "B";
       optionB.text = "B";
       rombel.appendChild(optionB);
   } else {
       rombel.disabled = true; // Disable rombel select
   }
 }


document.addEventListener('DOMContentLoaded', function() {
 const form = document.getElementById('form');

 form.addEventListener('submit', function(event) {
     event.preventDefault();
     
     // Ambil nilai input
     const nama = document.getElementById('nama').value;
     const nik = document.getElementById('nik').value;
     const nip = document.getElementById('nip').value;
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
     }else if(nip.length > 18 || nip.length < 18) {
         // Proses form jika valid
         Swal.fire({
             icon: 'error',
             title: 'Error!',
             text: 'NIP harus memiliki 18 karakter.',
         }); 
     }else if(nik.length < 16 || nik.length > 16) {
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
