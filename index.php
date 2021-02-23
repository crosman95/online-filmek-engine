<?php
	session_start();
	include('inc/config.php');
	
	if ($_GET["listazas"] == "evszam_szerint") {
		$listazas = "megjelenes";
	}
	else {
		$listazas = "id";
	}
	
	$limit = "5";
	
	$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);
	$lekerdez = mysqli_query($link, "SELECT * FROM filmek ORDER BY $listazas DESC LIMIT $limit");
	
	$adatbazis = mysqli_query($link, "SELECT COUNT(*) FROM `uj_filmek`");
	$szamol_adatbazis = mysqli_fetch_row($adatbazis);
	
	if (!empty($_SESSION["username"])) {
		$felhasznalo = mysqli_query($link, "SELECT * FROM felhasznalok WHERE username='".$_SESSION["username"]."'");
		$felhasznalo_leker = mysqli_fetch_array($felhasznalo);
	}
	
?>
<html>
	<?php include("tartalom/head.php"); ?>
<body>

<?php include("tartalom/navbar.php"); ?>

<!-- CONTENT -->
<div class="container">

<br />

<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="alert alert-dismissible alert-success">
		  <p class="mb-0">Jelenleg az adatbázisunkban <b><?=$szamol_adatbazis[0]?></b> film található meg.</p>
		</div>
	</div>
	<div class="col-sm-2"></div>
</div>

<br />

<div class="row">
<?php include("tartalom/random_3_film.php"); // ebből végül 2 film lett nem 3. :) ?>
</div>

<br />

<div class="row">
	<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="card border-dark">
			  <div class="card-header">Facebook oldalunk</div>
			  <div class="card-body">
				<p class="card-text">
					<center>Ide akár egy iframe is jöhet. index.php 62. sor!</center>
				</p>
			  </div>
			</div>
		</div>
	</div>
  <div class="col-sm-2"></div>
  <br />
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<?php include("tartalom/footer.php"); ?>
	</div>
	<div class="col-sm-2"></div>
</div>
</div>

</div>
</body>
</html>