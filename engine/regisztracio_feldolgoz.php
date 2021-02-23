<?php

session_start();

// Config behívása
require_once("../inc/config.php");
$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);

// Config adatok behívása
$oldal_url = oldal_footer;
$oldal_email = oldal_email;

// Adatok bekérése
$username = htmlspecialchars($_POST["username"]);
$jelszo = htmlspecialchars($_POST["jelszo"]);
$jelszo2 = htmlspecialchars($_POST["jelszo2"]);
$email = htmlspecialchars($_POST["email"]);
$szuletesi_datum = htmlspecialchars($_POST["szuletesi_datum"]);
$kedvenc_film = htmlspecialchars($_POST["kedvenc_film"]);

// Hírlevél
$hirlevel = $_POST["hirlevel"];

// Jelszó fordítása MD5 kódolásban
$jelszo_md5 = md5($jelszo);
$jelszo2_md5 = md5($jelszo2);

// Mai dátum generálása
$datum = date("Y.m.d");

// MySQLi csatlakozás
//$link = mysqli_connect(mysqli_ip, mysqli_felhasznalo_nev, mysqli_jelszo, mysqli_adatbazis);

// MySQLi ellenőrzés és SESSION regisztráció, vagy visszadobás
$query = mysqli_query($link, "SELECT * FROM felhasznalok WHERE username='$username'");
$fetch_array = mysqli_fetch_array($query);

$query2 = mysqli_query($link, "SELECT * FROM felhasznalok WHERE email='$email'");
$fetch_array2 = mysqli_fetch_array($query2);

// Ha nem posztolt avatart
if (!empty($_POST["avatar"])) {
	$avatar = $_POST["avatar"];
} else {
	$avatar = "1";
}

// Hírlevél változó
$hirlevel_adatbazis = "";
if ($hirlevel == "true") {
	$hirlevel_adatbazis = "true";
}
else {
	$hirlevel_adatbazis = "false";
}

if ($fetch_array["username"] == "") {
	if ($jelszo_md5 == $jelszo2_md5) {
		if ($fetch_array2["email"] == "") {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  header("Location: index.php?hiba=email");
			}
			else {
				//mysqli_query($link, "INSERT INTO `felhasznalok` (`id`, `felhasznalo_nev`, `jelszo`, `email`, `szerver_tipus`, `home`, `szervergep`, `reg_datum`) VALUES (NULL, '$username', '$jelszo_md5', '$email', '1', '$username', '1', '$datum')");
				mysqli_query($link, "INSERT INTO `felhasznalok`(`id`, `datum`, `username`, `jelszo`, `email`, `rang`, `avatar`, `szuletesi_datum`, `kedvenc_film`, `hirlevel`, `leiras`) VALUES (NULL,'$datum','$username','$jelszo_md5','$email','1','img/avatars/$avatar.png','$szuletesi_datum','$kedvenc_film','$hirlevel','')");
				
				// E-mail kiküldése
				$to = "$email";
				$subject = "Online-Filmek regisztráció";

				$message = "
				<html>
					<head>
						<title></title>
						<link rel='stylesheet' href='http://$oldal_url/css/bootstrap.css' />
						<link rel='stylesheet' href='http://$oldal_url/css/bootstrap.min.css' />
					</head>
				<body>
					Helló, $username!<br />
					Sikeresen regisztráltál az <b>online-filmek.ml</b> weboldalra.<br />
					<br />
					A következő adatokkal tudsz bejelentkezni:<br />
					<b>Felhasználói név: </b>$username<br />
					<b>Jelszó: </b>$jelszo<br />
					<br />
					Itt tudsz bejelentkezni: http://$oldal_url/bejelentkezes.php<br />
					<br />
					Jó filmezést kíván az Online-Filmek csapata!
				</body>
				</html>
				";

				// Content type
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// Headers
				$headers .= "From: <$oldal_email>" . "\r\n";

				mail($to,$subject,$message,$headers);
				
				header("Location: ../bejelentkezes.php?sikeres=regisztralva");
			}
		} else {
			header("Location: ../regisztracio.php?hiba=email_adatbazis");
		}
	} else {
		header("Location: ../regisztracio.php?hiba=jelszo");
	}
} else {
	header("Location: ../regisztracio.php?hiba=felhasznalo");
}


?>