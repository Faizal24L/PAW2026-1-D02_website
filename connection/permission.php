<?php
	session_start();
	if (!isset($_SESSION["isLogin"])){
		// user akan di arahkan ke halaman login untuk authorization
		// header("Location: http://localhost/PAW_11/login.php");
		header("Location: ../authentication/login.php");
		exit();
	}
?>