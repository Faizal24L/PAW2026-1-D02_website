<?php
    // ambil daftar kategori
    $sql_kat = "SELECT id_kategori, kategori FROM categories ORDER by id_kategori ASC";
    $query_kat = $dbc -> prepare($sql_kat);
    $query_kat->execute();
    $kategori = $query_kat->fetchAll();

    //mengecek jika user memilih kategori
    if(isset($_GET['kategori']) && $_GET['kategori'] !== ""){
        $id_kategori = $_GET['kategori'];
        //tampilkan topik sesuai kategori
        $sql_topik = "SELECT topics.id_topic,
                             topics.id_user,
                             topics.topic,
                             categories.kategori,
                             users.username
                    FROM topics
                    LEFT JOIN categories 
                    ON topics.id_kategori = categories.id_kategori
                    LEFT JOIN users 
                    ON topics.id_user = users.id_user
                    ORDER BY topics.id_topic DESC";
        $query_topik =$dbc -> prepare($sql_topik);
        $query_topik -> bindValue(":id_kategori", $id_kategori);
        $query_topik->execute();
    }else {
        // Tampilkan semua topik 
        $sql_topic = "SELECT topics.id_topic,
                             topics.id_user,
                             topics.topic,
                             categories.kategori,
                             users.username
                    FROM topics
                    LEFT JOIN categories 
                    ON topics.id_kategori = categories.id_kategori
                    LEFT JOIN users 
                    ON topics.id_user = users.id_user
                    ORDER BY topics.id_topic DESC";
        $query_topik = $dbc->prepare($sql_topic);
        $query_topik->execute();
    }
    $topik = $query_topik->fetchAll();
    // var_dump($topik);
?>