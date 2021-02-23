<?php

// Session start
session_start();

// Konfig betöltése
include('../inc/config.php');

// MySQLi betöltése
$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);

// POST adatok
$felhasznalo = $_POST["username"];
$jelszo = $_POST["jelszo"];
$md5_jelszo = md5($jelszo);

// MySQLi lekérdezés
$lekerdez = mysqli_query($link, "SELECT * FROM felhasznalok WHERE username='$felhasznalo' AND jelszo='$md5_jelszo'");
$fetch_array = mysqli_fetch_array($lekerdez);

// Műsor! :D

if (empty($felhasznalo)) {
	header("Location: index.php");
}

if ($felhasznalo == $fetch_array["username"]) {
	$_SESSION["username"] = $felhasznalo;
	header("Location: belepve.php");
} else {
	header("Location: index.php");
}

?>