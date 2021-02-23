<?php

	//////////////////////////////////////
	//			Created by:				//
	//		   crosman-web.hu			//
	//////////////////////////////////////
	
session_start();
include('../inc/config.php');
$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);

if ($_GET["feldolgoz"] == "film_bekuld") {
	
	// POST ADATOK
	$db_id = $_POST["db_id"];
	$cim = $_POST["cim"];
	$eredeti_cim = $_POST["eredeti_cim"];
	$leiras = $_POST["leiras"];
	$megjelenes = $_POST["megjelenes"];
	$hossza = $_POST["hossza"];
	$ertekeles = $_POST["ertekeles"];
	$kategoria = $_POST["kategoria"];
	$kep = $_POST["kep"];
	$film_link = $_POST["film_link"];
	
	echo $db_id."<br />";
	echo $cim."<br />";
	echo $eredeti_cim."<br />";
	echo $leiras."<br />";
	echo $megjelenes."<br />";
	echo $hossza."<br />";
	echo $ertekeles."<br />";
	echo $kategoria."<br />";
	echo $kep."<br />";
	echo $film_link."<br />";
	
	mysqli_query($link, "INSERT INTO `uj_filmek`(`id`, `db_id`, `cim`, `eredeti_cim`, `leiras`, `megjelenes`, `hossza`, `ertekeles`, `kategoria`, `kep`, `film_link`) VALUES (NULL, '$db_id', '$cim', '$eredeti_cim', '$leiras', '$megjelenes', '$hossza', '$ertekeles', '$kategoria', '$kep', '$film_link')");
	echo mysqli_error($link);
	header("Location: film_adatbazishoz_adas.php?id=");
}

if (isset($_GET['id']) && $_GET['id']!="") {
	
	$api_kulcs = "23a4c5c600f76625a6851900ff31d697";
	$nyelv = "hu-HU";
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
	$kategoria = var_export(implode(', ',$kategoriak), true);
	$kep = "https://image.tmdb.org/t/p/original".$result['poster_path'];
	
	?>
	<form method="POST" action="?feldolgoz=film_bekuld">
		<table width="100%px">
			<tr>
				<td>Adatbázis ID:</td>
				<td><input type="text" size="100" value="<?=$db_id?>" name="db_id" /></td>
			</tr>
			<tr>
				<td>Magyar cím</td>
				<td><input type="text" size="100" value="<?=$cim?>" name="cim" /></td>
			</tr>
			<tr>
				<td>Eredeti cím:</td>
				<td><input type="text" size="100" value="<?=$eredeti_cim?>" name="eredeti_cim" /></td>
			</tr>
			<tr>
				<td>Leírás:</td>
				<td><textarea name="leiras"><?=$leiras?></textarea></td>
			</tr>
			<tr>
				<td>Megjelenés:</td>
				<td><input type="text" size="100" value="<?=$megjelenes?>" name="megjelenes" /></td>
			</tr>
			<tr>
				<td>Hossza:</td>
				<td><input type="text" size="100" value="<?=$hossza?>" name="hossza" /></td>
			</tr>
			<tr>
				<td>Értékelés:</td>
				<td><input type="text" size="100" value="<?=$ertekeles?>" name="ertekeles" /></td>
			</tr>
			<tr>
				<td>Kategória:</td>
				<td><input type="text" size="100" value="<?=$kategoria?>" name="kategoria" /></td>
			</tr>
			<tr>
				<td>Kép:</td>
				<td><input type="text" size="100" value="<?=$kep?>" name="kep" /></td>
			</tr>
			<tr>
				<td>Film link:</td>
				<td><input type="text" size="100" value="http://url.crosman-web.hu/index.php?code=" name="film_link" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Feltöltés" /></td>
			</tr>
		</table>
	</form>
	
	<?php
	
}
else {
	//header("Location: api_id_keres.php");
	echo "Kötelező megadni film ID-t!";
}

?>