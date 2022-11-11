<?php
session_start();
//cek kalo gada session login maka blm login
//kembalikan ke login
//jika tidak ada session[login] maka tendang ke login.php
if (!isset($_SESSION["login"])) {
  echo '<script>window.location="login.php"</script>';
}
include 'funcition.php';
$select = query("SELECT * FROM tb_siswa");
//insert
if (isset($_POST['submit'])) {
  //cek data apakah berhasil ditambahkan atau tidak
  if (tambah($_POST) > 0) {
    echo "<script>alert('Tambah data berhasil')</script>";
    echo "<script>window.location='index.php'</script>";
  } else {
    echo "<script>alert('Tambah data gagal')</script>";
    echo "<script>window.location='index.php'</script>";
    echo mysqli_error($conn);
  }
}
if (isset($_POST["cari"])) { //button cari
  //data select akan diganti
  $select = cari($_POST["keyword"]);
}
?>

<html>

<head>
  <title>FRAMEWORK FAHMI</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<body>
  <div class="container mt-5">
    <a href="keluar.php" class="btn btn-warning mb-2 float-right">Keluar</a>
    <div class="panjang w-25">
      <form class="d-flex" role="search" method="POST">
        <input class="form-control me-2" type="search" name="keyword" placeholder="Search" aria-label="Search" autocomplete="off">
        <button class="btn btn-outline-success" type="submit" name="cari">Search</button>
      </form>
    </div>
    <div class="row">
      <div class="col-md-8">
        <table class="table table-hover">
          <thead>
            <th>#</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Alamat</th>
            <th>Aksi</th>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($select as $row) : ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?php echo $row['nama'] ?></td>
                <td><?php echo $row['kelas'] ?></td>
                <td><?php echo $row['jurusan'] ?></td>
                <td><?php echo $row['alamat'] ?></td>
                <td>
                  <a href="update.php?id=<?php echo $row['id'] ?>" class=" btn btn-primary">Edit</a>
                  <a href="hapus.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <div class="4">
        <form action="" method="POST">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Jurusan</label>
            <input type="text" name="jurusan" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
          </div>

          <div class="form-group mt-3">
            <input type="submit" name="submit" class="btn btn-success" value="Simpan">
          </div>
        </form>
      </div>

    </div>
  </div>
  <!-- JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <style>
    .float-right {
      margin-right: 27%;
    }
  </style>
</body>

</html>