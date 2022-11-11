<?php
session_start();
if (isset($_SESSION["login"])) {
    echo '<script>window.location="index.php"</script>';
}
require 'funcition.php';
if (isset($_POST['register'])) {
    if (registrasi($_POST) > 0) {
        echo '<script>alert("Registrasi Berhasil")</script>';
        echo '<script>window.location ="login.php"</script>';
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
                R E G I S T R A S I
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
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="Password" name="pass2" placeholder="Konfirmasi Password" class="input-kontrol">
                    </div>

                    <input type="submit" name="register" value="Registrasi" class="btn-register">
                </form>



            </div>
            <!----box footer--->
            <div class="box-footer text-center">
                <a href="index.php">halaman utama</a>
            </div>
        </div>
    </div>
</body>

</html>