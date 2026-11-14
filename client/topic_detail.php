<?php
    require "../connection/permission.php";
    echo "berjalan";
    require "../connection/database.php";

    $IDtopic = $_GET['id_topic'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_topic"])){
        $new_topic = $_POST["new_topic"];
        $id_topic = $IDtopic;
        $id_user = $_SESSION["id_user"];

        $update_sql = "UPDATE topics SET topic = :new_topic WHERE id_topic = :id_topic AND id_user = :id_user";
        $update = $dbc -> prepare($update_sql);
        $update -> bindValue(":new_topic", $new_topic);
        $update -> bindValue(":id_topic", $id_topic);
        $update -> bindValue(":id_user", $id_user);
        $update -> execute();
    }



    $sql = "SELECT topics.topic, replys.reply, topics.id_user
        FROM topics LEFT JOIN replys 
        on topics.id_topic = replys.id_topic
        WHERE topics.id_topic = :topic";

    $query = $dbc -> prepare($sql); 
    $query->bindValue(":topic", $IDtopic);
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
            <form action="topic_detail.php?id_topic=<?= $IDtopic ?>" method="POST">
                <textarea name="new_topic"><?= $row["topic"] ?></textarea>
                <input type="submit" name="edit_topic" value="edit">
            </form>
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