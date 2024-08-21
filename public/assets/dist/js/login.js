
const Toast = Swal.mixin({
toast: true,
position: "top-end",
showConfirmButton: false,
timer: 3000,
timerProgressBar: true,
didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
}
});
    
document.addEventListener('DOMContentLoaded', function() {

const form = document.getElementById('form');

form.addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Ambil nilai input
    const nik = document.getElementById('nik').value;
    const password = document.getElementById('password').value;
    // Validasi karakter minimal
    if (nik.length < 16 || nik.length > 16) {
        
        Toast.fire({
icon: "error",
title: "NIK harus memiliki 16 karakter."
});
    } else if(password.length < 6) {
        
        Toast.fire({
icon: "error",
title: "Password harus memiliki minimal 6 karakter."
});
    }else if(password.length > 16) {
        
        Toast.fire({
icon: "error",
title: "Password tidak boleh memiliki lebih dari 16 karakter."
});
    } else {
        form.submit(); 
    }
});
});
