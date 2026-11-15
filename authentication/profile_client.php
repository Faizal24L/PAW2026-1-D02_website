<?php
    require "../connection/permission.php";
    require "../connection/database.php";

    $id_user = $_SESSION["id_user"];
    $sql = "SELECT username, telepon, tanggal_lahir FROM users WHERE id_user = :id_user";
    $query = $dbc -> prepare($sql);
    $query -> bindValue(":id_user", $id_user);
    $query->execute();
    
    $user = $query->fetch();
    var_dump($user);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
</head>
<body>
    <h1>PROFILE</h1>
    <p><?= $user["username"]?></p>
    <p><?= $user["telepon"]?></p>
    <p><?= $user["tanggal_lahir"]?></p>
    <a href="./edit_profile_client.php">kelola profile</a>
    <a href="../client/dashboard_client.php">kembali</a>
</body>
</html>