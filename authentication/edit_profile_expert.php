<?php
    require "../connection/permission_expert.php";
    require "../connection/database.php";
    $id_user = $_SESSION["id_user"];

    $sql_s = "SELECT username, telepon, tanggal_lahir FROM users WHERE id_user = :id_user";
    $query_s = $dbc -> prepare($sql_s);
    $query_s -> bindValue(":id_user", $id_user);
    $query_s -> execute();
    $user = $query_s -> fetch();

    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['kirim'])){
        $new_username = $_POST['new_username'];
        $new_telepon = $_POST['new_telepon'];
        $new_tanggal_lahir = $_POST["new_tanggal_lahir"];
        $new_password = $_POST["new_password"];

        $sql = "UPDATE users SET username = :new_username , telepon = :new_telepon, tanggal_lahir = :new_tanggal_lahir, password = SHA2(:new_password, 256) WHERE id_user = :id_user";
        $query = $dbc -> prepare($sql); 
        $query->bindValue(":new_username", $new_username);
        $query->bindValue(":id_user", $id_user);
        $query->bindValue(":new_telepon", $new_telepon);
        $query->bindValue(":new_tanggal_lahir", $new_tanggal_lahir);
        $query->bindValue(":new_password", $new_password);
        $query->execute();
        
        header("Location:./profile_expert.php");
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
    <form method="POST" action="edit_profile_expert.php">
        <label>USER NAME: </label>
        <input type="text" name="new_username" value="<?= htmlspecialchars($user["username"]) ?>"><br>
        <label>TELEPON: </label>
        <input type="text" name="new_telepon" value="<?= htmlspecialchars($user["telepon"]) ?>"><br>
        <label>TANGGAL LAHIR: </label>
        <input type="date" name="new_tanggal_lahir" value="<?= htmlspecialchars($user["tanggal_lahir"]) ?>"><br>
        <label>PASSWORD: </label>
        <input type="password" name="new_password">
        <input type="submit" name="kirim">
        <br>
        <a href="./profile_expert.php">profile</a>

    </form>
</body>
</html>