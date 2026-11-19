<?php
    session_start();
    $id_user = $_SESSION["id_user"];
    $id_role = $_SESSION["id_role"];

    require "../connection/database.php";
    if ($id_role == 1){
        require "../connection/permission_client.php";
    } else {
        require "../connection/permission_expert.php";
    }

    
    echo $id_role;

    
    // echo $id_role;

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
        
        if ($id_role == 1){
            header("Location:./profile_client.php");
            exit();
        } else {
            header("Location:./profile_expert.php");
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
        <input type="text" name="new_username" value="<?= htmlspecialchars($user["username"]) ?>"><br>
        <label>TELEPON: </label>
        <input type="text" name="new_telepon" value="<?= htmlspecialchars($user["telepon"]) ?>"><br>
        <label>TANGGAL LAHIR: </label>
        <input type="date" name="new_tanggal_lahir" value="<?= htmlspecialchars($user["tanggal_lahir"]) ?>"><br>
        <label>PASSWORD: </label>
        <input type="password" name="new_password">
        <input type="submit" name="kirim" value="kirim">
    </form>
    <?php if ($id_role == 1):?>
        <a href="./profile_client.php">batal</a>
    <?php else:?>
        <a href="./profile_expert.php">batal</a>
    <?php endif;?>
</body>
</html>