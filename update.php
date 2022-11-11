<?php
session_start();
require 'funcition.php';
if (!isset($_SESSION["login"])) {
  echo '<script>window.location = "login.php"</script>';
}
//ambil data di URL
$id = $_GET['id'];
//function query select yang sudah dibuat data mahasiswa berdasarkan id
$siswa = query("SELECT * FROM tb_siswa WHERE id = $id")[0];

//cek apakah tombol submit sudah ditekan atau blm
if (isset($_POST['submit'])) {
  //cek data apakah berhasil ditambahkan atau tidak
  if (ubah($_POST) > 0) {
    echo "<script>alert('Data berhasil diubah')</script>";
    echo "<script>window.location='index.php'</script>";
  } else {
    echo "<script>alert('Tidak ada data yang di ubah')</script>";
    echo "<script>window.location='index.php'</script>";
    echo mysqli_error($conn);
  }
}
?>
<html>

<head>
  <title>Crud Dasar</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<body>
  <div class="container mt-5">
    <div class="4">
      <form action="" method="POST">
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="nama" class="form-control" value="<?php echo $siswa['nama'] ?>" required>
        </div>

        <div class="form-group">
          <label>Kelas</label>
          <input type="text" name="kelas" class="form-control" value="<?php echo $siswa['kelas'] ?>" required>
        </div>

        <div class="form-group">
          <label>Jurusan</label>
          <input type="text" name="jurusan" class="form-control" value="<?php echo $siswa['jurusan'] ?>" required>
        </div>

        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="alamat" class="form-control" value="<?php echo $siswa['alamat'] ?>" required>
        </div>
        <input type="hidden" name="id" value="<?php echo $siswa['id']; ?>">
        <div class="form-group mt-3">
          <input type="submit" name="submit" class="btn btn-success" value="Simpan">
        </div>
      </form>
    </div>

  </div>
  </div>
  <!-- JS -->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <!-- Swal -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
  <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
  <script src="js-ku.js"></script>
</body>

</html>