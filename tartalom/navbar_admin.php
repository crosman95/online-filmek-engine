<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><?=navbar_title?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
	  <?php
		if(!empty($_SESSION["username"])) {
			if ($fetch_array["rang"] > 8) {
	  ?>
	  <li class="nav-item">
        <a class="nav-link" href="index.php">Kezdőlap
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="filmek.php">Filmek</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="bekuldott_filmek.php">Beküldött filmek</a>
      </li>

	  <?php
		}
		}
	  ?>
    </ul>
	<ul class="nav navbar-nav navbar-right">
	  <?php
		if ($fetch_array["rang"] > 8) {
	  ?>
	  <li class="nav-item">
        <a class="nav-link" href="../index.php">Vissza az oldalra</a>
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