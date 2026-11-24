<?php
    require "validasi.php";
    $errors = [];

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $username = $_POST['username'];
        $password =  $_POST['password'];
        $telepon =  $_POST['telepon'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $id_role = $_POST["id_role"];

        valUsername($errors, $username);
        valPassword($errors, $password);
        valNomor($errors, $telepon);
        tanggalLahir($errors, $tanggal_lahir);

        if(empty($errors)){
            require "../connection/database.php";

            $sql = "INSERT INTO users (id_role, username, password, telepon, tanggal_lahir) VALUES
                      (:id_role, :username, SHA2(:password, 256), :telepon, :tanggal_lahir)";

            $query = $dbc -> prepare($sql);

            $query->bindValue(":username", $username);
            $query->bindValue(":password", $password);
            $query->bindValue(":telepon", $telepon);
            $query->bindValue(":tanggal_lahir", $tanggal_lahir);
            $query->bindValue(":id_role", $id_role);

            $query->execute();

            header("location: ./login.php");

            
        }
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>Login</title>
</head>
<body>
    <!-- header -->
    <?php require "../component/header.php";?>

    <div class="content">
        <div class="box_tengah">
            <div class="box_form_atas">
                <div>
                    <h1 class="putih">Buat Akun Baru</h1>
                    <span>Bergabunglah sebagai Pelajar atau Pengajar</span>
                </div>
            </div>
            <div class="box_form">
                <form method="POST" action="">
                    <label>USERNAME</label><br>
                    <input type="text" name="username" placeholder="contoh: Prabowo" value="<?= isset($errors['username']) && isset($_POST['username'])? $_POST['username']:""?>">
                    <span style="color:red"><?=$errors['username']??""?></span>

                    <br><label>PASSWORD</label><br>
                    <input type="password" name="password" placeholder="Minimal 8 Karakter" value="<?= isset($errors['password']) && isset($_POST['password'])? $_POST['password']:""?>">
                    <span style="color:red"><?=$errors['password']??""?></span>

                    <br><label>NO. TELEPON</label><br>
                    <input type="text" name="telepon" placeholder="08xxxxxxxxxx" value="<?= isset($errors['telepon']) && isset($_POST['telepon'])? $_POST['telepon']:""?>">
                    <span style="color:red"><?=$errors['telepon']??""?></span>

                    <br><label>TANGGAL LAHIR</label><br>
                    <input type="date" name="tanggal_lahir" value="<?= isset($errors['tanggal_lahir']) && isset($_POST['tanggal_lahir'])? $_POST['tanggal_lahir']:""?>">
                    <span style="color:red"><?=$errors['tanggal Lahir']??""?></span>

                    <br>
                    <label for="id_role">PILIH ROLE:</label>
                    <select name="id_role">
                        <option value="1">USER</option>
                        <option value="2">PAKAR</option>
                    </select>
                    <span style="color:red"><?=$errors['tanggal Lahir']??""?></span>

                    <br><button type="submit">Daftar!</button>
                </form>
                <p>Sudah punya Akun? <a href="./login.php">Login di sini</a></p>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require "../component/footer.php";?>
</body>
</html>