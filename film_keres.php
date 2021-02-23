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
	
?>
<html>
	<?php include("tartalom/head.php"); ?>
<body>

<?php include("tartalom/navbar.php"); ?>

<!-- CONTENT -->
<div class="container">
<?php
if ($_GET["feldolgoz"] == "adatbazisban") {
?>
<br />
<div class="row">
	<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="card border-dark">
			  <div class="card-header">Hiba!</div>
			  <div class="card-body">
				<p class="card-text">
					Ez a film már megtalálható az adatbázisban, vagy már valaki kérte, illetve a beküldött film még ellenőrzésre is várhat.
				</p>
			  </div>
			</div>
		</div>
	</div>
  <div class="col-sm-2"></div>
<?php
}
if ($_GET["feldolgoz"] == "film_bekuld") {
	
	$adatbazis_azonosito = htmlspecialchars($_POST["db_id"]);
	
	if (!empty($adatbazis_azonosito)) {
	// API BEHÍVÁSA
	//$user_id = adfly_user_id;
	//$api_kulcs = adfly_api;
	//$domain = htmlspecialchars($_POST["film_link"]);
	
	$db_id = htmlspecialchars($_POST["db_id"]);
	$cim = htmlspecialchars($_POST["cim"]);
	$eredeti_cim = htmlspecialchars($_POST["eredeti_cim"]);
	$leiras = htmlspecialchars($_POST["leiras"]);
	$megjelenes = htmlspecialchars($_POST["megjelenes"]);
	$hossza = htmlspecialchars($_POST["hossza"]);
	$ertekeles = htmlspecialchars($_POST["ertekeles"]);
	$kategoria = htmlspecialchars($_POST["kategoria"]);
	$kep = htmlspecialchars($_POST["kep"]);
	//$film_link = file_get_contents("http://api.adf.ly/api.php?key=$api_kulcs&uid=$user_id&advert_type=int&domain=adf.ly&url=$domain");
	$film_link = htmlspecialchars($_POST["film_link"]);
	$felhasznalo = htmlspecialchars($fh_leker["username"]);
	
	$ellenorzes = film_bekuld_check;
	//if (empty(htmlspecialchars($_POST["keresi_azonosito"]))) { $keresre = "false"; } else { $keresre = htmlspecialchars($_POST["keresi_azonosito"]); }
	
	$film_db_id_ellenorzes = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM uj_filmek WHERE db_id='$db_id'"));
	$bekuldott_db_id_ellenorzes = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM bekuldott_filmek WHERE db_id='$db_id'"));
	$film_cim_ellenorzes = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM uj_filmek WHERE cim='$cim'"));
	$bekuldott_cim_ellenorzes = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM bekuldott_filmek WHERE cim='$cim'"));
	$film_keres_cim_ellenorzes = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM film_keres WHERE cim='$cim'"));
	$film_keres_db_id_ellenorzes = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM film_keres WHERE db_id='$db_id'"));
	
	if ($film_db_id_ellenorzes["db_id"] == "" AND $bekuldott_db_id_ellenorzes["db_id"] == "" AND $film_cim_ellenorzes["cim"] == "" AND $bekuldott_cim_ellenorzes["cim"] == "" AND $film_keres_cim_ellenorzes["cim"] == "" AND $film_keres_db_id_ellenorzes["db_id"] == "") {
		mysqli_query($link, "INSERT INTO `film_keres`(`id`, `db_id`, `cim`, `eredeti_cim`, `leiras`, `megjelenes`, `hossza`, `ertekeles`, `kategoria`, `kep`, `film_link`, `felhasznalo`, `allapot`, `teljesitette`) VALUES (NULL,'$db_id','$cim','$eredeti_cim','$leiras','$megjelenes','$hossza','$ertekeles','$kategoria','$kep',NULL,'$felhasznalo','false',NULL)");
	}
	else {
		//echo "<br /> <b>Ez a film már megtalálható adatbázisban!</b> </br >";
		header("Location: film_bekuldes.php?feldolgoz=adatbazisban");
	}
		
?>
<br />
<div class="row">
	<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="card border-dark">
			  <div class="card-header">Kérés elküldve</div>
			  <div class="card-body">
				<p class="card-text">
					<b>Adatbázis azonosító:</b> <?=$db_id?><br />
					<b>Magyar cím:</b> <?=$cim?><br />
					<b>Eredeti cím:</b> <?=$eredeti_cim?><br />
					<b>Leírás:</b> <br /><?=$leiras?><br />
					<b>Megjelenés:</b> <?=$megjelenes?><br />
					<b>Hossza:</b> <?=$hossza?><br />
					<b>Értékelés:</b> <?=$ertekeles?><br />
					<b>Kategóriák:</b> <?=$kategoria?><br />
					<b>Kép:</b> <?=$kep?><br />
					<b>Felhasználó:</b> <?=$felhasznalo?><br />
				</p>
			  </div>
			</div>
		</div>
	</div>
  <div class="col-sm-2"></div>
<?php
} else {
?>
<br />
<div class="row">
	<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="card border-dark">
			  <div class="card-header">Hiba</div>
			  <div class="card-body">
				<p class="card-text">
					Valami nem jól sikerült, kérlek próbáld újra!
				</p>
			  </div>
			</div>
		</div>
	</div>
  <div class="col-sm-2"></div>
<?php
}
}
?>
<br />
<div class="row">
	<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="card border-dark">
			  <div class="card-header">Film kérése</div>
			  <div class="card-body">
				<p class="card-text">
					<?php
					if (isset($_GET['id']) && $_GET['id']!="") {
	
					$api_kulcs = tmdb_api;
					$nyelv = tmdb_nyelv;
					$film_id = $_GET['id'];
					
					// Film lekérdezés eleje
					
					$url = "https://api.themoviedb.org/3/movie/$film_id?api_key=$api_kulcs&language=$nyelv";
					
					$client = curl_init($url);
					curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
					curl_setopt($client, CURLOPT_HTTPHEADER, array("Accept: application/json"));
					$film_lekerdezes = curl_exec($client);
					curl_close($client);
					
					// Film lekérdezés vége
					
					// Film hosszának konvertálása eleje
					
					function convertToHoursMins($time, $format = '%02d:%02d') {
						if ($time < 1) {
							return;
						}
						$hours = floor($time / 60);
						$minutes = ($time % 60);
						return sprintf($format, $hours, $minutes);
					}
					
					// Film hosszának konvertálása vége
					
					$result = json_decode($film_lekerdezes, true);
					
					$kategoriak = array();
					
					foreach ($result["genres"] as $row) { $kategoriak[] = $row["name"]; }
					
					$db_id = $result["id"];
					$cim = $result["title"];
					$eredeti_cim = $result["original_title"];
					$leiras = $result["overview"];
					$megjelenes = substr($result["release_date"], 0, -6);
					$hossza = convertToHoursMins($result["runtime"], '%2d óra %02d perc');
					$ertekeles = $result["vote_average"];
					$kategoria_fele = var_export(implode(', ',$kategoriak), true);
					$kategoria = str_replace("'", '', $kategoria_fele);
					$kep = "https://image.tmdb.org/t/p/original".$result['poster_path'];
					
					?>
					<form method="POST" action="?feldolgoz=film_bekuld">
						<table width="100%px">
							<tr>
								<td></td>
								<td><input required class="form-control" type="hidden" value="<?=$db_id?>" name="db_id" /></td>
							</tr>
							<tr>
								<td></td>
								<td><input required class="form-control" type="hidden" size="100" value="<?=$cim?>" name="cim" /></td>
							</tr>
							<tr>
								<td></td>
								<td><input required class="form-control" type="hidden" size="100" value="<?=$eredeti_cim?>" name="eredeti_cim" /></td>
							</tr>
							<tr>
								<td></td>
								<td><textarea hidden required class="form-control" rows="10" name="leiras"><?=$leiras?></textarea></td>
							</tr>
							<tr>
								<td></td>
								<td><input required class="form-control" type="hidden" size="100" value="<?=$megjelenes?>" name="megjelenes" /></td>
							</tr>
							<tr>
								<td></td>
								<td><input required class="form-control" type="hidden" size="100" value="<?=$hossza?>" name="hossza" /></td>
							</tr>
							<tr>
								<td></td>
								<td><input required class="form-control" type="hidden" size="100" value="<?=$ertekeles?>" name="ertekeles" /></td>
							</tr>
							<tr>
								<td></td>
								<td><input required class="form-control" type="hidden" size="100" value="<?=$kategoria?>" name="kategoria" /></td>
							</tr>
							<tr>
								<td></td>
								<td><input required class="form-control" type="hidden" size="100" value="<?=$kep?>" name="kep" /></td>
							</tr>
							<tr>
								<td>Kért film címe:</td>
								<td><?=$cim?></td>
							</tr>
							<tr>
								<td>Kért film eredeti címe:</td>
								<td><?=$eredeti_cim?></td>
							</tr>
							<tr>
								<td>TheMovieDB azonosító:</td>
								<td><?=$db_id?></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Ha ezt a filmet kerested kattints a megerősítés gombra.</td>
								<td><input class="btn btn-success" type="submit" value="Megerősítés" /></td>
							</tr>
						</table>
					</form>
					
					<?php
					}
					else {
					?>
					<small>* Az ID így néz ki (https://www.themoviedb.org/movie/<b>238</b>-the-godfather)! Neked a számot kell beírnod ebbe a mezőbe. Jelen példában <b>238</b> a filmnek az azonosítója!</small>
					<form method="GET" action="film_keres.php">
						<table>
							<tr>
								<td><input required class="form-control" type="text" size="50" value="" placeholder="TheMovieDB ID" name="id" /></td>
								<td><input class="btn btn-success" type="submit" value="Lekérdezés" /></td>
							</tr>						
						</table>
					</form>
					<?php
					}
					?>
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