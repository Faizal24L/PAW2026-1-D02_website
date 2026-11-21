<?php
    require "./connection/database.php";

    //ambil daftar kategori
    $sql_kat = "SELECT id_kategori, kategori FROM categories ORDER by id_kategori ASC";
    $query_kat = $dbc -> prepare($sql_kat);
    $query_kat->execute();
    $kategori = $query_kat->fetchAll();

    //mengecek jika user memilih kategori
    if(isset($_GET['kategori']) && $_GET['kategori'] !== ""){
        $id_kategori = $_GET['kategori'];
        //tampilkan topik sesuai kategori
        $sql_topik = "SELECT topics.id_topic, topics.id_user, topics.topic, categories.kategori
                FROM topics LEFT JOIN categories ON topics.id_kategori = categories.id_kategori
                WHERE topics.id_kategori = :id_kategori
                ORDER BY topics.id_topic DESC";
        $query_topik =$dbc -> prepare($sql_topik);
        $query_topik -> bindValue(":id_kategori", $id_kategori);
        $query_topik->execute();
    }else {
        // Tampilkan semua topik 
        $sql_topic = "SELECT topics.id_topic, topics.id_user, topics.topic, categories.kategori 
                    FROM topics LEFT JOIN categories ON topics.id_kategori = categories.id_kategori
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
    <title>Dashboard</title>
</head>
<body>
    <!-- header -->
    <?php require "../component/header.php"?>

    <!-- content -->
    <div class="content">
        <!-- filter kategori -->
        <form action="index.php" method="GET">
            <label for="kategori">kategori</label>
            <select name="kategori">
                <option value="">semua kategori</option>
                <?php foreach($kategori as $kat): ?>
                    <option value="<?= $kat['id_kategori'] ?>"><?= $kat['kategori']?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">filter</button>
        </form>

        <br>

        <!-- daftar topik -->
        <?php if (count($topik) > 0): ?>
            <?php foreach ($topik as $top): ?>
            <div>
                <a href="./authentication/login.php"><?= $top['topic'] ?></a>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Belum ada topik pada kategori ini.</p>
        <?php endif; ?>
    </div>
    
    <!-- footer -->
     <?php require "../component/footer.php"?>
</body>
</html>