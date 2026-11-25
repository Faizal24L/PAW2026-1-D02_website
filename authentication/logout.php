<?php
    session_start();
    // meniadakan session yang telah di deklarasikan
    unset($_SESSION['isLogin']);
    unset($_SESSION['id_user']);
    unset($_SESSION['id_role']);

    // di arahkan ke login jika telah logout
    header("location:http://localhost/PAW2026-1-D02_website/authentication/login.php");
?>