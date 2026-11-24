<?php
    require "./connection/database.php";
    $header = "index";

    //ambil daftar kategori
    $sql_kat = "SELECT id_kategori, kategori FROM categories ORDER by id_kategori ASC";
    $query_kat = $dbc -> prepare($sql_kat);
    $query_kat->execute();
    $kategori = $query_kat->fetchAll();

    //mengecek jika user memilih kategori
    if(isset($_GET['kategori']) && $_GET['kategori'] !== ""){
        $id_kategori = $_GET['kategori'];
        //tampilkan topik sesuai kategori
        $sql_topik = "SELECT topics.id_topic, topics.id_user, topics.topic, categories.kategori, users.username
                FROM topics LEFT JOIN categories ON topics.id_kategori = categories.id_kategori
                WHERE topics.id_kategori = :id_kategori
                LEFT JOIN users ON topics.id_user = users.id_user
                ORDER BY topics.id_topic DESC";
        $query_topik =$dbc -> prepare($sql_topik);
        $query_topik -> bindValue(":id_kategori", $id_kategori);
        $query_topik->execute();
    }else {
        // Tampilkan semua topik 
        $sql_topic = "SELECT topics.id_topic, topics.id_user, topics.topic, categories.kategori, users.username
                    FROM topics LEFT JOIN categories ON topics.id_kategori = categories.id_kategori
                    LEFT JOIN users ON topics.id_user = users.id_user
                    ORDER BY topics.id_topic DESC";
        $query_topik = $dbc->prepare($sql_topic);
        $query_topik->execute();
    }
    $topik = $query_topik->fetchAll();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <!-- header -->
        <?php require "./component/header.php"?>

        <!-- content -->
        <div class="content">
            <div class="box_awal">
                <div>
                    <small class="box_putih">Platform Tanya Jawab Karya Ilmiah</small><br>
                    <h1>KONSULTASI TERPERCAYA BERSAMA PARA AHLI</h1>
                    <p>Ajukan pertanyaan seputar karya ilmiah, Lalu dapatkan jawaban terverifikasi langsung dari para pakar dan praktisi ahli</p><br>
                    <a href="./authentication/register.php" class="box_hijau">Mulai Bertanya Gratis</a>
                    <a href="./authentication/login.php" class="box_pinktua">Masuk ke Akun</a>
                </div>
            </div>
            <div class="box_kat">
                <!-- filter kategori -->
                <div>
                    <h2 class="box_putih"><span class="box_pinkmuda">Kategori</span> Topik Diskusi</h2>
                    <small>Jelajahi pertanyaan dari pelajar. Masuk untuk membuka kunci jawaban pakar.</small>
                </div>
                <form action="index.php" method="GET">
                    <select name="kategori">
                        <option value="">semua kategori</option>
                        <?php foreach($kategori as $kat): ?>
                            <option value="<?= $kat['id_kategori'] ?>"><?= $kat['kategori']?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">filter</button>
                </form>
            </div>
            
            <!-- daftar topik -->
            <?php if (count($topik) > 0): ?>
                <?php foreach ($topik as $top): ?>
                    <div class="box">
                        <small><?= $top["kategori"] ?></small><br>
                        <small><?= $top["username"]?></small><br>
                        <a href="./authentication/login.php" class="box_topik"><?= $top['topic'] ?></a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="box">Belum ada topik pada kategori ini.</div>
            <?php endif; ?>
        </div>
        <!-- footer -->
        <?php require "./component/footer.php"?>
    </div>
</body>
</html>