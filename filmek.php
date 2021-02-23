<?php
	session_start();
	include('inc/config.php');
	include('inc/lapozo.php');
	
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
	
?>
<html>
	<?php include("tartalom/head.php"); ?>
<body>

<!-- JS kód -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<!--JS vége-->

<?php include("tartalom/navbar.php"); ?>

<!-- CONTENT -->
<div class="container">

<br />

<div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
  <a href="filmek.php?listazas=evszam_szerint&keres=<?=$keres_cim?>&kategoria=<?=$kategoria_keres?>"><button type="button" class="btn btn-primary">Évszám szerint</button></a> <a href="filmek.php?keres=<?=$keres_cim?>&kategoria=<?=$kategoria_keres?>"><button type="button" class="btn btn-primary">Feltöltés szerint</button></a>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kategoriak_modal">
  Kategóriák
  </button>
  <br />
  <br />
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
	
	if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $no_of_records_per_page = 5;
        $offset = ($page-1) * $no_of_records_per_page;

        //$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);
        // Check linkection
        if (mysqli_connect_errno()){
            echo "Sikertelen kapcsolódás az adatbázishoz: " . mysqli_connect_error();
            die();
        }

        $total_pages_sql = "SELECT COUNT(*) FROM uj_filmek $keres $kategoria";
        $result = mysqli_query($link,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM uj_filmek $keres $kategoria ORDER BY $listazas DESC LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($link,$sql);
        ?>
		
	<div class="row">
		<div class="col-sm-6">
			<ul class="pagination">
				<?php //include("lapozo.php"); ?>
				<li><a class='page-link' href="?page=1&listazas=<?=$evszam_szerint?>&keres=<?=$keres_cim?>&kategoria=<?=$kategoria_keres?>">Első</a></li>
				<li class="<?php if($page <= 1){ echo 'disabled'; } ?>">
					<a class='page-link' href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>&listazas=<?=$evszam_szerint?>&keres=<?=$keres_cim?>&kategoria=<?=$kategoria_keres?>">Előző</a>
				</li>
				<li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>">
					<a class='page-link' href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>&listazas=<?=$evszam_szerint?>&keres=<?=$keres_cim?>&kategoria=<?=$kategoria_keres?>">Következő</a>
				</li>
				<li><a class='page-link' href="?page=<?php echo $total_pages; ?>&listazas=<?=$evszam_szerint?>&keres=<?=$keres_cim?>&kategoria=<?=$kategoria_keres?>">Utolsó</a></li>
			</ul>
		</div>
		<div class="col-sm-6">
		<p class="text-right"><b><?php echo $page ." - ". $total_pages; ?></b></p>
		</div>
	</div>
	
		<?php
		while($row = mysqli_fetch_array($res_data)){
	
	$film_feltolto = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM felhasznalok WHERE username='".$row["felhasznalo"]."'"));
	  ?>
	<div class="card border-dark">
	  <div class="card-header"><a target="_blank" href="<?=$row["film_link"]?>"><button type="button" class="btn btn-primary">Megtekintés</button></a>  <a href="film.php?id=<?=$row["id"]?>"><button type="button" class="btn btn-primary">Film adatlapja</button></a> <a href="hibas_link.php?id=<?=$row["id"]?>"><small class="pull-right">Film jelentése</small></a></div>
	  <div class="card-body">
		<h4 class="card-title"><b><?=$row["cim"]?></b><br /><small>(<?=$row["eredeti_cim"]?>)</small></h4>
		<p class="card-text">
			
			<div class="row">
				<div class="col-sm-6">
					<b>Megjelenés éve:</b> <?=$row["megjelenes"]?> <br /> <b>Kategóriák:</b> <?=$row["kategoria"]?> <br /> <b>Hossza:</b> <?=$row["hossza"]?><br /> <b>Beküldő:</b> <a href="profil.php?id=<?=$film_feltolto["id"]?>"><?=$film_feltolto["username"]?></a> <br />
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
	<br />
	<!-- online-filmek-vizuál -->
	<ins class="adsbygoogle"
		 style="display:block"
		 data-ad-client="ca-pub-9311254499950177"
		 data-ad-slot="7585036895"
		 data-ad-format="auto"
		 data-full-width-responsive="true"></ins>
	<script>
		 (adsbygoogle = window.adsbygoogle || []).push({});
	</script>
	<br />
	<?php
	}
	?>
	<div class="row">
		<div class="col-sm-6">
			<ul class="pagination">
				<?php //include("lapozo.php"); ?>
				<li><a class='page-link' href="?page=1&listazas=<?=$evszam_szerint?>&keres=<?=$keres_cim?>&kategoria=<?=$kategoria_keres?>">Első</a></li>
				<li class="<?php if($page <= 1){ echo 'disabled'; } ?>">
					<a class='page-link' href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>&listazas=<?=$evszam_szerint?>&keres=<?=$keres_cim?>&kategoria=<?=$kategoria_keres?>">Előző</a>
				</li>
				<li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>">
					<a class='page-link' href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>&listazas=<?=$evszam_szerint?>&keres=<?=$keres_cim?>&kategoria=<?=$kategoria_keres?>">Következő</a>
				</li>
				<li><a class='page-link' href="?page=<?php echo $total_pages; ?>&listazas=<?=$evszam_szerint?>&keres=<?=$keres_cim?>&kategoria=<?=$kategoria_keres?>">Utolsó</a></li>
			</ul>
		</div>
		<div class="col-sm-6">
		<p class="text-right"><b><?php echo $page ." - ". $total_pages; ?></b></p>
		</div>
	</div>
  </div>
  <div class="col-sm-2"></div>
</div>

<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<?php include("tartalom/footer.php"); ?>
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