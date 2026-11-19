<?php
    session_start();
    require "../connection/permission_expert.php";
    require "../connection/database.php";

    $id_user = $_SESSION["id_user"];
    $id_role = $_SESSION["id_role"];
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
    <p>NAMA: <?= htmlspecialchars($user["username"])?></p>
    <p>NOMOR TELEPON: <?= htmlspecialchars($user["telepon"])?></p>
    <p>TANGGAL LAHIR: <?= htmlspecialchars($user["tanggal_lahir"])?></p>
    <a href="./edit_profile.php?id_role=<?= $id_role ?>">kelola profile</a>
    
    <?php if ($id_role == 2):?>
        <a href="../expert/dashboard_expert.php">kembali</a>
    <?php else:?>
        <a href="../client/dashboard_client.php">dashboard</a>
    <?php endif;?>
</body>
</html>