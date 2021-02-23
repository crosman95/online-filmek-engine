<?php
	session_start();
	if (!empty($_SESSION["username"])) {
		header("Location: index.php");
	}
	include('inc/config.php');
	
	$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);
	
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
<?php
	if ($_GET["hiba"] == "felhasznalo") {
?>
<br />
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="alert alert-dismissible alert-warning">
		  <h4 class="alert-heading">Sikertelen regisztráció!</h4>
		  <p class="mb-0">Ezzel a felhasználói névvel már regisztrált valaki. Kérlek válassz másikat!</p>
		</div>
	</div>
	<div class="col-sm-2"></div>
</div>
<?php
	}
?>
<?php
	if ($_GET["hiba"] == "jelszo") {
?>
<br />
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="alert alert-dismissible alert-warning">
		  <h4 class="alert-heading">Sikertelen regisztráció!</h4>
		  <p class="mb-0">A megadott jelszavak nem egyeznek. Kérlek próbáld újra!</p>
		</div>
	</div>
	<div class="col-sm-2"></div>
</div>
<?php
	}
?>
<?php
	if ($_GET["hiba"] == "email_adatbazis") {
?>
<br />
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="alert alert-dismissible alert-warning">
		  <h4 class="alert-heading">Sikertelen regisztráció!</h4>
		  <p class="mb-0">A megadott e-mail címmel már regisztráltak!</p>
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
			  <div class="card-header">Regisztráció</div>
			  <div class="card-body">
				<h4 class="card-title">A következő adatokat töltsd ki</h4>
				<p class="card-text">
					<div class="table-responsive">
						<form method="POST" action="engine/regisztracio_feldolgoz.php">
							<table class="table">
								<tr>
									<td>Felhasználói név:</td>
									<td><input required class="form-control" type="text" placeholder="(kötelező)" name="username" /></td>
								</tr>
								<tr>
									<td>Jelszó:</td>
									<td><input required onkeyup='check();' class="form-control" type="password" placeholder="(kötelező)" name="jelszo" /></td>
								</tr>
								<tr>
									<td>Jelszó ismét:</td>
									<td><input required onkeyup='check();' class="form-control" type="password" placeholder="(kötelező)" name="jelszo2" /></td>
								</tr>
								<tr>
									<td>E-mail:</td>
									<td><input required class="form-control" type="text" placeholder="(kötelező)" name="email" /></td>
								</tr>
								<tr>
									<td>Születési dátum:</td>
									<td><input class="form-control" type="text" placeholder="(nem kötelező) 1990. 01. 01. " name="szuletesi_datum" /></td>
								</tr>
								<tr>
									<td>Kedvenc filmed:</td>
									<td><input class="form-control" type="text" placeholder="(nem kötelező)" name="kedvenc_film" /></td>
								</tr>
								<tr>
									<td></td>
									<td>
										<div class="custom-control custom-switch">
										  <input type="checkbox" name="hirlevel" class="custom-control-input" id="hirlevel" value="true" checked="">
										  <label class="custom-control-label" for="hirlevel">Szeretnél feliratkozni a hírlevélre?</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>Avatar:</td>
									<td>
										<img src="img/avatars/1.png" width="100px" />
										<input type="radio" class="form-check-input" name="avatar" id="optionsRadios3" value="1">
										<img src="img/avatars/2.png" width="100px" />
										<input type="radio" class="form-check-input" name="avatar" id="optionsRadios3" value="2">
										<img src="img/avatars/3.png" width="100px" />
										<input type="radio" class="form-check-input" name="avatar" id="optionsRadios3" value="3">
										<br />
										<img src="img/avatars/4.png" width="100px" />
										<input type="radio" class="form-check-input" name="avatar" id="optionsRadios3" value="4">
										<img src="img/avatars/5.png" width="100px" />
										<input type="radio" class="form-check-input" name="avatar" id="optionsRadios3" value="5">
										<img src="img/avatars/6.png" width="100px" />
										<input type="radio" class="form-check-input" name="avatar" id="optionsRadios3" value="6">
									</td>
								</tr>
								<tr>
									<td></td>
									<td><input class="btn btn-success" type="submit" value="Regisztráció" /></td>
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