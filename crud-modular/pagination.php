<?php
require 'funcition.php';

//pagination
//konfigurasi
$jumlahDataPerhalaman = 2;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
//jika bernilai true ? maka akan di isi $_GET[halaman]
//dan jika false : maka di isi 1
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

$select = query("SELECT * FROM mahasiswa LIMIT $awalData,$jumlahDataPerhalaman");


//tombol cari ditekan
if (isset($_POST["cari"])) { //button cari
  //data select akan diganti
  $select = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Admin</title>
</head>

<body>

  <h1>Daftar Mahasiswa</h1>
  <div class="header">
    <a href="insert.php">
      <h4>Tambah Data</h4>
    </a>
    <form action="" method="POST">
      <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan keyword pencarian.." autocomplete="off">
      <button type="submit" name="cari">Cari!</button>
    </form>
    <br>
  </div>
  <div class="container">
    <table border="1" cellpadding="20" width="95%" cellspacing="0">
      <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>NRP</th>
        <th>Email</th>
        <th>Jurusan</th>
      </tr>
      <?php $no = $awalData + 1;
      ?>
      <?php foreach ($select as $row) : ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td>
            <a href="update.php?id=<?php echo $row['id'] ?>">Edit</a> ||
            <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick=" return confirm('Yakin Hapus?')">Hapus</a>
          </td>
          <td><img src="img/<?php echo $row['gambar']; ?>"></td>
          <td><?php echo $row['nama']; ?></td>
          <td><?php echo $row['nrp']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['jurusan']; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <!-- navigasi -->
    <?php if ($halamanAktif > 1) : ?>
      <a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
      <!-- ketika mau pindah ke hal yang sama tinggal ?hal=$hal aktif -->
    <?php endif; ?>
    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
      <?php if ($i == $halamanAktif) : ?>
        <a href="?halaman=<?= $i; ?>" style="font-weight : bold; color:red;"><?= $i; ?></a>
      <?php else : ?>
        <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
      <?php endif; ?>
    <?php endfor; ?>
    <?php if ($halamanAktif < $jumlahHalaman) : ?>
      <a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
    <?php endif; ?>
  </div>
  <style>
    a {
      text-decoration: none;
    }

    body {
      background-color: #f4f4f4;
    }

    .container {
      background-color: #fff;
      margin: auto;
      width: 80%;
    }

    .header {
      margin-left: 10%;
    }

    h1 {
      text-align: center;
    }

    table {
      margin: auto;
    }

    img {
      width: 100px;
      height: 100px;
    }
  </style>
</body>

</html>