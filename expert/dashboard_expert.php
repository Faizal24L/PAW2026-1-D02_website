<?php
    session_start();
    require "../connection/permission_expert.php";
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
    <!-- Lihat profile -->
    <!-- Lihat profile -->
    <a href="../authentication/profile_expert.php">PROFILE</a>

    <!-- filter kategori -->
    

    <!-- daftar topik -->
    <?php if (count($topik) > 0): ?>
        <?php foreach ($topik as $top): ?>
            <?php if ($top['id_user'] == $_SESSION['id_user']):?>
                    <div>
                        <a href="./reply.php?id_topic=<?= $top['id_topic'] ?>"><?= htmlspecialchars($top['topic']) ?></a>
                    </div>
                <?php endif;?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Belum ada topik pada kategori ini.</p>
    <?php endif; ?>

    <h1>SEMUA TOPIK</h1><br>

    <form action="dashboard_expert.php" method="GET">
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
        <?php foreach ($topik as $top):?>
            <div>
                <a href="./reply.php?id_topic=<?= $top['id_topic'] ?>"><?= htmlspecialchars($top['topic']) ?></a>
            </div>
        <?php endforeach;?>
    <?php else: ?>
        <p>Belum ada topik pada kategori ini.</p>
    <?php endif; ?>

    <!-- ke halaman Logout -->
    <p><a href="../authentication/logout.php">LOGOUT</a></p>
</body>
</html>