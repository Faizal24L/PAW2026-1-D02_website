<?php
    session_start();
    unset($_SESSION['isExpert']);
    unset($_SESSION['isClient']);

    header("location:http://localhost/PAW2026-1-D02_website/authentication/login.php");
?>