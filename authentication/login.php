<?php
    require "validasi.php";
    $errors = [];

    if($_SERVER("REQUET_METHOD") == "POST" ){
        $username = $_POST['$username'];
        $password =  $_POST['$password '];

        valUsername($errors, $username);
        valPassword($errors, $password);

        if(empty($errors)){
            echo "anjay";
        }
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <form method="POST" action="login.php">
        <label>Username</label><br>
        <input type="text" name="username">
        <br><br>

        <label>Password</label><br>
        <input type="password" name="password">
        <br><br>

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="register.php">Daftar</a></p>
</body>
</html>