<?php
    require "../connection/permission.php";
    echo "berjalan";
    require "../connection/database.php";

    $topic = $_GET['id_topic'];

    $sql = "SELECT topics.topic, replys.reply 
        FROM topics JOIN replys 
        on topics.id_reply = replys.id_reply ";
    $query = $dbc -> prepare($sql); 
    $query->execute();
    
    $user = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topic</title>
</head>
<body>
    
</body>
</html>