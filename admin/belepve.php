<?php

// Session start
session_start();

// Konfig betöltése
include('../inc/config.php');

// MySQLi betöltése
$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);

// SESSION felhasználó
$felhasznalo = $_SESSION["username"];

// MySQLi lekérdezés
$lekerdez = mysqli_query($link, "SELECT * FROM felhasznalok WHERE username='$felhasznalo'");
$fetch_array = mysqli_fetch_array($lekerdez);

if ($fetch_array["rang"] > 8) {
	//echo "Ő egy admin";
} else {
	header("Location: ../index.php");
}

$szamol_adatbazis = mysqli_fetch_row(mysqli_query($link, "SELECT COUNT(*) FROM `uj_filmek`"));
$szamol_felhasznalok = mysqli_fetch_row(mysqli_query($link, "SELECT COUNT(*) FROM `felhasznalok`"));
$szamol_hozzaszolasok = mysqli_fetch_row(mysqli_query($link, "SELECT COUNT(*) FROM `hozzaszolasok`"));
$szamol_hibas_linkek = mysqli_fetch_row(mysqli_query($link, "SELECT COUNT(*) FROM `hibas_linkek`"));
$szamol_bekuldott_filmek = mysqli_fetch_row(mysqli_query($link, "SELECT COUNT(*) FROM `bekuldott_filmek`"));

?>
<html>
	<?php include("../tartalom/head_admin.php"); ?>
<body>

<?php include("../tartalom/navbar_admin.php"); ?>

<!-- CONTENT -->
<div class="container">

<br />
<div class="row">
	<div class="col-sm-3"></div>
	<div class="col-sm-6">
		<div class="alert alert-dismissible alert-success">
		  <p class="mb-0">Filmek: <b><?=$szamol_adatbazis[0]?></b></p>
		</div>
	</div>
	<div class="col-sm-3"></div>
</div>
<div class="row">
	<div class="col-sm-3"></div>
	<div class="col-sm-3">
		<div class="alert alert-dismissible alert-success">
		  <p class="mb-0">Hozzászólások: <b><?=$szamol_hozzaszolasok[0]?></b></p>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="alert alert-dismissible alert-success">
		  <p class="mb-0">Felhasználók: <b><?=$szamol_felhasznalok[0]?></b></p>
		</div>
	</div>
</div>
<div class="row">
<div class="col-sm-3"></div>
	<div class="col-sm-3">
		<div class="alert alert-dismissible alert-success">
		  <p class="mb-0">Beküldött filmek: <b><?=$szamol_bekuldott_filmek[0]?></b></p>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="alert alert-dismissible alert-success">
		  <p class="mb-0">Hibás linkek: <b><?=$szamol_hibas_linkek[0]?></b></p>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="card border-dark">
			  <div class="card-header">Admin panel kezdőlap</div>
			  <div class="card-body">
				<h4 class="card-title">Sok sikert kívánok!</h4>
				<p class="card-text">Kedves használó!<br />
				Sok sikert szeretnék kívánni oldalad beüzemeléséhez. Ha nem szeretnél lemaradni a frissebb fejlesztésekről, akkor hamarosan elérhető lesz a motor a <a href="http://crosman-web.hu">www.crosman-web.hu</a> oldalon is.<br />
				Kérlek a forrás megjelölést hagyd benne a kódban! Köszönöm.</p>
			  </div>
			</div>
		</div>
	</div>
  <div class="col-sm-2"></div>
  <br />
 <div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<?php include("../tartalom/footer_admin.php"); ?>
	</div>
	<div class="col-sm-2"></div>
</div>
</div>

</div>
</body>
</html>