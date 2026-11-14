<?php
    require "../connection/permission.php";
    echo "berjalan";
    require "../connection/database.php";
    $id_user = $_SESSION["id_user"];
    $sql = "SELECT id_topic, topic FROM topics ORDER BY id_topic DESC";
    $query = $dbc -> prepare($sql);
    $query->execute();
    
    $user = $query->fetchAll();
    var_dump($user);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php foreach($user as $topic):?>
    <div><a href="./topic_detail.php?id_topic=<?=$topic['id_topic']?>"><?= $topic['topic']?></a></div>
    <?php endforeach;?>
    <a href="create_topik.php?id_user=<?=$id_user?>">buat topik</a>
    <p><a href="../authentication/logout.php">LOGOUT</a></p>
</body>
</html>