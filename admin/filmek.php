<?php
	session_start();
	include('../inc/config.php');
	
	if ($_GET["listazas"] == "evszam_szerint") {
		$evszam_szerint = "evszam_szerint";
		$listazas = "megjelenes";
	}
	else {
		$evszam_szerint = "id";
		$listazas = "id";
	}
	
	if(!empty($_GET["keres"])) {
		//echo $_GET["keres"];
		$keres = "WHERE `cim` LIKE '%".$_GET["keres"]."%' OR `eredeti_cim` LIKE '%".$_GET["keres"]."%'";
		//$keres = "WHERE MATCH(cim,eredeti_cim,leiras) AGAINST ('%".$_GET["keres"]."%')";
		$keres_cim = $_GET["keres"];
	}
	else {
		$keres = "";
		$keres_cim = "";
	}
	
	if(!empty($_GET["kategoria"])) {
		$kategoria = "WHERE kategoria LIKE '%".$_GET["kategoria"]."%'";
		$kategoria_keres = $_GET["kategoria"];
	}
	
	$limit = "5";
	
	$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);
	$lekerdez = mysqli_query($link, "SELECT * FROM uj_filmek $keres $kategoria ORDER BY $listazas DESC LIMIT $limit");
	
	if (!empty($_SESSION["username"])) {
		$felhasznalo = mysqli_query($link, "SELECT * FROM felhasznalok WHERE username='".$_SESSION["username"]."'");
		$felhasznalo_leker = mysqli_fetch_array($felhasznalo);
	}
	
	$fh = mysqli_query($link, "SELECT * FROM felhasznalok WHERE id='$id'");
	$fh_leker = mysqli_fetch_array($fh);
	
	// SESSION felhasználó
	$felhasznalo = $_SESSION["username"];

	// MySQLi lekérdezés
	$lekerdez = mysqli_query($link, "SELECT * FROM felhasznalok WHERE username='$felhasznalo'");
	$fetch_array = mysqli_fetch_array($lekerdez);

	if ($fetch_array["rang"] > 8) {
		//echo "Ő egy admin";
	} else {
		header("Location: ../index.php");
	}
	
?>
<html>
	<?php include("../tartalom/head_admin.php"); ?>
<body>

<!-- JS kód -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<!--JS vége-->

<?php include("../tartalom/navbar_admin.php"); ?>

<!-- CONTENT -->
<div class="container">

<br />

<div class="row">
<?php
	if (!empty($_GET["torles"])) {
		$id = $_GET["torles"];
		
		mysqli_query($link,"DELETE FROM uj_filmek WHERE id=$id");
?>
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="alert alert-dismissible alert-warning">
		  <p class="mb-0">Sikeresen törölted a filmet!</b></p>
		</div>
	</div>
	<div class="col-sm-2"></div>
</div>
<br />
<?php
	}
