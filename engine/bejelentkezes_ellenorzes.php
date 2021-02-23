<?php

session_start();
require_once("../inc/config.php");
$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);

$felhasznalo_nev = $_POST["username"];
$jelszo = $_POST["jelszo"];

$jelszo_md5 = md5($jelszo);

$mysqli_ellenorzes = mysqli_query($link, "SELECT * FROM felhasznalok WHERE username='$felhasznalo_nev'");
$felhasznalo_lekerdezes = mysqli_fetch_array($mysqli_ellenorzes);

if ($felhasznalo_lekerdezes["username"] == $felhasznalo_nev AND $felhasznalo_lekerdezes["jelszo"] == $jelszo_md5) {
	$_SESSION["username"] = $felhasznalo_lekerdezes["username"];
	header("Location: ../index.php");
} else {
	header("Location: ../bejelentkezes.php?feldolgoz=hiba");
}

?>