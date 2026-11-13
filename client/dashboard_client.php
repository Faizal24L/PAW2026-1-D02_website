<?php
    require "../connection/permission.php";
    echo "berjalan";
    require "../connection/database.php";

    $sql = "SELECT id_topic, topic FROM topics ORDER BY id_topic DESC";
    $query = $dbc -> prepare($sql); 
    $query->execute();
    
    $user = $query->fetchAll();
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
    <div><a href="./topic_detail.php ?= id_topic=$topic['id_topic']"><?= $topic['topic']?></a></div>
    <?php endforeach;?>
</body>
</html>