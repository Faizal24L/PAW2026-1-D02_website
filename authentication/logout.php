<?php
    session_start();
    unset($_SESSION['isLogin']);
    unset($_SESSION['idRole']);

    header("location:http://localhost/PAW2026-1-D02_website/authentication/login.php");
?>