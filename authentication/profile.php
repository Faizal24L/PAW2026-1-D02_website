<?php
    session_start();
    $id_role = $_SESSION["id_role"];
    require "../connection/database.php";
    if ($id_role == 1){
        require "../connection/permission_client.php";
    } else {
        require "../connection/permission_expert.php";
    }

    $id_user = $_SESSION["id_user"];
    
    $sql = "SELECT username, telepon, tanggal_lahir FROM users WHERE id_user = :id_user";
    $query = $dbc -> prepare($sql);
    $query -> bindValue(":id_user", $id_user);
    $query->execute();
    
    $user = $query->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
</head>
<body>
    <?php if ($id_role == 2):?>
        <a href="../expert/dashboard_expert.php">DASHBOAR</a>
    <?php else:?>
        <a href="../client/dashboard_client.php">DASHBOARD</a>
    <?php endif;?>
    <p>PROFILE</p>
    <h1><?= htmlspecialchars($user["username"])?></h1>
    <?php if($_SESSION["id_role"] == 1):?>
        <span>Client / Pelajar</span>
    <?php else:?>
        <span>Expert / Pakar</span>
    <?php endif?>
    <div>NAMA: <?= htmlspecialchars($user["username"])?></div>
    <div>NOMOR TELEPON: <?= htmlspecialchars($user["telepon"])?></div>
    <div>TANGGAL LAHIR: <?= htmlspecialchars($user["tanggal_lahir"])?></div>
    <a href="./edit_profile.php?id_role=<?= $id_role ?>">kelola profile</a>
</body>
</html>