<?php
	session_start();
	if (!empty($_SESSION["username"])) {
		header("Location: index.php");
	}
	include('inc/config.php');
	
	$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);
	
?>
<html>
	<?php include("tartalom/head.php"); ?>
<body>

<?php include("tartalom/navbar.php"); ?>

<!-- CONTENT -->
<div class="container">
<?php
	if ($_GET["feldolgoz"] == "hiba") {
?>
<br />
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="alert alert-dismissible alert-warning">
		  <h4 class="alert-heading">Hiba!</h4>
		  <p class="mb-0">Hibás adatok, kérlek próbáld újra! <br />Ha még nem regisztráltál akkor bejelentkezés előtt kérlek tedd meg.</p>
		</div>
	</div>
	<div class="col-sm-2"></div>
</div>
<?php
	}
?>
<?php
	if ($_GET["sikeres"] == "regisztralva") {
?>
<br />
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="alert alert-dismissible alert-success">
		  <h4 class="alert-heading">Sikeres regisztráció!</h4>
		  <p class="mb-0">Sikeresen regisztráltál az oldalra! A megadott adatokkal beléphetsz!</p>
		</div>
	</div>
	<div class="col-sm-2"></div>
</div>
<?php
	}
?>

<br />

<div class="row">
	<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="card border-dark">
			  <div class="card-header">Bejelentekzés</div>
			  <div class="card-body">
				<h4 class="card-title">Belépés az oldalra</h4>
				<p class="card-text">
					<div class="table-responsive">
						<form method="POST" action="engine/bejelentkezes_ellenorzes.php">
							<table class="table">
								<tr>
									<td>Felhasználói név:</td>
									<td><input class="form-control" type="text" name="username" /></td>
								</tr>
								<tr>
									<td>Jelszó:</td>
									<td><input class="form-control" type="password" name="jelszo" /></td>
								</tr>
								<tr>
									<td></td>
									<td><input class="btn btn-success" type="submit" value="Bejelentkezés" /></td>
								</tr>
							</table>
						</form>
					</div>
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