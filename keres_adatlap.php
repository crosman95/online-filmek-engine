<?php
	session_start();
	include('inc/config.php');
	
	$film_id = $_GET["id"];
	
	$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);
	$lekerdez = mysqli_query($link, "SELECT * FROM film_keres WHERE id=$film_id");
	
	if (!empty($_SESSION["username"])) {
		$felhasznalo = mysqli_query($link, "SELECT * FROM felhasznalok WHERE username='".$_SESSION["username"]."'");
		$felhasznalo_leker = mysqli_fetch_array($felhasznalo);
		$id = $felhasznalo_leker["id"];
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
  <?php
	$row = mysqli_fetch_array($lekerdez);
	if (empty($row["id"])) {
		header("Location: filmek.php");
	}
  ?>
  <div class="col-sm-8">
  <div class="card border-dark">
	  <div class="card-header">Kérési azonosító: <?=$row["id"]?></div>
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
	</div>
  <br />

  <div class="col-sm-2"></div>
</div>
<!-- CONTENT VÉGE -->

<br />
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<?php include("tartalom/footer.php"); ?>
	</div>
	<div class="col-sm-2"></div>
</div>
</div>
</body>
</html>