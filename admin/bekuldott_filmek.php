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
	// Ha minimum feltöltő rang-al rendelkezik itt jön be az adfly kulcs.
	//$api_kulcs = ;
	//$api_user = ;
} else {
	header("Location: ../index.php");
}

$bekuldott_filmek = mysqli_query($link, "SELECT * FROM bekuldott_filmek");


$szamol_bekuldott_filmek = mysqli_fetch_row(mysqli_query($link, "SELECT COUNT(*) FROM `bekuldott_filmek`"));

?>
<html>
	<?php include("../tartalom/head_admin.php"); ?>
<body>

<?php include("../tartalom/navbar_admin.php"); ?>

<!-- CONTENT -->
<div class="container">
<?php
	if (!empty($_GET["elfogadas"])) {
		$id = $_GET["elfogadas"];
		$bekuldott_film = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM bekuldott_filmek WHERE id=$id"));
		
		$db_id = $bekuldott_film["db_id"];
		$cim = $bekuldott_film["cim"];
		$eredeti_cim = $bekuldott_film["eredeti_cim"];
		$leiras = $bekuldott_film["leiras"];
		$megjelenes = $bekuldott_film["megjelenes"];
		$hossza = $bekuldott_film["hossza"];
		$ertekeles = $bekuldott_film["ertekeles"];
		$kategoria = $bekuldott_film["kategoria"];
		$kep = $bekuldott_film["kep"];
		//$film_link = $bekuldott_film["film_link"];
		$felhasznalo = $bekuldott_film["felhasznalo"];
		$keres_id = $bekuldott_film["keresre"];
		
		/*****ITT KERÜL BE ADFLY LINKRE******/
		$feltolto_ellenoriz = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM felhasznalok WHERE username='$felhasznalo'"));
		if ($feltolto_ellenoriz["rang"] > 8) {
			$api_kulcs = $feltolto_ellenoriz["api_kulcs"];
			$user_id = $feltolto_ellenoriz["user_id"];
		} else {
			$api_kulcs = adfly_api;
			$user_id = adfly_user_id;
		}
		$domain = $bekuldott_film["film_link"];
		$film_link = file_get_contents("http://api.adf.ly/api.php?key=$api_kulcs&uid=$user_id&advert_type=int&domain=adf.ly&url=$domain");
		/*****ITT KERÜL BE ADFLY LINKRE******/
		
		if ($keres_id != "false") {
			//echo $keres_id;
			// Ide jön majd, hogy beírjuk a film ID-t ha kérték!
		}
		
		mysqli_query($link,"INSERT INTO `uj_filmek`(`id`, `db_id`, `cim`, `eredeti_cim`, `leiras`, `megjelenes`, `hossza`, `ertekeles`, `kategoria`, `kep`, `film_link`, `megjelenhet`, `felhasznalo`) VALUES (NULL,'$db_id','$cim','$eredeti_cim','$leiras','$megjelenes','$hossza','$ertekeles','$kategoria','$kep','$film_link','true','$felhasznalo')");
		mysqli_query($link,"DELETE FROM bekuldott_filmek WHERE id=$id");
?>
<br />
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="alert alert-dismissible alert-success">
		  <p class="mb-0">Sikeresen elfogadtad a filmet!</b></p>
		</div>
	</div>
	<div class="col-sm-3"></div>
</div>
<?php
	}
?>
<?php
	if (!empty($_GET["elutasitas"])) {
		$id = $_GET["elutasitas"];
		
		mysqli_query($link,"DELETE FROM bekuldott_filmek WHERE id=$id");
?>
<br />
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="alert alert-dismissible alert-warning">
		  <p class="mb-0">Sikeresen elutasítottad a filmet!</b></p>
		</div>
	</div>
	<div class="col-sm-3"></div>
</div>
<?php
	}
?>
<?php
	if ($szamol_bekuldott_filmek[0] == "0") {
?>
<br />
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="alert alert-dismissible alert-success">
		  <p class="mb-0">Jelenleg nincs beküldött film! Nincs mit ellenőrizni.</b></p>
		</div>
	</div>
	<div class="col-sm-3"></div>
</div>
<?php
	}
?>
<br />
<?php
	while ($row = mysqli_fetch_array($bekuldott_filmek)) {
?>
<div class="row">
<div class="col-sm-2"></div>
<div class="col-sm-8">
<div class="card border-dark">
  <div class="card-header"><a href="<?=$row["film_link"]?>"><button type="button" class="btn btn-primary">Beküldött link</button></a> <a href="?elfogadas=<?=$row["id"]?>"><button type="button" class="btn btn-success">Elfogadás</button></a> <a href="?elutasitas=<?=$row["id"]?>"><button type="button" class="btn btn-warning">Elutasítás</button></a></div>
  <div class="card-body">
	<h4 class="card-title"><b><?=$row["cim"]?></b><br /><small>(<?=$row["eredeti_cim"]?>)</small></h4>
	<p class="card-text">
		
		<div class="row">
			<div class="col-sm-6">
				<b>Megjelenés éve:</b> <?=$row["megjelenes"]?> <br /> <b>Kategóriák:</b> <?=$row["kategoria"]?> <br /> <b>Hossza:</b> <?=$row["hossza"]?><br />
				<b>Értékelés:</b> 
				<?php
					if ($row["ertekeles"] >= 2) {
						echo '<span class="fa fa-star checked"></span>';
					}
					else {
						echo '<span class="fa fa-star"></span>';
					}
					if ($row["ertekeles"] >= 3) {
						echo '<span class="fa fa-star checked"></span>';
					}
					else {
						echo '<span class="fa fa-star"></span>';
					}
					if ($row["ertekeles"] >= 5) {
						echo '<span class="fa fa-star checked"></span>';
					}
					else {
						echo '<span class="fa fa-star"></span>';
					}
					if ($row["ertekeles"] >= 7) {
						echo '<span class="fa fa-star checked"></span>';
					}
					else {
						echo '<span class="fa fa-star"></span>';
					}
					if ($row["ertekeles"] >= 8) {
						echo '<span class="fa fa-star checked"></span>';
					}
					else {
						echo '<span class="fa fa-star"></span>';
					}
				?>
				<br />
				<br />
				<b>Leírás:</b><br />
				<?=$row["leiras"]?><br />
			</div>
			<div class="col-sm-6"><img class="shadow rounded border border-primary" src="<?=$row["kep"]?>" width="300px" /></div>
		</div>
	</p>
  </div>
</div>
<div class="col-sm-2"></div>
</div>
</div>
<br />
<?php
	}
?>
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