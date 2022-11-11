<?php
include 'funcition.php';
//AMBIL DAHULU ID NYA
$id = $_GET['id'];
if (hapus($id) > 0) {
  echo "<script>alert('Hapus data berhasil')</script>";
  echo "<script>window.location='index.php'</script>";
} else {
  echo "<script>alert('Hapus data gagal')</script>";
  echo mysqli_error($conn);
}
