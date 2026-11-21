<?php
    session_start();
    require "../connection/permission_client.php";
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
        header("location:./dashboard_client.php");
    }



    $sql = "SELECT 
                topics.topic,
                replys.id_user,
                replys.reply,
                replys.id_reply,
                users.username,
                categories.kategori
            FROM topics LEFT JOIN replys ON topics.id_topic = replys.id_topic
            LEFT JOIN users ON replys.id_user = users.id_user
            LEFT JOIN categories ON categories.id_kategori = topics.id_kategori
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

    <?php if($user[0]['id_user'] == $_SESSION['id_user']): ?>
            <h2>topic</h2>
            <form action="topic_detail.php?id_topic=<?= $IDtopic ?>" method="POST">
                <textarea name="new_topic"><?= htmlspecialchars($user[0]["topic"]) ?></textarea>
                <input type="submit" name="edit_topic" value="edit">
            </form>
        <?php else: ?>
            <div>
                <?= $user[0]["kategori"] ?> <br>
                <?= $user[0]["username"] ?> <br>
                <?= $user[0]["topic"] ?>
            </div>
            <h2><?= htmlspecialchars($user[0]["topic"]) ?></h2>
    <?php endif; ?>
    <h2>Balasan</h2>
    <?php foreach($user as $row): ?>
            <p><?= htmlspecialchars($row['reply']) ?></p>
    <?php endforeach; ?>
    <a href="./dashboard_client.php">kembali</a>
    
</body>
</html>