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
			  <div class="card-header">Fejlesztések az oldalon</div>
			  <div class="card-body">
				<p class="card-text">
					<ul class="list-group">
						<li class="list-group-item active">2020. 12. 10.</li>
						<li class="list-group-item">Random 2 film a <a href="index.php">kezdőlap</a>on</li>
					</ul>
					<br />
					<ul class="list-group">
						<li class="list-group-item active">2020. 12. 07.</li>
						<li class="list-group-item">Új lapozó került be a <a href="filmek.php">filmek</a> oldalra.</li>
					</ul>
					<br />
					<ul class="list-group">
						<li class="list-group-item active">2020. 12. 05.</li>
						<li class="list-group-item"><a href="film_bekuldes.php">Film beküldése</a> felhasználóknak <small>(Mostantól bármilyen regisztrált tag tud filmet beküldeni az oldalra. Ellenőrzés után megjelenik!)</small></li>
					</ul>
					<br />
					<ul class="list-group">
						<li class="list-group-item active">2020. 12. 02.</li>
						<li class="list-group-item">Javítva egy hiba, miszerint mobiltelefon, tableten nem jelent meg a menü.</li>
					</ul>
					<br />
					<ul class="list-group">
						<li class="list-group-item active">2020. 12. 01.</li>
						<li class="list-group-item"><a href="regisztracio.php">Regisztráció</a> és <a href="bejelentkezes.php">bejelentkezés</a></li>
						<li class="list-group-item">Hozzászólás kizárólag regisztrált felhasználók számára</li>
					</ul>
					<br />
					<ul class="list-group">
						<li class="list-group-item active">2020. 11. 29.</li>
						<li class="list-group-item">Kereső motor (magyar és eredeti címben)</li>
						<li class="list-group-item">Kategória szerinti keresés</li>
						<li class="list-group-item">Navbar</li>
						<li class="list-group-item">Footer</li>
						<li class="list-group-item">Hibás film jelentése</li>
						<li class="list-group-item">Hozzászólás a film adatlapján</li>
						<li class="list-group-item">Ajánló menüpont</li>
						<li class="list-group-item">Lapozó rendszer</li>
						<li class="list-group-item">TheMovieDB API</li>
						<li class="list-group-item">Új adatbázis</li>
					</ul>
					<br />
					<ul class="list-group">
						<li class="list-group-item active">2020. 11. 08.</li>
						<li class="list-group-item">Rövidített URL címek</li>
						<li class="list-group-item">Film adatbázis</li>
						<li class="list-group-item">Bootswatch megjelenés</li>
					</ul>
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