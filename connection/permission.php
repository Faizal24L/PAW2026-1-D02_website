<?php
	session_start();
	if (!isset($_SESSION["isLogin"])){
		// user akan di arahkan ke halaman login untuk authorization
		// header("Location: http://localhost/PAW_11/login.php");
		header("Location: ../authentication/login.php");
		exit();
	}

	// if (isset($_SESSION["isLogin"]) && isset($_SESSION["id_role"])) {
	// 	if ($_SESSION["id_role"] == 2) {
	// 		header("Location: /PAW2026-1-D02_website/expert/dashboard_expert.php");
	// 	} else {
	// 		header("Location: /PAW2026-1-D02_website/client/dashboard_client.php");
	// 	}
	// }
?>