<?php
    session_start();
    require "../connection/permission_client.php";
    require "../connection/database.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $topic = $_POST['topic'];
        $id_user = $_SESSION["id_user"];
        $id_kategori = $_POST["id_kategori"];

        $sql = "INSERT INTO topics (topic, id_user, id_kategori) VALUES (:topic, :id_user, :id_kategori)";
        $query = $dbc -> prepare($sql); 
        $query->bindValue(":topic", $topic);
        $query->bindValue(":id_user", $id_user);
        $query->bindValue(":id_kategori", $id_kategori);
        $query->execute();

        header("Location: ../client/dashboard_client.php");
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Create Topict</title>
</head>
<body>
    <div class="container">
        <!-- header -->
        <?php require "../component/header.php";?>

        <!-- content -->
        <div class="content">
            <div class="box_tengah">
                <a href="dashboard_client.php"><< Kembali ke Dashboard</a>
                <div class="box_form_atas">
                    <h1 class="putih">Buat Topik Diskusi Baru</h1>
                    <small>Tuliskan pertanyaan dengan jelas agar para expert dapat membantu</small>
                </div>
                <div class="box_form">
                    <form method="POST" action="">
                        <label for="id_kategori">KATEGORI MATA PELAJARAN / BIDANG:</label>
                        <select name="id_kategori" id="id_kategori">
                            <option value="1">Penentuan Topik</option>
                            <option value="2">Metodologi Penelitian</option>
                            <option value="3">Pengolahan Data</option>
                            <option value="4">Penulisan Ilmiah</option>
                            <option value="5">Referensi dan Sitasi</option>
                            <option value="6">Publikasi Ilmiah</option>
                        </select>

                        <label for="topic">DETAIL PERTANYAAN</label>
                        <textarea name="topic" id="topic"></textarea>

                        <button type="submit">Publikasi Topik</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- footer -->
        <?php require "../component/footer.php";?>
    </div>
</body>
</html>