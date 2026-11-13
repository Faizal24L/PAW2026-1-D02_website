<?php
    require "../connection/permission.php";
    echo "berjalan";
    require "database.php";
    if($_SERVER["REQUEST_METHODE"] === "POST"){
        $topic = $_POST['topic'];
        if(isset($_POST['submit'])){
            require "../connection/database.php";

            $sql = "INSERT INTO topics(topic) VALUES (":topic")";
            $query = $dbc -> prepare($sql); 
            $query->bindValue(":topic", $topic);
            $query->execute();
            
            $user = $query->fetch();
            header("Location: ../client/dashboard.php");
        }
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
    <form method="POST" action="topic_detail.php">
        <label>Topik baru</label><br>
        <textarea name="topic"></textarea>

        <button type="submit">kirim</button>
    </form>
</body>
</html>