<?php
//jalankan sessionya
session_start();
// hapus semua variabel session
session_unset();
//hancurkan semua variabel session
session_destroy();
// clear cookei logout
setcookie('login', '', time() - 3600);
echo '<script>window.location="login.php"</script>';
//menggunakan ini wajib untuk membuat session harus login ketika ingin akses
//jika ada login maka harus ada keluar