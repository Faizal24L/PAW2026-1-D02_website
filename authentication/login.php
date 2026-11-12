<?php
    require "validasi.php";
    $errors = [];

    if($_SERVER["REQUEST_METHOD"] === "POST" ){
        $username = $_POST['username'];
        $password =  $_POST['password'];

        valUsername($errors, $username);
        valPassword($errors, $password);

        if(empty($errors)){
            require "../connection/database.php";

            $hashedInputPassword = hash('sha256', $password);

            $sql = "SELECT username, password, id_role FROM users WHERE username = :username AND password = :password";
            $query = $dbc -> prepare($sql);

            $query->bindValue(":username", $username);
            $query->bindValue(":password", $hashedInputPassword);

            $query->execute();
            
            $user = $query->fetch();

            session_start();
            var_dump($user);
            if ($user && $hashedInputPassword){
                if ($user["id_role"] == 2){
                    $_SESSION["isExpert"] = true;
                    header("Location: /PAW2026-1-D02_website/expert/dashboard_expert.php");
                    exit();
                }else{
                    $_SESSION["isClient"] = true;
                    header("Location: ../client/dashboard_client.php");
                    exit();
                }
            } else {
                $error = "Password atau Username salah";
            }
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

    <span><?=$error??""?></span>

    <p>Belum punya akun? <a href="register.php">Daftar</a></p>
</body>
</html>