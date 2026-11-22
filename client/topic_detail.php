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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Topic</title>
</head>
<body>
    <div class="container">
        <!-- header -->
        <?php require "../component/header.php";?>

        <!-- content -->
        <div class="content">
            <div class="box_tengah">
                <a href="./dashboard_client.php"><< kembali ke Halaman utama</a>
                <?php if($user[0]['id_user'] == $_SESSION['id_user']): ?>
                    <div class="box">
                        <h2>topic</h2>
                        <form action="topic_detail.php?id_topic=<?= $IDtopic ?>" method="POST">
                            <textarea name="new_topic"><?= htmlspecialchars($user[0]["topic"]) ?></textarea>
                            <button type="submit" name="edit_topic">edit</button>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="box">
                        <small class="box_pinkmuda"><?= $user[0]["kategori"] ?> </small><br>
                        <small><?= $user[0]["username"] ?> </small><br>
                        <h2><?= htmlspecialchars($user[0]["topic"]) ?></h2>
                    </div>
                <?php endif; ?>
                <p><b>Jawaban dari pakar</b></p>
                <?php foreach($user as $row): ?>
                    <div class="box"><?= htmlspecialchars($row['reply']) ?></div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- footer -->
         <?php require "../component/footer.php";?>
    </div>   
</body>
</html>