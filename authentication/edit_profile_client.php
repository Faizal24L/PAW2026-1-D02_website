<?php
    require "../connection/permission.php";
    require "../connection/database.php";
    $id_user = $_SESSION["id_user"];
    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['kirim'])){
        $new_username = $_POST['new_username'];
        $new_telepon = $_POST['new_telepon'];
        $new_tanggal_lahir = $_POST["new_tanggal_lahir"];

        $sql = "UPDATE users SET username = :new_username , telepon = :new_telepon, tanggal_lahir = :new_tanggal_lahir WHERE id_user = :id_user";
        $query = $dbc -> prepare($sql); 
        $query->bindValue(":new_username", $new_username);
        $query->bindValue(":id_user", $id_user);
        $query->bindValue(":new_telepon", $new_telepon);
        $query->bindValue(":new_tanggal_lahir", $new_tanggal_lahir);
        $query->execute();
        
        header("Location:./profile_client.php");
        exit();
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
    <form method="POST" action="">
        <label for="new_username">USER NAME: </label>
        <input type="text" name="new_username"><br>
        <label for="new_telepon">TELEPON: </label>
        <input type="text" name="new_telepon"><br>
        <label for="new_tanggal_lahir">TANGGAL LAHIR: </label>
        <input type="date" name="new_tanggal_lahir"><br>
        <input type="submit" name="kirim">

    </form>
</body>
</html>