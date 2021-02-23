<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><?=navbar_title?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Kezdőlap
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="filmek.php">Filmek</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="ajanlo.php">Ajánló</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="film_bekuldes.php">Film beküldése</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="film_keres.php">Film kérés</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="keresek.php">Kérések</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="kapcsolat.php">Kapcsolat</a>
      </li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
      <?php
		if(!empty($_SESSION["username"])) {
	  ?>
	  <li class="nav-item">
        <a class="nav-link" href="profil.php">Profilom</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="kijelentkezes.php">Kijelentkezés</a>
      </li>
	  <?php
		if ($felhasznalo_leker["rang"] == 10) {
	  ?>
	  <li class="nav-item">
        <a class="nav-link" href="admin">Admin panel</a>
      </li>
	  <?php
		}
	  ?>
	  <?php
		} else {
	  ?>
	  <li class="nav-item">
        <a class="nav-link" href="bejelentkezes.php">Bejelentkezés</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="regisztracio.php">Regisztráció</a>
      </li>
	  <?php
		}
	  ?>
    </ul>
	
    <form class="form-inline my-2 my-lg-0" method="GET" action="filmek.php">
      <input class="form-control mr-sm-2" type="text" name="keres" placeholder="Keresés">
      <input class="btn btn-secondary my-2 my-sm-0" type="submit" value="Keresés">
	</form>
  </div>
</nav>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<!-- NAVBAR VÉGE -->