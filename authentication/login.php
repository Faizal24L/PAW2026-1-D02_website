<?php
    require "validasi.php";
    $errors = [];
    $header = "login";

    if($_SERVER["REQUEST_METHOD"] === "POST" ){
        $username = $_POST['username'];
        $password =  $_POST['password'];

        // valUsername($errors, $username);
        // valPassword($errors, $password);

        if(empty($errors)){
            require "../connection/database.php";

            $hashedInputPassword = hash('sha256', $password);

            $sql = "SELECT username, password, id_role, id_user FROM users WHERE username = :username AND password = :password";
            $query = $dbc -> prepare($sql);

            $query->bindValue(":username", $username);
            $query->bindValue(":password", $hashedInputPassword);

            $query->execute();
            
            $user = $query->fetch();
            
            if ($user && $hashedInputPassword){
                session_start();
                if ($user["id_role"] == 2){
                    // $_SESSION["isExpert"] = true;
                    $_SESSION["isLogin"] = true;
                    $_SESSION["id_user"] = $user['id_user'];
                    $_SESSION["id_role"] = $user["id_role"];
                    $_SESSION["username"] = $user["username"];
                    header("Location: /PAW2026-1-D02_website/expert/dashboard_expert.php");
                    exit();
                }else if ($user["id_role"] == 1){
                    // $_SESSION["isClient"] = true;
                    $_SESSION["isLogin"] = true;
                    $_SESSION["id_user"] = $user['id_user'];
                    $_SESSION["id_role"] = $user["id_role"];
                    $_SESSION["username"] = $user["username"];
                    header("Location: /PAW2026-1-D02_website/client/dashboard_client.php");
                    exit();
                }
            } else {
                $error = "Password atau Username salah";
            }
        }
    }

    session_start();
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

    <!-- content -->
    <div class="content">
        <div class="box_tengah">
            <div class="box_form_atas">
                <div>
                    <h1 class="putih">Selamat Datang Kembali</h1>
                    <span>Masuk ke akun ResearchMate unutk melanjutkan diskusi</span>
                </div>
            </div>
            <div class="box_form">
                <form method="POST" action="login.php">
                    <label>Username</label><br>
                    <input type="text" name="username" value="<?= isset($errors['username']) && isset($_POST['username'])? $_POST['username']:""?>">
                    <span style="color:red"><?=$errors['username']??""?></span>

                    <br><label>Password</label><br>
                    <input type="password" name="password" value="<?= isset($errors['password']) && isset($_POST['password'])? $_POST['password']:""?>">
                    <span style="color:red"><?=$errors['password']??""?></span>

                    <button type="submit">Login</button>
                </form>
                
                <span><?=$error??""?></span>
                <p>Belum punya akun? <a href="register.php">Daftar</a></p>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require "../component/footer.php";?>
</body>
</html>