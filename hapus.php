<?php
session_start();
if (!isset($_SESSION["login"])) {
  echo '<script>window.location="login.php"</script>';
}
include 'funcition.php';
$id = $_GET['id'];
if (hapus($id) > 0) {
  echo "<script>alert('Hapus data berhasil')</script>";
  echo "<script>window.location='index.php'</script>";
} else {
  echo "<script>alert('Hapus data gagal')</script>";
  echo mysqli_error($conn);
}
