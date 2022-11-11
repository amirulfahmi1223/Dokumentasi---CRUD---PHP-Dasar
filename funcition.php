<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_crud';
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  echo 'connect gagal' . mysqli_connect_error($conn);
}
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
  $nama = htmlspecialchars($data["nama"]);
  $kelas = htmlspecialchars($data["kelas"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $alamat = htmlspecialchars($data["alamat"]);
  //query insert data
  $query = "INSERT INTO tb_siswa 
  VALUES 
  ('','$nama','$kelas','$jurusan','$alamat')
  ";
  //panggil disini
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function hapus($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM tb_siswa WHERE id = $id");
  return mysqli_affected_rows($conn);
}
//ubah 
function ubah($data)
{
  global $conn;
  $id = $data["id"];
  $nama = htmlspecialchars($data["nama"]);
  $kelas = htmlspecialchars($data["kelas"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $alamat = htmlspecialchars($data["alamat"]);
  //query insert data
  $query = "UPDATE tb_siswa 
  SET 
  nama = '$nama',
  kelas = '$kelas',
  jurusan = '$jurusan',
  alamat = '$alamat'
  WHERE id = $id";
  //panggil disini
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
function cari($keyword)
{
  $query = "SELECT * FROM tb_siswa
  WHERE
  nama LIKE '%$keyword%' OR
  kelas LIKE '%$keyword%' OR
  jurusan LIKE '%$keyword%' OR
  alamat LIKE '%$keyword%'
  ";
  return query($query); //query diambil dari atas/pertama
  //yaitu funcition query($query) jadi tidak dari variabel query cari
}

//registrasi
function registrasi($data)
{
  global $conn;
  $username = strtolower(stripslashes($data["user"]));
  //strtolower digunakan untuk memaksa agar user menginputkan huruf kecil
  //stripslashes agar user tidak menginputkan break fash
  $pass = mysqli_real_escape_string($conn, $data["pass"]);
  $pass2 = mysqli_real_escape_string($conn, $data["pass2"]);

  //cek konfirmasi password
  if ($pass !== $pass2) {
    echo "<script>alert('Konfirmasi password tidak sesuai');</script>";
    return false;
  }

  //cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>alert('Username sudah terdaftar');</script>";
    return false; //dihentikan funcitionya
    //supaya insert nya gagal dan yang bawah tidak dijalankan
  }

  //enkripsi password
  //pengamanan password tanpa MD5 karena jadul
  // $password = password_hash($pass, PASSWORD_DEFAULT);

  //tambahkan userbaru ke database
  mysqli_query($conn, "INSERT INTO user
    VALUES (
      '','$username','$pass'
    )");
  return mysqli_affected_rows($conn);
  //dari $conn untuk menghasilkan nilai 1 jika berhasil
  //dan -1 jika gagal
}
