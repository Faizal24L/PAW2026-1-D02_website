<?php
    session_start();
    $id_user = $_SESSION["id_user"];
    $id_role = $_SESSION["id_role"];
    var_dump($id_user);
    var_dump($id_role);

    require "../connection/database.php";
    if ($id_role == 1){
        require "../connection/permission_client.php";
    } else {
        require "../connection/permission_expert.php";
    }
    
    // echo $id_role;
    $sql_s = "SELECT username, telepon, tanggal_lahir FROM users WHERE id_user = :id_user";
    $query_s = $dbc -> prepare($sql_s);
    $query_s -> bindValue(":id_user", $id_user);
    $query_s -> execute();
    $user = $query_s -> fetch();

    require "validasi.php";
    $errors = [];
    
    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['kirim'])){
        $new_username = $_POST['new_username'];
        $new_telepon = $_POST['new_telepon'];
        $new_tanggal_lahir = $_POST["new_tanggal_lahir"];
        $new_password = $_POST["new_password"];

        valUsername($errors, $new_username);
        valPassword($errors, $new_password);
        valNomor($errors, $new_telepon);
        tanggalLahir($errors, $new_tanggal_lahir);
        // die(var_dump($errors));
        if(empty($errors)){
            $sql = "UPDATE users SET username = :new_username , telepon = :new_telepon, tanggal_lahir = :new_tanggal_lahir, password = SHA2(:new_password, 256) WHERE id_user = :id_user";
            $query = $dbc -> prepare($sql); 
            $query->bindValue(":new_username", $new_username);
            $query->bindValue(":id_user", $id_user);
            $query->bindValue(":new_telepon", $new_telepon);
            $query->bindValue(":new_tanggal_lahir", $new_tanggal_lahir);
            $query->bindValue(":new_password", $new_password);
            $query->execute();
            
            header("Location:./profile.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Profile</title>
</head>
<body>
    <h1>KELOLA PROFILE</h1>
    <form method="POST" action="edit_profile.php">
        <label>USER NAME: </label>
        <input type="text" name="new_username" value="<?= htmlspecialchars($user['username'])?>">
        <span style="color:red"><?=$errors['username']??""?></span><br>

        <label>TELEPON: </label>
        <input type="text" name="new_telepon" value="<?= htmlspecialchars($user['telepon'])?>">
        <span style="color:red"><?=$errors['nomor']??""?></span><br>

        <label>TANGGAL LAHIR: </label>
        <input type="date" name="new_tanggal_lahir" value="<?= htmlspecialchars($user['tanggal_lahir'])?>">
        <span style="color:red"><?=$errors['tanggal_lahir']??""?></span><br>

        <label>PASSWORD: </label>
        <input type="password" name="new_password" value="">
        <span style="color:red"><?=$errors['password']??""?></span><br>

        <input type="submit" name="kirim" value="kirim">
    </form>

    <a href="./profile.php">batal</a>

</html>