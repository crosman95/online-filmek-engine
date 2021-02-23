<?php
	session_start();
	if (empty($_SESSION["username"])) {
		header("Location: regisztracio.php");
	}
	include('inc/config.php');
	
	$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);
	
	if (!empty($_SESSION["username"])) {
		$felhasznalo = mysqli_query($link, "SELECT * FROM felhasznalok WHERE username='".$_SESSION["username"]."'");
		$felhasznalo_leker = mysqli_fetch_array($felhasznalo);
	}
	
	if (empty($_GET["id"])) {
		$id = $felhasznalo_leker["id"];
	} else {
		$id = $_GET["id"];
	}
	
	$fh = mysqli_query($link, "SELECT * FROM felhasznalok WHERE id='$id'");
	$fh_leker = mysqli_fetch_array($fh);
	
	$felhasznalo = $fh_leker["username"];
	
	if (empty($fh_leker["id"])) {
		header("Location: index.php");
	}
	
	$szamol_bekuldott_filmek = mysqli_fetch_row(mysqli_query($link, "SELECT COUNT(*) FROM `uj_filmek` WHERE felhasznalo='$felhasznalo'"));
	
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
			<div class="card border-dark">
			  <div class="card-header"><b><?=$fh_leker["username"]?></b> profilja</div>
			  <div class="card-body">
				<p class="card-text">
					<div class="row">
						<div class="col-sm-3"><img src="<?=$fh_leker["avatar"]?>" width="200px" /></div>
						<div class="col-sm-7">
						<b>Felhasználói név</b>: <?=$fh_leker["username"]?><br />
						<b>Születési dátum</b>: <?php if (!empty($fh_leker["szuletesi_datum"])) {echo $fh_leker["szuletesi_datum"];} else { echo "N/A"; }?><br />
						<b>Kedvenc film</b>: <?php if (!empty($fh_leker["kedvenc_film"])) {echo $fh_leker["kedvenc_film"];} else { echo "N/A"; }?><br />
						<b>Rang</b>: 
						<?php
							if ($fh_leker["rang"] == "1") {
								echo "Felhasználó";
							}
							if ($fh_leker["rang"] == "6") {
								echo "VIP";
							}
							if ($fh_leker["rang"] == "7") {
								echo "Feltöltő";
							}
							if ($fh_leker["rang"] == "8") {
								echo "Moderátor";
							}
							if ($fh_leker["rang"] == "9") {
								echo "Adminisztrátor";
							}
							if ($fh_leker["rang"] == "10") {
								echo "Tulajdonos";
							}
						?>
						<br />
						<b>Beküldött filmek száma</b>: <?=$szamol_bekuldott_filmek[0]?> db<br />
						<b>Regisztráció ideje</b>: <?=$fh_leker["datum"]?><br />
						<b>Leírás</b>:<br />
						<?php
							if (empty($fh_leker["leiras"])) {
								echo "Ez a felhasználó még nem adott meg leírást a profiljához!";
							} else {
								echo $fh_leker["leiras"];
							}
						?>
						</div>
					</div>
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