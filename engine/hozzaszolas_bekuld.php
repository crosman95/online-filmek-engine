<?php
	date_default_timezone_set('Europe/Budapest');
	include('../inc/config.php');
	$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);
	
	if (!empty($_POST["film_id"])) {
		$film_id = htmlspecialchars($_POST["film_id"]);
		$nev = htmlspecialchars($_POST["nev"]);
		$email = htmlspecialchars($_POST["email"]);
		$hozzaszolas = htmlspecialchars($_POST["hozzaszolas"]);
		
		$datum = date("Y.m.d. h:m");
		
		// E-mail cím ellenőrzése
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  header("Location: ../film.php?id=$film_id");
		}
		else {
			mysqli_query($link, "INSERT INTO `hozzaszolasok`(`id`, `film_id`, `nev`, `email`, `hozzaszolas`, `datum`) VALUES (NULL,'$film_id','$nev','$email','$hozzaszolas', '$datum')");
			header("Location: ../film.php?id=$film_id");
		}
	}
	else {
		header("Location: ../film.php?id=$film_id");
	}
	
?>