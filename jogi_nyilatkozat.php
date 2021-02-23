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
			  <div class="card-header">Jogi nyilatkozat</div>
			  <div class="card-body">
				<p class="card-text">
					<p class=MsoNormal style='line-height:normal'><span style='font-size:12.0pt;
					font-family:"Times New Roman","serif"'>Az </span><b><span style='font-size:
					10.5pt;font-family:"Times New Roman","serif"'>online-filmek.ml</span></b><span style='font-size:12.0pt;font-family:"Times New Roman","serif"'> weboldal
					(továbbiakban: Szolgáltató) működésére az elektronikus kereskedelmi
					szolgáltatások, valamint az információs társadalommal összefüggő szolgáltatások
					egyes kérdéseiről szóló 2001. évi CVIII. törvény (továbbiakban: Ektv.)
					szabályozásai vonatkoznak. </span></p>
					<p class=MsoNormal style='line-height:normal'><span style='font-size:12.0pt;
					font-family:"Times New Roman","serif"'>Az Ektv. 2. § (1) alapján „Információs
					társadalommal összefüggő szolgáltatás nyújtásának megkezdéséhez, illetve
					folytatásához előzetes engedély vagy bármely ezzel azonos joghatású hatósági
					határozat nem szükséges”. </span></p>
					<p class=MsoNormal style='line-height:normal'><span style='font-size:12.0pt;
					font-family:"Times New Roman","serif"'>Szolgáltató az Ektv. 2. § ld)
					bekezdésében rögzítettek alapján, mint közvetítő szolgáltató az „információk
					megtalálását elősegítő segédeszközöket biztosít az igénybe vevő számára (keresőszolgáltatás)”.
					Az Ektv. 2. § e) bekezdése értelmében: „Információ: bármely, elektronikus úton
					feldolgozható, tárolható, továbbítható adat, jel, kép.. </span></p>
					<p class=MsoNormal style='line-height:normal'><b><span style='font-size:12.0pt;
					font-family:"Times New Roman","serif"'>A Szolgáltató által fenntartott weboldal
					egy tematikusan kategorizált, tartalmi elemeket megjelenítő,
					közvetítető szolgáltatás. </span></b><span style='font-size:12.0pt;font-family:"Times New Roman","serif"'>
					Az Ektv. 7. § (2) értelmében „a közvetítő szolgáltató a más által rendelkezésre
					bocsátott, a közvetítő szolgáltató által… továbbított, tárolt vagy
					hozzáférhetővé tett információért… nem felel”. A megosztott információkért
					teljes felelősséggel az eredeti, tényleges tartalomszolgáltató tartozik. </span></p>
					<p class=MsoNormal style='line-height:normal'><span style='font-size:12.0pt;
					font-family:"Times New Roman","serif"'>Az Ektv. 7. § (3) értelmében „a
					közvetítő szolgáltató nem köteles ellenőrizni az általa csak továbbított,
					tárolt, hozzáférhetővé tett információt. </span></p>
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