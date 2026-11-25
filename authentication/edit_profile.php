<?php
    session_start();
    $id_user = $_SESSION["id_user"];
    $id_role = $_SESSION["id_role"];

    // koneksi ke database
    require "../connection/database.php";

    // untuk membedakan permission milik client dan expert
    if ($id_role == 1){
        require "../connection/permission_client.php";
    } else {
        require "../connection/permission_expert.php";
    }
    
    // query untuk mengambil record milik user
    $sql_s = "SELECT username, telepon, tanggal_lahir FROM users WHERE id_user = :id_user";
    $query_s = $dbc -> prepare($sql_s);
    $query_s -> bindValue(":id_user", $id_user);
    $query_s -> execute();
    $user = $query_s -> fetch();

    // memanggil file validasi
    require "validasi.php";

    $errors = [];
    
    // berjalan ketika user menekan tombol kirim
    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['kirim'])){
        $new_username = $_POST['new_username'];
        $new_telepon = $_POST['new_telepon'];
        $new_tanggal_lahir = $_POST["new_tanggal_lahir"];
        $new_password = $_POST["new_password"];

        // validasi yang di inputkan oleh
        valUsername($errors, $new_username);
        valPassword($errors, $new_password);
        valTelepon($errors, $new_telepon);
        tanggalLahir($errors, $new_tanggal_lahir);

        // jika tidak ada error maka akan di lakukan pembaruan
        if(empty($errors)){
            $sql = "UPDATE users SET username = :new_username , telepon = :new_telepon, tanggal_lahir = :new_tanggal_lahir, password = SHA2(:new_password, 256) WHERE id_user = :id_user";
            $query = $dbc -> prepare($sql); 
            $query->bindValue(":new_username", $new_username);
            $query->bindValue(":id_user", $id_user);
            $query->bindValue(":new_telepon", $new_telepon);
            $query->bindValue(":new_tanggal_lahir", $new_tanggal_lahir);
            $query->bindValue(":new_password", $new_password);
            $query->execute();
            
            header("Location:./profile.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Kelola Profile</title>
</head>
<body>
    <!-- header -->
    <?php require "../component/header.php";?>

    <div class="content">
        <div class="box_tengah">
            <!-- navigasi ke halaman tertentu -->
            <a href="./profile.php"><< Kembali ke Profile</a>
            <div class="box_form_atas">
                <h1 class="putih">KELOLA PROFILE</h1>
                <small>Perbarui informasi pribadi dan keamanan akun Anda</small>
            </div>
            <div class="box_form">
                <!-- form untuk melakukan pembaruan profile -->
                <form method="POST" action="edit_profile.php">
                    <label>USER NAME: </label>
                    <input type="text" name="new_username" value="<?= htmlspecialchars($user['username'])?>">
                    <span style="color:red"><?=$errors['username']??""?></span><br>

                    <label>TELEPON: </label>
                    <input type="text" name="new_telepon" value="<?= htmlspecialchars($user['telepon'])?>">
                    <span style="color:red"><?=$errors['telepon']??""?></span><br>

                    <label>TANGGAL LAHIR: </label>
                    <input type="date" name="new_tanggal_lahir" value="<?= htmlspecialchars($user['tanggal_lahir'])?>">
                    <span style="color:red"><?=$errors['tanggal_lahir']??""?></span><br>

                    <label>PASSWORD: </label>
                    <input type="password" name="new_password" value="">
                    <span style="color:red"><?=$errors['password']??""?></span><br>

                    <button type="submit" name="kirim">Kirim</button>
                </form>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require "../component/footer.php";?>
</body>
</html>