?>
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
  <a href="filmek.php?listazas=evszam_szerint&keres=<?=$keres_cim?>"><button type="button" class="btn btn-primary">Évszám szerint</button></a> <a href="filmek.php?keres=<?=$keres_cim?>"><button type="button" class="btn btn-primary">Feltöltés szerint</button></a>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kategoriak_modal">
  Kategóriák
  </button>
  <br />
  <br />
  <?php
	$perPage = 30;
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$startAt = $perPage * ($page - 1);

	$query = "SELECT COUNT(*) as total FROM uj_filmek $keres $kategoria";
	$r = mysqli_fetch_assoc(mysqli_query($link, $query));

	$totalPages = ceil($r['total'] / $perPage);
	
	$oldalak_kiirasa = "5";
	
	$links = "";
	for ($i = 1; $i <= $totalPages; $i++) {
	  $links .= ($i != $page ) 
				? "	<li class='page-item'>
						<a class='page-link' href='filmek.php?page=$i&listazas=$evszam_szerint&keres=$keres_cim&kategoria=$kategoria_keres'>$i</a>
					</li>  "
				: "
					<li class='page-item active'>
						<a class='page-link' href='filmek.php?page=$page&listazas=$evszam_szerint&keres=$keres_cim&kategoria=$kategoria_keres'>$page</a>
					</li>
				";
	}
	
    /*if ($totalPages >=1 && $page <= $totalPages)
    {
        $counter = 1;
        $links = "";
        if ($page > ($oldalak_kiirasa/2)) { 
			//$links .= "<a href=\"?page=1\">1 </a> ... ";
			$links .= "	<li class='page-item'>
						<a class='page-link' href='teszt.php?page=1&listazas=$evszam_szerint&keres=$keres_cim&kategoria=$kategoria_keres'>1</a>
					</li>  ";
		}
        for ($x=$page; $x<=$totalPages;$x++)
        {

            if($counter < $oldalak_kiirasa)
                //$links .= "<a href=\"?page=" .$x."\">".$x." </a>";
				$links .="	<li class='page-item'>
						<a class='page-link' href='teszt.php?page=$x&listazas=$evszam_szerint&keres=$keres_cim&kategoria=$kategoria_keres'>$x</a>
					</li>  ";

            $counter++;
        }
        if ($page < $totalPages - ($oldalak_kiirasa/2)) { 
			//$links .= "... " . "<a href=\"?page=" .$totalPages."\">".$totalPages." </a>"; 
			$links .= "<li class='page-item'>
						<a class='page-link' href='teszt.php?page=$totalPages&listazas=$evszam_szerint&keres=$keres_cim&kategoria=$kategoria_keres'>$totalPages</a>
					</li>";
		}
    }*/


	$r = mysqli_query($link, $query);

	$teszt = "SELECT * FROM uj_filmek $keres $kategoria ORDER BY $listazas DESC LIMIT $startAt, $perPage";

	$fetch_array = mysqli_query($link, $teszt);
	
	//$row = mysqli_fetch_array($fetch_array);
	?>
	<div>
		<ul class="pagination">
			<?=$links?>
		</ul>
	</div>
	<?php
	/*if(!empty($kereses_hiba["id"])) {
		
	} else {
	?>
	<div class="card border-dark">
	  <div class="card-header">Keresés nem található!</div>
	  <div class="card-body">
		<p class="card-text">
			Sajnos amire próbáltál rákeresni nem találjuk az adatbázisunkban.
		</p>
	  </div>
	</div>
	<br />
	<?php
	}*/
	
	while($row = mysqli_fetch_array($fetch_array)) {
  
	?>
	<div class="card border-dark">
	  <div class="card-header"><a href="?torles=<?=$row["id"]?>"><button class="btn btn-warning">Film törlése</button></a></div>
	  <div class="card-body">
		<h4 class="card-title"><b><?=$row["cim"]?></b><br /><small>(<?=$row["eredeti_cim"]?>)</small></h4>
		<p class="card-text">
			<b>Megjelenés éve:</b> <?=$row["megjelenes"]?>,  <b>Kategóriák:</b> <?=$row["kategoria"]?>,  <b>Hossza:</b> <?=$row["hossza"]?>
		</p>
	  </div>
	</div>
	<br />
	<?php
	}
	?>
	<div>
		<ul class="pagination">
			<?=$links?>
		</ul>
	</div>
  </div>
  <div class="col-sm-2"></div>
</div>

<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<?php include("../tartalom/footer_admin.php"); ?>
	</div>
	<div class="col-sm-2"></div>
</div>

</div>
<!-- CONTENT VÉGE -->

<!-- Modal -->
<div class="modal fade" id="kategoriak_modal" tabindex="-1" role="dialog" aria-labelledby="kategoriak" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kategoriak_modal">Válassz kategóriát</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><a href='?kategoria=Akció'>Akció</a>, <a href='?kategoria=Kaland'>Kaland</a>, <a href='?kategoria=Animációs'>Animációs</a>, <a href='?kategoria=Vígjáték'>Vígjáték</a>, <a href='?kategoria=Bűnügyi'>Bűnügyi</a>, <a href='?kategoria=Dokumentum'>Dokumentum</a>, <a href='?kategoria=Dráma'>Dráma</a>, <a href='?kategoria=Családi'>Családi</a>, <a href='?kategoria=Fantasy'>Fantasy</a>, <a href='?kategoria=Történelmi'>Történelmi</a>, <a href='?kategoria=Horror'>Horror</a>, <a href='?kategoria=Zenei'>Zenei</a>, <a href='?kategoria=Rejtély'>Rejtély</a>, <a href='?kategoria=Romantikus'>Romantikus</a>, <a href='?kategoria=Sci-Fi'>Sci-Fi</a>, <a href='?kategoria=TV film'>TV film</a>, <a href='?kategoria=Thriller'>Thriller</a>, <a href='?kategoria=Háborús'>Háborús</a>, <a href='?kategoria=Western'>Western</a></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Bezárás</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal vége -->
</body>
</html>