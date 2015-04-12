<?php
include("incl/config.php");
$title = "Min Me-sida om mig själv";
$pageId = "me";
$pageStyle = '';
?>

<?php include("incl/header.php"); ?>

<!--- Main -->
<section id="content">
	<h1>htmlphp-me</h1>
	<img class="me" src="img/me.jpg" alt="Bild på Mads Nielsen">
	<p>Mitt namn är Mads Nielsen och jobbar som utvecklare.</p>
	<p>Läser detta kurspaket då jag vill utöka mina kunskaper innom webbutveckling,<br> har jobbat en del med PHP, MySQL, HTML på fritiden då jag byggt ett par hemsidor.</p>
	<p>Annars finns det väll inte så mycket att säga om mig.</p>

	<?php include("incl/byline.php"); ?>
</section>

<?php include("incl/footer.php"); ?>
