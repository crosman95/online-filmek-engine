<?php
	include('../inc/config.php');
	$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);
	
	if (!empty($_POST["film_id"])) {
		$film_id = htmlspecialchars($_POST["film_id"]);
		$film_cim = htmlspecialchars($_POST["film_cim"]);
		$hiba = htmlspecialchars($_POST["hiba"]);
		$email = htmlspecialchars($_POST["email"]);
		
		// E-mail cím ellenőrzése
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  header("Location: ../index.php");
		}
		else {
			mysqli_query($link, "INSERT INTO `hibas_linkek`(`id`, `film_id`, `film_cim`, `hiba`, `email`) VALUES (NULL,'$film_id','$film_cim','$hiba','$email')");
			header("Location: ../index.php?feldolgoz=hibas_link_bekuldve");
		}
	}
	else {
		header("Location: ../index.php");
	}
	
?>