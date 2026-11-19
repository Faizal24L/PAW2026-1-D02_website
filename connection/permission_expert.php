<?php
	// session_start();
	$id_role = $_SESSION['id_role'];
	if (!isset($_SESSION["isLogin"])){
		// user akan di arahkan ke halaman login untuk authorization
		// header("Location: http://localhost/PAW_11/login.php");
		header("Location: ../authentication/login.php");
		exit();
	}

	if ($id_role != 2) {
		// Arahkan kembali ke halaman expert agar tidak nyasar
		// Silakan sesuaikan URL di bawah ini dengan halaman utama expert Anda
		header("Location: ../client/dashboard_client.php");
		exit();
	}
?>