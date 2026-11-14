<?php
    require "../connection/permission.php";
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
    <form method="POST" action="">
        <label>Topik baru</label><br>
        <textarea name="topic"></textarea>
        <br>
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
        <button type="submit">kirim</button>
    </form>
</body>
</html>