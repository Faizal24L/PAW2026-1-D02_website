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
    <title>Create Topict</title>
</head>
<body>
    <a href="dashboard_client.php">Kembali ke Dashboard</a>
    <h1>Buat Topik Diskusi Baru</h1>
    <span>Tuliskan pertanyaan dengan jelas agar para expert dapat membantu</span>
    <form method="POST" action="">
        <label for="id_role">Pilih Role:</label>
        <select name="id_kategori">
            <option value="1">penentuan topik</option>
            <option value="2">Metodologi Penelitian</option>
            <option value="3">Pengolahan Data</option>
            <option value="4">Penulisan Ilmiah</option>
            <option value="5">Referensi dan Sitasi</option>
            <option value="6">Publikasi Ilmiah</option>
        </select>
        <br>
        <textarea name="topic"></textarea>
        <br>
        <button type="submit">Publikasi Topik</button>
    </form>
</body>
</html>