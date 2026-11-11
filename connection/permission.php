<?php
	session_start();
	if (!isset($_SESSION['isClient'])){
		// user akan di arahkan ke halaman login untuk authorization
		// header("Location: http://localhost/PAW_11/login.php");
		header("Location: http://{$_SERVER['HTTP_HOST']}/PAW2026-1-D02_website/authentication/login.php");
		exit();
	}

	if (!isset($_SESSION['isExpert'])){
		// user akan di arahkan ke halaman login untuk authorization
		// header("Location: http://localhost/PAW_11/login.php");
		header("Location: http://{$_SERVER['HTTP_HOST']}/PAW2026-1-D02_website/authentication/login.php");
		exit();
	}
?>