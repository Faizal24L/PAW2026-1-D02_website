<?php
    session_start();
    require "../connection/permission_expert.php";
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
</body>
</html>