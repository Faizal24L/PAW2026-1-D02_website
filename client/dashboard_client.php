<?php
    require "../connection/permission_client.php";
    require "../connection/database.php";

    $id_user = $_SESSION["id_user"];
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
    // var_dump($topik);
    // echo "<br>";
    // var_dump($_SESSION["id_user"]);
    // exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <!-- Lihat Profile -->
    <!-- Lihat Profile -->
    <a href="../authentication/profile_client.php">PROFILE</a>

    

    <!-- daftar topik Diri Sendiri-->
     <h1>INI TOPIK SAYA</h1><br>

     <!-- filter kategori -->
    <form action="dashboard_client.php" method="GET">
        <label>kategori</label>
        <select name="kategori">
            <option value="">semua kategori</option>
            <?php foreach($kategori as $kat): ?>
                <option value="<?= $kat['id_kategori'] ?>"><?= htmlspecialchars($kat['kategori'])?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">filter</button>
    </form>
    <br>
    
    <?php if (count($topik) > 0): ?>
        <?php foreach ($topik as $top): ?>
            <?php if ($top['id_user'] == $_SESSION['id_user']):?>
                <div>
                    <a href="./topic_detail.php?id_topic=<?= $top['id_topic'] ?>"><?= htmlspecialchars($top['topic']) ?></a>
                </div>
            <?php endif;?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Belum ada topik pada kategori ini.</p>
    <?php endif; ?>

    <!-- Semua daftar topik -->
    <h2>SEMUA TOPIK</h2>
    <?php if (count($topik) > 0): ?>
        <?php foreach ($topik as $top):?>
            <div>
                <a href="./topic_detail.php?id_topic=<?= $top['id_topic'] ?>"><?= htmlspecialchars($top['topic']) ?></a>
            </div>
        <?php endforeach;?>
    <?php else: ?>
        <p>Belum ada topik pada kategori ini.</p>
    <?php endif; ?>
    <!-- ke Halaman membuat topik -->
    <a href="create_topik.php?id_user=<?=$id_user?>">buat topik</a>

    <!-- ke Halaman Logout -->

    <!-- ke Halaman Logout -->
    <p><a href="../authentication/logout.php">LOGOUT</a></p>
</body>
</html>