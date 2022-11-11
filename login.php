<?php
//mengembalikan ke index jika sudah login jika belum login
//$_SESSION adalah mekanisme penyimpanan informasi kedalam variabel agar
// $_SESSION['login'] = true;
//bisa digunakan lebih dari satu halaman
session_start();

//cek cookei login
if (isset($_COOKIE['login'])) {
    //cek value
    if ($_COOKIE['login'] == 'true') {
        //set session true
        $_SESSION['login'] = true;
    }
}
//kalo ada $_SESSION['login'] / kalo sudah login maka kembalikan ke index
//jika ada session[login]
if (isset($_SESSION["login"])) {
    echo '<script>window.location="index.php"</script>';
}
require 'funcition.php';

if (isset($_POST["login"])) {
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    //cek akun ada apa tidak
    $cek = mysqli_query($conn, "SELECT * FROM user WHERE username = '" . $user . "' AND password = '" . $password . "'");
    //cek validasi login
    if (mysqli_num_rows($cek) > 0) {
        mysqli_fetch_object($cek);
        //set session
        $_SESSION['login'] = true;

        //cek remember me
        if (isset($_POST['remember'])) {
            //buat cookei
            setcookie('login', 'true', time() + 345600); //waktu 4 hari
        }
        //$_COOKEI sendiri untuk menyimpan data user untuk beberapa waktu
        //ada waktu kadarulasa

        echo '<script>alert("Login Berhasil")</script>';
        echo '<script>window.location ="index.php"</script>';
    } else {
        echo '<script>alert("Gagal, username atau password salah")</script>';
    }
}
//untuk password_verify,password_hash
// session_start();
// require 'funcition.php';

// if (isset($_POST["login"])) {

//     $username = mysqli_real_escape_string($conn, $_POST['user']);
//     $password = mysqli_real_escape_string($conn, $_POST['pass']);
//     //cek akun ada apa tidak
//     $result = mysqli_query($conn, "SELECT * FROM user WHERE 
//     username = '$username'");
//     //cek username
//     if (mysqli_num_rows($result) == 1) {

//         //cek password
//         $row = mysqli_fetch_assoc($result);
//         if (password_verify($password, $row["password"])) {
//             $_SESSION['login'] = true;
//             echo '<script>window.location ="index.php"</script>';
//             echo '<script>alert("login Berhasil")</script>';
//             exit;
//         }
//     }
// }
// if (isset($error)) {
//     echo '<script>alert("Gagal, username atau password salah")</script>';
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    <!---Page Login --->
    <div class="page-login">

        <!---Box-->
        <div class="box box-login">
            <!--box header--->
            <div class="box-header text-center">
                L O G I N
            </div>
            <!---Box body--->
            <div class="box-body">
                <!---form login-->
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="user" placeholder="Username" class="input-kontrol">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="Password" name="pass" placeholder="Password" class="input-kontrol">
                    </div>
                    <div class="remember">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember Me</label>
                    </div>

                    <input type="submit" name="login" value="Login" class="btn">
                    <div class="form-group">
                        <p class="register">Belum punya akun? <a href="form-registrasi.php">Daftar</a></p>
                    </div>
                </form>



            </div>
            <!---box footer--->
            <div class="box-footer text-center">
                <a href="index.php">halaman utama</a>
            </div>
        </div>
    </div>
</body>

</html>