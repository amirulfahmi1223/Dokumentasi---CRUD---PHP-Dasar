<?php
require 'funcition.php';
//ambil data di url
$id = $_GET['id'];
//function query select yang sudah dibuat data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contoh</title>
</head>
<style>
  .table {
    margin: auto;
    background-color: #fff;
    width: 70%;
    height: 70vh;
    align-items: center;
  }

  .form {
    background-color: #eaeaea;
    width: 920px;
    margin: 70px auto;
    height: 700px;
    border-radius: 5px;
    border: 1px solid;
  }

  .content-form {
    padding: 15px 10px;
  }

  .form h1 {
    margin-bottom: 15px;
  }

  .buku {
    border: 1px solid;
    background-color: #0E86D4;
    color: #fff;
    text-align: center;
    padding: 20px;
    border-radius: 5px;
  }

  h1 {
    text-align: center;
    color: #eaeaea;
  }

  input[type=text] {
    width: 100%;
    height: 30px;
  }

  input[type=email] {
    width: 100%;
    height: 30px;
  }

  input[type=password] {
    width: 100%;
    height: 30px;
    margin-bottom: 10px;
  }

  input[type=date] {
    width: 100%;
    height: 30px;
    margin-bottom: 10px;
  }

  input[type=file] {
    width: 100%;
    height: 30px;
    margin-bottom: 10px;
  }

  .label {
    margin-top: 5px;
  }

  textarea {
    width: 100%;
    height: 80px;
  }

  input[type=submit] {
    margin-top: 12px;
    width: 100%;
    height: 35px;
    background-color: #0E86D4;
    color: #fff;
    border-radius: 3px;
  }

  button[type=submit] {
    margin-top: 5px;
    width: 100%;
    height: 35px;
    background-color: #0E86D4;
    color: #fff;
    border-radius: 3px;
  }

  input[type=button]:hover {
    background-color: #6CC4A1;
  }

  input[type=submit]:hover {
    background-color: #6CC4A1;
  }

  img {
    width: 50px;
    height: 50px;
  }
</style>


<body>
  <div class="form">
    <h2 class="buku">Ubah Data</h2>
    <div class="content-form">
      <form action="" method="POST" enctype="multipart/form-data">
        <p>NRP</p>
        <input type="number" name="nrp" value="<?php echo $mhs['nrp'] ?>" size="40px" required>
        <p>Nama</p>
        <input type="text" name="nama" value="<?php echo $mhs['nama'] ?>" required>
        <p>Email</p>
        <input type="email" name="email" value="<?php echo $mhs['email'] ?>" size="40px" required>
        <p>Jurusan</p>
        <input type="text" name="jurusan" value="<?php echo $mhs['jurusan'] ?>" required>
        <p>Gambar</p>
        <img src="img/<?php echo $mhs['gambar'] ?>">
        <input type="file" name="gambar">
        <button type="submit" name="submit">Tambah</button>
        <input type="hidden" name="id" value="<?php echo $mhs['id']; ?>">
        <input type="hidden" name="gambarLama" value="<?php echo $mhs['gambar']; ?>">
      </form>
    </div>
  </div>
</body>

</html>