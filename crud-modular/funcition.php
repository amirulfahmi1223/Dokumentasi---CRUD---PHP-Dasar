<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_unpas');
function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}
function tambah($data)
{
  global $conn;
  $nrp = htmlspecialchars($data["nrp"]);
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $jurusan = htmlspecialchars($data["jurusan"]);

  //upload gambar
  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  //query insert data
  $query = "INSERT INTO mahasiswa 
                 VALUES 
('','$nama','$nrp','$email','$jurusan','$gambar')
";
  //panggil disini
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function upload()
{
  $namafile = $_FILES['gambar']['name'];
  $ukuranfile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  //cek apakah tidak ada gambar yang diupload
  if ($error === 4) {
    echo "<script>
    alert('Pilih gambar terlebih dahulu');
    </script>";
    return false;
  }

  //cek apakah yang diupload adalah gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif'];
  $ekstensiGambar = explode('.', $namafile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
    alert('Yang anda upload bukan gambar');
    </script>";
    return false;
  }
  //cek jika ukurannya terlalu besar
  if ($ukuranfile > 2000000) {
    echo "<script>
    alert('Ukuran gambar terlalu besar!');
    </script>";
    return false;
  }
  //lolos pengecekan, gambar siap diupload
  //generate nama gambar baru
  $namafileBaru = uniqid();
  $namafileBaru .= '.';
  $namafileBaru .= $ekstensiGambar;
  move_uploaded_file($tmpName, 'img/' . $namafileBaru);
  return $namafileBaru;
}

function hapus($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
  return mysqli_affected_rows($conn);
}

//ubah 
function ubah($data)
{
  global $conn;
  $id = htmlspecialchars($data["id"]);
  $nrp = htmlspecialchars($data["nrp"]);
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $gambarLama = htmlspecialchars($data["gambarLama"]);

  //cek apakah user pilih gambar baru atau tidak
  if ($_FILES['gambar']['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }

  //query insert data
  $query = "UPDATE mahasiswa 
                 SET 
                 nama = '$nama',
                 nrp = '$nrp',
                 email = '$email',
                 jurusan = '$jurusan',
                 gambar = '$gambar'
                 WHERE id = $id";
  //panggil disini
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function cari($keyword)
{
  $query = "SELECT * FROM mahasiswa
      WHERE
      nama LIKE '%$keyword%' OR
      nrp LIKE '%$keyword%' OR
      email LIKE '%$keyword%' OR
      jurusan LIKE '%$keyword%'
  ";
  return query($query); //query diambil dari atas/pertama
  //yaitu funcition query($query) jadi tidak dari variabel query cari
}
