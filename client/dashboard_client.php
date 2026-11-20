<?php
    session_start();
    require "../connection/permission_client.php";
    require "../connection/database.php";

    $id_user = $_SESSION["id_user"];

    require "../connection/dbdata.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php require "../connection/dbview.php";?>

    <!-- ke Halaman Logout -->
    <p><a href="../authentication/logout.php">LOGOUT</a></p>
</body>
</html>