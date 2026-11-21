<?php
    session_start();
    require "../connection/permission_expert.php";
    require "../connection/database.php";

    $IDtopic = $_GET['id_topic'];
    $id_user = $_SESSION['id_user'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_reply"])){
        $reply = $_POST['reply'];

        $sql = "INSERT INTO replys (reply, id_topic, id_user) 
                VALUES (:reply, :id_topic, :id_user)";
                
        $query = $dbc -> prepare($sql); 
        $query->bindValue(":reply", $reply);
        $query->bindValue(":id_topic", $IDtopic);
        $query->bindValue(":id_user", $id_user);
        $query->execute();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_reply"])){
        $new_reply = $_POST["new_reply"];
        $id_reply = $_POST["id_reply"];

        $update_sql = "UPDATE replys SET reply = :new_reply 
                WHERE id_topic = :id_topic 
                AND id_user = :id_user
                AND id_reply = :id_reply";
        $update = $dbc -> prepare($update_sql);
        $update -> bindValue(":new_reply", $new_reply);
        $update -> bindValue(":id_topic", $IDtopic);
        $update -> bindValue(":id_reply", $id_reply);
        $update -> bindValue(":id_user", $id_user);
        $update -> execute();
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
    // var_dump($user);
    // exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topic</title>
</head>
<body>
    <p><a href="./dashboard_expert.php">Kembali ke Dashboard</a></p>

    <p><?= $user[0]["topic"] ?></p>
    
    <form action="reply.php?id_topic=<?= $IDtopic ?>" method="POST">
        <label>Penjelasan / Jawaban Anda Sebagai Expert</label><br>
        <textarea name="reply" placeholder="Tulis balasan..."></textarea>
        <input type="submit" name="submit_reply" value="kirim">
    </form>
    <?php foreach($user as $row): ?>
        <!-- Ubah $user menjadi $row (variabel perulangan) -->
        <?php if(!empty($row['id_reply'])): ?>
            <?php if($row['id_user'] == $_SESSION['id_user']): ?>
                <!-- Isi string kosong dengan 'reply' -->
                 <span><?= $row['username']?></span>
                 <span>Balasan Anda</span>
                <form action="reply.php?id_topic=<?= $IDtopic ?>" method="POST">
                    <input type="hidden" name="id_reply" value="<?= htmlspecialchars($row['id_reply']) ?>">
                    <textarea name="new_reply"><?= htmlspecialchars($row["reply"]) ?></textarea>
                    <input type="submit" name="edit_reply" value="edit">
                </form>
            <?php else: ?>
                <!-- Isi string kosong dengan 'reply' -->
                 <span><?= $row['username']?></span>
                <p><?= htmlspecialchars($row['reply']) ?></p>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</body>
</html>