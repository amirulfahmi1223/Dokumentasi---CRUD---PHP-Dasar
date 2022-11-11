<?php
require 'funcition.php';
$select = query("SELECT * FROM mahasiswa");
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
      <?php $no = 1;
      ?>
      <?php foreach ($select as $row) : ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td>
            <a href="update.php?id=<?php echo $row['id']; ?>">Edit</a> ||
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