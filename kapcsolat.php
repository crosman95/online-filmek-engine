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
	
	if (!empty($_SESSION["username"])) {
		$felhasznalo = mysqli_query($link, "SELECT * FROM felhasznalok WHERE username='".$_SESSION["username"]."'");
		$felhasznalo_leker = mysqli_fetch_array($felhasznalo);
	}
	
	$fh = mysqli_query($link, "SELECT * FROM felhasznalok WHERE id='$id'");
	$fh_leker = mysqli_fetch_array($fh);
	
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
			  <div class="card-header">Kapcsolat</div>
			  <div class="card-body">
				<p class="card-text">
					<b>Elérhetőségek</b><br />
					<br />
					Tartalom eltávolítási politika Ha ön szerzői jog tulajdonosa és szeretné jelenteni vagy kérni egy tartalom eltávolítását,kérjük írjon emailt az <b>online-filmek@protonmail.com</b> címre. így el tudjuk távolítani a jogsértő anyagot és végleg tiltani, hogy ne legyen feltölthető újra.
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