<?php
    require "validasi.php";
    $errors = [];

    if($_SERVER["REQUEST_METHOD"] === "POST" ){
        $username = $_POST['username'];
        $password =  $_POST['password'];
        $tanggal_lahir = $_POST['tanggal_lahir'];

        valUsername($errors, $username);
        valPassword($errors, $password);
        tanggalLahir($errors, $tanggal_lahir);

        if(empty($errors)){
            echo "anjay";
        }
    }

    var_dump($errors);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Registrasi</h2>

    <form method="POST" action="">
        <label>Username</label><br>
        <input type="text" name="username" value="<?= isset($errors['username']) && isset($_POST['username'])? $_POST['username']:""?>">
        <span style="color:red"><?=$errors['username']??""?></span>

        <label>Password</label><br>
        <input type="password" name="password" value="<?= isset($errors['password']) && isset($_POST['password'])? $_POST['password']:""?>">>
        <span style="color:red"><?=$errors['username']??""?></span>

        <label>Tanggal Lahir</label><br>
        <input type="date" name="tanggal_lahir" value="<?= isset($errors['tanggal_lahir']) && isset($_POST['tanggal_lahir'])? $_POST['tanggal_lahir']:""?>">>
        <span style="color:red"><?=$errors['tanggal Lahir']??""?></span>

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="register.php">Daftar</a></p>
</body>
</html>