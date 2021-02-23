<div class="col-sm-2"></div>
<?php
	$lekerdez = mysqli_query($link, "SELECT * FROM uj_filmek ORDER BY RAND() LIMIT 2");
	while ($slider = mysqli_fetch_array($lekerdez)) {
		//echo '<img class="d-block w-1" src="'.$slider["kep"].'" />';
?>
<div class="col-sm-4">
<div class="card mb-2">
  <h5 class="card-header"><?=$slider["cim"]?></h5>
  <br />
  <center><img class="border rounded" width="200px" src="<?=$slider["kep"]?>" /></center>
  <div class="card-body">
    <a href="<?=$slider["film_link"]?>" class="card-link">Megtekintés</a>
    <a href="film.php?id=<?=$slider["id"]?>" class="card-link">Film adatlap</a>
  </div>
  <div class="card-footer text-muted">
    <b>Megjelenés:</b> <?=$slider["megjelenes"]?><br />
    <b>Értékelés:</b>
	<?php
		if ($slider["ertekeles"] >= 2) {
			echo '<span class="fa fa-star checked"></span>';
		}
		else {
			echo '<span class="fa fa-star"></span>';
		}
		if ($slider["ertekeles"] >= 3) {
			echo '<span class="fa fa-star checked"></span>';
		}
		else {
			echo '<span class="fa fa-star"></span>';
		}
		if ($slider["ertekeles"] >= 5) {
			echo '<span class="fa fa-star checked"></span>';
		}
		else {
			echo '<span class="fa fa-star"></span>';
		}
		if ($slider["ertekeles"] >= 7) {
			echo '<span class="fa fa-star checked"></span>';
		}
		else {
			echo '<span class="fa fa-star"></span>';
		}
		if ($slider["ertekeles"] >= 8) {
			echo '<span class="fa fa-star checked"></span>';
		}
		else {
			echo '<span class="fa fa-star"></span>';
		}
	?>
  </div>
</div>
</div>
<?php
}
?>
<div class="col-sm-2"></div>