<?php
	session_start();
	include('inc/config.php');
	
	if ($_GET["listazas"] == "evszam_szerint") {
		$listazas = "megjelenes";
	}
	else {
		$listazas = "id";
	}
	
	$id = $_GET["id"];
	
	$limit = "5";
	
	$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);
	$lekerdez = mysqli_query($link, "SELECT * FROM uj_filmek WHERE id='$id'");
	
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
		<div class="col-sm-8">
			<?php
				if (!empty($_SESSION["username"])) {
					$fh = mysqli_query($link, "SELECT * FROM felhasznalok WHERE id='$id'");
					$fh_leker = mysqli_fetch_array($fh);
			?>
			<div class="card border-dark">
			  <div class="card-header">Film jelentése</div>
			  <div class="card-body">
				<p class="card-text">
					<?php $hibas_film = mysqli_fetch_array($lekerdez); ?>
					<b>Hibás film jelentése</b><br />
					A következő című filmet szeretnéd jelenteni: <b><?=$hibas_film["cim"]?></b><br />
					Kérlek válassz hibát:
					<form method="POST" action="engine/hibas_link_bekuld.php">
					<select name="hiba" class="custom-select">
						<option value="Hibás link">Hibás link</option>
						<option value="Hibás leírás">Hibás leírás</option>
						<option value="Dupla feltöltés">Dupla feltöltés</option>
						<option value="Tartalom törlése">Jogvédett tartalom törlése</option>
					</select>
					<br />
					<input type="hidden" value="<?=$hibas_film["id"]?>" name="film_id" />
					<input type="hidden" value="<?=$hibas_film["cim"]?>" name="film_cim" />
					<input class="form-control" type="hidden" name="email" required value="<?=$fh_leker["email"]?>" />
					<br />
					<input type="submit" class="btn btn-primary" value="Jelentés" />
					</form>
					<small>* Indokolatlan jelentés vagy többszörös hibás jelentés után kitiltásban részesülhetsz!</small>
				</p>
			  </div>
			</div>
			<?php
				} else {
			?>
			<div class="card border-dark">
			  <div class="card-header">Film jelentése</div>
			  <div class="card-body">
				<p class="card-text">
					<?php $hibas_film = mysqli_fetch_array($lekerdez); ?>
					<b>Hibás film jelentése</b><br />
					A következő című filmet szeretnéd jelenteni: <b><?=$hibas_film["cim"]?></b><br />
					Kérlek válassz hibát:
					<form method="POST" action="engine/hibas_link_bekuld.php">
					<select name="hiba" class="custom-select">
						<option value="Hibás link">Hibás link</option>
						<option value="Hibás leírás">Hibás leírás</option>
						<option value="Dupla feltöltés">Dupla feltöltés</option>
						<option value="Tartalom törlése">Jogvédett tartalom törlése</option>
					</select>
					<br />
					<input type="hidden" value="<?=$hibas_film["id"]?>" name="film_id" />
					<input type="hidden" value="<?=$hibas_film["cim"]?>" name="film_cim" />
					<br />
					<input class="form-control" type="text" name="email" required placeholder="E-mail cím" />
					<br />
					<input type="submit" class="btn btn-primary" value="Jelentés" />
					</form>
					<small>* Csak akkor fogadunk el jelentést, ha az e-mail cím valós. Másképpen figyelmen kívül hagyjuk.</small>
				</p>
			  </div>
			</div>
			<?php
				}
			?>
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