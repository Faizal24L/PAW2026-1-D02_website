<?php
    require "validasi.php";
    $errors = [];

    if($_SERVER["REQUEST_METHOD"] === "POST" ){
        $username = $_POST['username'];
        $password =  $_POST['password'];
        $nomor =  $_POST['nomor'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $id_role = $_POST["id_role"];

        valUsername($errors, $username);
        valPassword($errors, $password);
        valNomor($errors, $nomor);
        tanggalLahir($errors, $tanggal_lahir);

        if(empty($errors)){
            require "../connection/database.php";

            $sql = "INSERT INTO users (id_role, username, password, telepon, tanggal_lahir) VALUES
                      (:id_role, :username, SHA2(:password, 256), :telepon, :tanggal_lahir)";

            $query = $dbc -> prepare($sql);

            $query->bindValue(":username", $username);
            $query->bindValue(":password", $password);
            $query->bindValue(":telepon", $nomor);
            $query->bindValue(":tanggal_lahir", $tanggal_lahir);
            $query->bindValue(":id_role", $id_role);

            $query->execute();

            
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

        <br><label>Password</label><br>
        <input type="text" name="password" value="<?= isset($errors['password']) && isset($_POST['password'])? $_POST['password']:""?>">
        <span style="color:red"><?=$errors['password']??""?></span>

        <br><label>npmer Telepon</label><br>
        <input type="text" name="nomor" value="<?= isset($errors['nomor']) && isset($_POST['nomor'])? $_POST['nomor']:""?>">
        <span style="color:red"><?=$errors['nomor']??""?></span>

        <br><label>Tanggal Lahir</label><br>
        <input type="date" name="tanggal_lahir" value="<?= isset($errors['tanggal_lahir']) && isset($_POST['tanggal_lahir'])? $_POST['tanggal_lahir']:""?>">
        <span style="color:red"><?=$errors['tanggal Lahir']??""?></span>

        <br>
        <label for="id_role">Pilih Role:</label>
        <select name="id_role">
            <option value="1">User</option>
            <option value="2">Pakar</option>
        </select>

        <br><button type="submit">Login</button>
    </form>
</body>
</html>