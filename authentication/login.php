<?php
    require "validasi.php";
    $errors = [];

    if($_SERVER["REQUEST_METHOD"] === "POST" ){
        $username = $_POST['username'];
        $password =  $_POST['password'];

        valUsername($errors, $username);
        valPassword($errors, $password);

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
    <h2>Login</h2>

    <form method="POST" action="login.php">
        <label>Username</label><br>
        <input type="text" name="username" value="<?= isset($errors['username']) && isset($_POST['username'])? $_POST['username']:""?>">
        <span style="color:red"><?=$errors['username']??""?></span>

        <br><label>Password</label><br>
        <input type="password" name="password" value="<?= isset($errors['password']) && isset($_POST['password'])? $_POST['password']:""?>">
        <span style="color:red"><?=$errors['password']??""?></span>

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="register.php">Daftar</a></p>
</body>
</html>