<?php
	//session_start();
	//include('inc/config.php');
	//$link = mysqli_connect(mysqli_ip, mysqli_nev, mysqli_jelszo, mysqli_db);
	//$szamol = mysqli_fetch_row(mysqli_query($link, "SELECT COUNT(*) FROM uj_filmek $keres $kategoria"));
	//$uj_filmek = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM uj_filmek $keres $kategoria"));
	
	//&listazas=$evszam_szerint&keres=$keres_cim&kategoria=$kategoria_keres
?>

<?PHP
 /* $NUMPERPAGE = 80; // max. number of items to display per page
  $this_page = "teszt.php";
  $data = $uj_filmek; // data array to be paginated
  //$num_results = $szamol[0];
  $num_results = count($data);*/
?>

<?PHP
  # Original PHP code by Chirp Internet: www.chirp.com.au
  # Please acknowledge use of this code by including this header.

  if(!isset($_GET['page']) || !$page = intval($_GET['page'])) {
    $page = 1;
  }
	// &listazas=$evszam_szerint&keres=$keres_cim&kategoria=$kategoria_keres
	
  // extra variables to append to navigation links (optional)
  $linkextra = [];
  if(isset($_GET['listazas']) && $listazas = $_GET['listazas']) { // repeat as needed for each extra variable
    $linkextra[] = "listazas=" . urlencode($evszam_szerint);
  }
  if(isset($_GET['keres']) && $keres = $_GET['keres']) { // repeat as needed for each extra variable
    $linkextra[] = "keres=" . urlencode($keres_cim);
  }
  if(isset($_GET['kategoria']) && $kategoria = $_GET['kategoria']) { // repeat as needed for each extra variable
    $linkextra[] = "kategoria=" . urlencode($kategoria_keres);
  }
  $linkextra = implode("&amp;", $linkextra);
  if($linkextra) {
    $linkextra .= "&amp;";
  }

  // build array containing links to all pages
  $tmp = [];
  for($p=1, $i=0; $i < $num_results; $p++, $i += $NUMPERPAGE) {
    if($page == $p) {
      // current page shown as bold, no link
      $tmp[] = "<ul class='pagination'><li class='page-item active'><a class='page-link' href=''><b>{$p}</b></a></li></ul>";
    } else {
      $tmp[] = "<ul class='pagination'><li class='page-item'><a class='page-link' href=\"{$this_page}?{$linkextra}page={$p}\"&listazas=$evszam_szerint&keres=$keres_cim&kategoria=$kategoria_keres>{$p}</a></li></ul>";
    }
  }

  // thin out the links (optional)
  for($i = count($tmp) - 3; $i > 1; $i--) {
    if(abs($page - $i - 1) > 2) {
      unset($tmp[$i]);
    }
  }

  // display page navigation iff data covers more than one page
  if(count($tmp) > 1) {
    echo '<ul class="pagination">';

    if($page > 1) {
      // display 'Prev' link
      echo "<li class='page-item'><a class='page-link' href=\"{$this_page}?{$linkextra}page=" . ($page - 1) . "\">&laquo; Előző</a></li>";
    } else {
      echo "<li class='page-item disabled'><a class='page-link' href=''>&laquo; Előző</a></li>";
    }

    $lastlink = 0;
    foreach($tmp as $i => $link) {
      if($i > $lastlink + 1) {
        echo "<li class='page-item'><a class='page-link' href=''>...</a></li>"; // where one or more links have been omitted
      } elseif($i) {
        echo "";
      }
      echo $link;
      $lastlink = $i;
    }

    if($page <= $lastlink) {
      // display 'Next' link
      echo "<li class='page-item'><a class='page-link' href=\"{$this_page}?{$linkextra}page=" . ($page + 1) . "\">Következő &raquo;</a></li>";
    } else {
		echo "<li class='page-item disabled'><a class='page-link' href=''>Következő &raquo;</a></li>";
	}

    echo "</ul>\n\n";
  }
?>

<?PHP
  /*$data = new \ArrayIterator($data); // NOT needed if $data is already an Iterator!
  $it = new \LimitIterator($data, ($page - 1) * $NUMPERPAGE, $NUMPERPAGE);
  try {
    $it->rewind();
    foreach($it as $row) {
      echo $row; // display record
    }
  } catch(\OutOfBoundsException $e) {
    echo "Error: Caught OutOfBoundsException";
  }*/
?>