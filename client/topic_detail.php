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
            topics.id_topic,
            topics.id_user,
            topics.topic,
            users.username AS username_topic,
            replys.id_user AS id_user_reply,
            replys.reply,
            replys.id_reply,
            users_reply.username AS username_reply,
            categories.kategori
        FROM topics
        LEFT JOIN users ON topics.id_user = users.id_user
        LEFT JOIN replys ON topics.id_topic = replys.id_topic
        LEFT JOIN users AS users_reply ON replys.id_user = users_reply.id_user
        LEFT JOIN categories ON categories.id_kategori = topics.id_kategori
        WHERE topics.id_topic = :topic";

    $query = $dbc -> prepare($sql); 
    $query->bindValue(":topic", $IDtopic);
    $query->execute();
    
    $user = $query->fetchAll();
    // var_dump($user);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Detail Topic</title>
</head>
<body>
    <div class="container">
        <!-- header -->
        <?php require "../component/header.php";?>

        <!-- content -->
        <div class="content">
            <!-- navigasi -->
            <div class="box_tengah_topik">
                <a href="./dashboard_client.php">kembali ke Halaman utama</a>

                <!-- mengecek apakah topik yang ada di halmaan milik user yang ada di session -->
                <?php if($user[0]['id_user'] == $_SESSION['id_user']): ?>
                    <!-- jika iya, bisa ngedit topik -->
                    <form action="topic_detail.php?id_topic=<?= $IDtopic ?>" method="POST" class="box">
                        <span class="box_hijau">TOPIC Anda</span>
                        <small class="box_pinkmuda"><?= htmlspecialchars($user[0]["kategori"]) ?> </small><br>
                        <small >@<?= htmlspecialchars($user[0]["username_topic"]) ?> </small><br>
                        <textarea name="new_topic"><?= htmlspecialchars($user[0]["topic"]) ?></textarea>
                        <button type="submit" name="edit_topic">edit</button>
                    </form>
                <?php else: ?>
                    <!-- jika tidak, ga bisa edit topik -->
                    <div class="box">
                        <span class="box_hijau">TOPIC</span>
                        <small class="box_pinkmuda"><?= htmlspecialchars($user[0]["kategori"]) ?> </small><br>
                        <small>@<?= htmlspecialchars($user[0]["username_topic"]) ?> </small><br>
                        <h2><?= htmlspecialchars($user[0]["topic"]) ?></h2>
                    </div>
                <?php endif; ?>

                <!-- jawaban dari pakar -->
                <p><b>Jawaban dari pakar</b></p>
                <?php foreach($user as $row): ?>
                    <div class="box">
                        <small>@<?= htmlspecialchars($row["username_reply"]) ?> </small><br>
                        <?= htmlspecialchars($row['reply']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- footer -->
         <?php require "../component/footer.php";?>
    </div>   
</body>
</html>