<?php
    session_start();
    // koneksi
    require "../connection/permission_expert.php";
    require "../connection/database.php";
    require "../authentication/validasi.php";

    $IDtopic = $_GET['id_topic'];
    $id_user = $_SESSION['id_user'];

    $errors = [];

    // berjalan jika expert mengirim reply topik
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_reply"])){
        $reply = $_POST['reply'];

        valReply($errors, $reply);

        if (empty($errors)){
            $sql = "INSERT INTO replys (reply, id_topic, id_user) 
                    VALUES (:reply, :id_topic, :id_user)";
                    
            $query = $dbc -> prepare($sql); 
            $query->bindValue(":reply", $reply);
            $query->bindValue(":id_topic", $IDtopic);
            $query->bindValue(":id_user", $id_user);
            $query->execute();

            header("Location: dashboard_expert.php");
        }
    }

    // berjalan jika expert mengirim editan dari reply
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

        header("Location: dashboard_expert.php");
    }


    // menampilkan topik yang di klik sebelumnya
    $sql = "SELECT 
                topics.topic,
                user_topic.username AS username_topic,
                replys.id_user,
                replys.reply,
                replys.id_reply,
                users.username AS username_reply,
                categories.kategori
            FROM topics LEFT JOIN replys ON topics.id_topic = replys.id_topic
            LEFT JOIN users ON replys.id_user = users.id_user
            LEFT JOIN users AS user_topic ON topics.id_user = user_topic.id_user
            LEFT JOIN categories ON categories.id_kategori = topics.id_kategori
            WHERE topics.id_topic = :topic";

    $query = $dbc -> prepare($sql); 
    $query->bindValue(":topic", $IDtopic);
    $query->execute();
    
    $user = $query->fetchAll();
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
    <!-- header -->
    <?php require "../component/header.php";?>

    <!-- content -->
    <div class="content">
        <!-- navigasi -->
        <div class="box_tengah_reply">
            <a href="./dashboard_expert.php">kembali ke Halaman utama</a>

            <!-- bagian penampilan topik -->
            <div class="box">
                <span class="box_hijau">TOPIC</span>
                <small class="box_pinkmuda"><?= $user[0]["kategori"] ?> </small><br>
                <small><?= $user[0]["username_topic"] ?> </small><br>
                <h1 class="box"><?= $user[0]["topic"] ?></h1>
            </div>

            <!-- form buat membalas topik -->
            <div class="box">
                <form action="reply.php?id_topic=<?= $IDtopic ?>" method="POST">
                    <label>Penjelasan / Jawaban Anda Sebagai Expert</label><br>
                    <textarea name="reply" placeholder="Tulis balasan..."></textarea>
                    <span class="error"><?=$errors['reply']??""?></span><br>
                    <button type="submit" name="submit_reply">Kirim</button>
                </form>
            </div>

            <!-- bagian jawaban jawaban expert -->
            <p><b>Jawaban dari pakar</b></p>
            <?php foreach($user as $row): ?>
                <!-- Ubah $user menjadi $row (variabel perulangan) -->
                <?php if(!empty($row['id_reply'])): ?>
                    <!-- jika reply punya user yanga ada di session, bisa ngedit -->
                    <?php if($row['id_user'] == $_SESSION['id_user']): ?>
                        <div class="box">
                            <!-- Isi string kosong dengan 'reply' -->
                            <span><?= $row['username_reply']?></span>
                            <span>Balasan Anda</span>
                            <form action="reply.php?id_topic=<?= $IDtopic ?>" method="POST">
                                <input type="hidden" name="id_reply" value="<?= htmlspecialchars($row['id_reply']) ?>">
                                <textarea name="new_reply"><?= htmlspecialchars($row["reply"]) ?></textarea>
                                <button type="submit" name="edit_reply">Edit</button>
                            </form>
                        </div>

                    <!-- jika reply bukan punya user di session -->
                    <?php else: ?>
                        <!-- Isi string kosong dengan 'reply' -->
                        <div class="box">
                            <span><?= $row['username_reply']?></span>
                            <p><?= htmlspecialchars($row['reply']) ?></p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
        
    <!-- footer -->
    <?php require "../component/footer.php";?>
</body>
</html>