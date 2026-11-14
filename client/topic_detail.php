<?php
    require "../connection/permission.php";
    echo "berjalan";
    require "../connection/database.php";

    $topic = $_GET['id_topic'];

    $sql = "SELECT topics.topic, replys.reply, topics.id_user
        FROM topics LEFT JOIN replys 
        on topics.id_topic = replys.id_topic
        WHERE topics.id_topic = :topic";

    $query = $dbc -> prepare($sql); 
    $query->bindValue(":topic", $topic);
    $query->execute();
    
    $user = $query->fetchAll();
    var_dump($user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topic</title>
</head>
<body>
    <h1>topic dan balasannya</h1>
    <?php foreach($user as $row): ?>
        
        <!-- Ubah $user menjadi $row (variabel perulangan) -->
        <?php if($row['id_user'] == $_SESSION['id_user']): ?>
            <h2><?= $row["topic"] ?></h2>
            <?= "edit" ?>
            <!-- Isi string kosong dengan 'reply' -->
            <p><?= $row['reply'] ?></p>
        <?php else: ?>
            <h2><?= $row["topic"] ?></h2>
            
            <!-- Isi string kosong dengan 'reply' -->
            <p><?= $row['reply'] ?></p>
        <?php endif; ?>
        
    <?php endforeach; ?>
    
</body>
</html>