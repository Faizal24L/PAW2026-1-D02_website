<?php
    require "../connection/permission.php";
    require "../connection/database.php";

    $id_user = $_SESSION["id_user"];
    $sql = "SELECT id_topic, topic, id_user FROM topics ORDER BY id_topic DESC";
    $query = $dbc -> prepare($sql);
    $query->execute();
    
    $user = $query->fetchAll();
    // var_dump($user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <a href="../authentication/profile_client.php">PROFILE</a>
    <p>ini topic saya</p>
    <?php foreach($user as $topic):?>
        <?php if ($topic['id_user'] == $id_user):?>
            <div><a href="./topic_detail.php?id_topic=<?=$topic['id_topic']?>"><?= $topic['topic']?></a></div>
        <?php endif;?>
        
    <?php endforeach;?>
    <p>ini topic keseluruhan</p>
    <?php foreach($user as $topic):?>
        <div><a href="./topic_detail.php?id_topic=<?=$topic['id_topic']?>"><?= $topic['topic']?></a></div>
    <?php endforeach;?>

    <a href="create_topik.php?id_user=<?=$id_user?>">buat topik</a>
    <p><a href="../authentication/logout.php">LOGOUT</a></p>
</body>
</html>