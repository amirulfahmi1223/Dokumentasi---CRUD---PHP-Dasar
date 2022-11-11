<?php
session_start();
require 'funcition.php';

if (isset($_POST["login"])) {
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    //cek akun ada apa tidak
    $cek = mysqli_query($conn, "SELECT * FROM user WHERE username = '" . $user . "' AND password = '" . $password . "'");
    //cek username
    if (mysqli_num_rows($cek) > 0) {
        $d = mysqli_fetch_object($cek);
        //$_SESSION adalah mekanisme penyimpanan informasi kedalam variabel agar bisa digunakan lebih dari satu halaman
        $_SESSION['login'] = true;
        //==================================
        echo '<script>window.location ="index.php"</script>';
        echo '<script>alert("Login Berhasil")</script>';
    } else {
        echo '<script>alert("Gagal, username atau password salah")</script>';
    }
}
