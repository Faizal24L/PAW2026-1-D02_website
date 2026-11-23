<?php
    session_start();
    require "../connection/permission_expert.php";
    require "../connection/database.php";

    $id_user = $_SESSION["id_user"];
    $id_role = $_SESSION["id_role"];

    require "../connection/dbdata.php";
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <!-- header -->
        <?php require "../component/header.php";?>
        
        <!-- content -->
        <?php require "../connection/dbview.php";?>

        <!-- footer -->
        <?php require "../component/footer.php";?>
    </div>
</body>
</html>