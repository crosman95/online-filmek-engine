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
			  <div class="card-header">Felhasználási feltételek</div>
			  <div class="card-body">
				<p class="card-text">
					<p class="MsoNormal" style="margin-bottom:18.0pt">Az&nbsp; Online filmek (online-filmek.ml) portál
					(továbbiakban: Üzemeletető) &nbsp;és ön (portál (továbbiakban: Felhasználó) &nbsp;közt
					létrejövő szerződés. </p>
					<p class="MsoNormal" style="margin-bottom:18.0pt">Az Üzemeltető fenntartja a
					jogot, hogy jelen szerződést bármikor, előzetes bejelentés nélkül szabadon
					módosíthassa. Az oldal használatával ön kijelenti, hogy elfogadta a
					felhasználási feltételeket.</p>
					<p class="MsoNormal" style="margin-bottom:18.0pt"><b>Regisztráció</b></p>
					<p class="MsoNormal" style="margin-bottom:18.0pt">A szolgáltató fenntartja
					magának a jogot, hogy regisztrációkat indoklás nélkül visszautasítson, vagy
					bármikor visszavonjon.</p>
					<p class="MsoNormal" style="margin-bottom:18.0pt">Az szolgáltató fenntartja a
					jogot a regisztrált e-mail-re való, közérdekű, vagy marketing célú információk,
					felhívások és egyéb üzenetek küldésére.</p>
					<p class="MsoNormal" style="margin-bottom:18.0pt"><b>Műszaki követelmények</b></p>
					<p class="MsoNormal" style="margin-bottom:18.0pt">A felhasználó tudomásul veszi
					és elfogadja, hogy a szolgáltatás használata egyéb hardver és szoftver
					eszközöket igényel(het), valamint hogy az említett hardverre és szoftverre
					vonatkozóan a felhasználó saját felelősségére jár el. Azt követően, hogy a
					felhasználó regisztrált, a szolgáltatónál nem vonható felelősségre a
					szolgáltatás károsodásáért, megsemmisüléséért, ill. sérüléséért.</p>
					<p class="MsoNormal" style="margin-bottom:18.0pt">Továbbá nem vonható
					felelősségre a szolgáltatás elérhetetlenségért, és egyéb hibáiért sem.</p>
					<p class="MsoNormal" style="margin-bottom:18.0pt"><b>Felhasználók által közzétett
					tartalmak</b></p>
					<p class="MsoNormal" style="margin-bottom:18.0pt">Az Üzemeltető fenntartja a
					jogot a felhasználók által beküldött &nbsp;bármilyen célú felhasználására..</p>
					<p class="MsoNormal" style="margin-bottom:18.0pt"><b>A felelősség kizárása</b></p>
					<p class="MsoNormal" style="margin-bottom:18.0pt">A szolgáltató nem vállal
					semmilyen felelősséget a honlapon szolgáltatott információkkal, tartalmakkal,
					termékekkel és szolgáltatásokkal kapcsolatban, különösen a harmadik féltől
					beszerzett információkra, tartalmakra, termékekre és szolgáltatásokra nézve. A
					honlap használatával Ön elismeri, hogy azt csak és kizárólag saját felelősségére
					teszi. A szolgáltató nem vállal semmilyen felelősséget az Ön számítógépén vagy
					egyéb vonatkozásban keletkezett/elszenvedett károkért a honlap használatával
					kapcsolatban. A szolgáltató kizár minden felelősséget, amely a program
					letöltéséből, esetleges hibájából, illetve az Ön számítógépén futó programmal
					való összeegyeztethetetlensége, vagy bármely internetes vírus miatt következik
					be.</p>
					<p class="MsoNormal" style="margin-bottom:18.0pt">A szolgáltató nem garantálja,
					hogy a weboldalakhoz való hozzáférés folyamatos vagy hibamentes lesz. A honlap,
					illetve az ott elérhető információk, dokumentációk, vagy más írott anyagok
					hozzáféréséből, illetve azok közvetett vagy közvetlen felhasználásából, a honlap
					használatra alkalmatlan állapotából, vagy a nem megfelelő működésből,
					hiányosságból, esetleges üzemzavarból, vagy félreérhetőségből eredő károkért
					és/vagy veszteségért való felelősséget a szolgáltató kizárja.</p>
					<p class="MsoNormal" style="margin-bottom:18.0pt"><b>Kitiltás</b></p>
					<p class="MsoNormal" style="margin-bottom:18.0pt">A weboldalon bizonyos funkciók
					csak regisztrációt követően vehetők igénybe. A igénybe vett funkciók nem
					megfelelő használata az oldalról kitiltást vonhat maga után.</p>
					<p class="MsoNormal" style="margin-bottom:18.0pt"><b>Adatvédelem</b></p>
					<p class="MsoNormal" style="margin-bottom:18.0pt">A regisztráció során szükséges
					igazi, létező, élő e-mail cím megadása! A regisztrációkor eltároljuk a
					felhasználók IP Címét, E-mail címét, melyeket a személyességi jogok értelmében
					semmilyen körülmények között nem adjuk harmadik fél számára, viszont fenntartjuk
					a jogot ezen adatok statisztika jellegű felhasználására.</p>
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