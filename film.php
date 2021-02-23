<?php
	session_start();
	include('inc/config.php');
	
	$film_id = $_GET["id"];
	
	$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);
	$lekerdez = mysqli_query($link, "SELECT * FROM uj_filmek WHERE id=$film_id");
	
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
	  <div class="card-header"><a href="<?=$row["film_link"]?>"><button type="button" class="btn btn-primary">Megtekintés</button></a> <a href="hibas_link.php?id=<?=$row["id"]?>"><small class="pull-right">Film jelentése</small></a></div>
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

<br />
<?php
	$hozzaszolasok_lekerdezese = mysqli_query($link,"SELECT * FROM hozzaszolasok WHERE film_id='$film_id' ORDER BY id DESC");
	while ($hozzaszolasok = mysqli_fetch_array($hozzaszolasok_lekerdezese)) {
?>
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="card border-dark">
	  <div class="card-header"><?=$hozzaszolasok["nev"]?></div>
	  <div class="card-body">
		<p class="card-text">
			<?=$hozzaszolasok["hozzaszolas"]?>
		</p>
	  </div>
	</div>
	</div>
	<div class="col-sm-2"></div>
</div>
<br />
<?php
	}
	if (!empty($_SESSION["username"])) {
		
	// Ha be van jelentkezve akkor a felhasználó posztoljon
	
	$fh = mysqli_query($link, "SELECT * FROM felhasznalok WHERE id='$id'");
	$fh_leker = mysqli_fetch_array($fh);
?>
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="card border-dark">
	  <div class="card-header">Új hozzászólás írása</div>
	  <div class="card-body">
		<p class="card-text">
			<form method="POST" action="engine/hozzaszolas_bekuld.php">
				<input type="hidden" name="film_id" value="<?=$film_id?>" />
				<table >
					<tr>
						<td><input name="nev" type="hidden" required class="form-control" value="<?=$fh_leker["username"]?>"  /></td>
					</tr>
					<tr>
						<td><input name="email" type="hidden" required class="form-control" value="<?=$fh_leker["email"]?>" /></td>
					</tr>
					<tr style="vertical-align:top;">
						<td>Hozzászólás szövege:</td>
						<td><textarea name="hozzaszolas" required rows="6" cols="70" class="form-control" placeholder="Hozzászólásod szövege"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="Hozzászólok" class="btn btn-primary" /></td>
					</tr>
				</table>
			</form>
		</p>
	  </div>
	</div>
	</div>
	<div class="col-sm-2"></div>
</div>
<?php
	} else {
?>
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="card border-dark">
	  <div class="card-header">Új hozzászólás írása</div>
	  <div class="card-body">
		<p class="card-text">
			Ha szeretnél hozzászólni kérlek <a href="bejelentkezes.php">jelentkezz be</a> vagy <a href="regisztracio.php">regisztrálj</a>!
		</p>
	  </div>
	</div>
	</div>
	<div class="col-sm-2"></div>
</div>
<?php
	}
?>
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