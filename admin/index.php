<?php

// Session start
session_start();

// Konfig betöltése
include('../inc/config.php');

if (!empty($_SESSION["username"])) {
	header("Location: belepve.php");
}

// MySQLi betöltése
$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);

?>
<?php include("../tartalom/head_admin.php"); ?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><?=navbar_title?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Bejelentkezés</a>
      </li>
    </ul>
  </div>
</nav>
<!-- NAVBAR VÉGE -->

<!-- CONTENT -->
<div class="container">

<br />

<div class="row">
	<div class="col-sm-2"></div>
		<div class="col-sm-12">
			<div class="card border-dark">
			  <div class="card-header">Bejelentkezés</div>
			  <div class="card-body">
				<p class="card-text">
				<form method="POST" action="admin_belepes.php">
					<table class="table">
						<tr>
							<td>Felhasználói név</td>
							<td><input class="form-control" type="text" name="username" /></td>
						</tr>
						<tr>
							<td>Jelszó</td>
							<td><input class="form-control" type="password" name="jelszo" /></td>
						</tr>
						<tr>
							<td></td>
							<td><input class="btn btn-success" type="submit" value="Belépés" /></td>
						</tr>
					</table>
				</form>
				</p>
			  </div>
			</div>
		</div>
	</div>
  <div class="col-sm-2"></div>
</div>


</div>
</body>
</html>