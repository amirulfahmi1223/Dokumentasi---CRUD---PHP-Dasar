<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_unpas');
$banyakDataPerHal = 3;
$banyakData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mahasiswa"));
$banyalHal = ceil($banyakData / $banyakDataPerHal);

if (isset($_GET['halaman'])) {
  $halamanAktif = $_GET['halaman'];
} else {
  $halamanAktif = 1;
}
$dataAwal = ($halamanAktif * $banyakDataPerHal) - $banyakDataPerHal;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Belajar Pagination</title>
  <!--LINK BOOSTRAP-->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
</head>

<body>
  <!--Link bostrap Js-->
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-7">
        <h4>Daftar Siswa</h4>
      </div>
      <div class="col-md-5">
        <form action="" method="POST">
          <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Masukkan kata kunci keyword" autocomplete="off" autofocus>
            <div class="input-group-append">
              <button type="submit" name="cari" class="btn btn-secondary pl-4 pr-4">Cari</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <table class="table table-bordered table-hover table-secondary mt-4">
      <thead class="thead thead-primary text-center">
        <th>No.</th>
        <th>Gambar</th>
        <th>NRP</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
      </thead>
      <tbody>
        <?php $no = $dataAwal + 1; ?>
        <!-- konfigurasi Cari -->
        <?php
        if ((isset($_POST['cari'])) and $_POST['keyword'] <> "") {
          $keyword = $_POST['keyword'];
          $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE 
          nama LIKE '%$keyword%' OR
          nrp LIKE '%$keyword%' OR
          email LIKE '%$keyword%' OR
          jurusan LIKE '%$keyword%'
          LIMIT $dataAwal,$banyakDataPerHal");
        } else {
          $result = mysqli_query($conn, "SELECT * FROM mahasiswa LIMIT $dataAwal,$banyakDataPerHal");
        }
        ?>
        <?php
        while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?php echo $row['gambar'] ?></td>
            <td><?php echo $row['nrp'] ?></td>
            <td><?php echo $row['nama'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['jurusan'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <nav>

      <ul class="pagination justify-content-start">
        <!-- sebelumnya -->
        <?php if ($halamanAktif <= 1) : ?>
          <li class="page-item disabled"><a href="?halaman=<?= $halamanAktif - 1 ?>" class="page-link">Back</a></li>
        <?php else : ?>
          <li class="page-item"><a href="?halaman=<?= $halamanAktif - 1 ?>" class="page-link">Back</a></li>
        <?php endif; ?>
        <!-- akhir sebelumnya -->
        <?php
        for ($i = 1; $i <= $banyalHal; $i++) : ?>
          <?php if ($i == $halamanAktif) : ?>
            <li class="page-item"><a href="?halaman=<?= $i; ?>" class="page-link bg-primary text-white"><?= $i; ?></a></li>
          <?php else : ?>
            <li class="page-item"><a href="?halaman=<?= $i; ?>" class="page-link"><?= $i; ?></a></li>
          <?php endif; ?>
        <?php endfor; ?>
        <!-- selanjutnya -->
        <?php if ($halamanAktif >= $banyalHal) : ?>
          <li class="page-item disabled"><a href="?halaman=<?= $halamanAktif + 1 ?>" class="page-link">Next</a></li>
        <?php else : ?>
          <li class="page-item"><a href="?halaman=<?= $halamanAktif + 1 ?>" class="page-link">Next</a></li>
        <?php endif; ?>
        <!-- akhir selanjutnya -->
      </ul>
    </nav>
  </div>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>