<?php include("incl/config.php"); ?>

<?php
$title = "Min Me-sida om mig själv";
$pageId = "me";

// Define style thats specific for this page
$pageStyle = '
figure {
 -webkit-border-radius: 10px;
 -moz-border-radius: 10px;
 border-radius: 10px;

 border-color:#5C0A0A;

 -moz-box-shadow: 10px 10px 5px #8A0F0F;
 -webkit-box-shadow: 10px 10px 5px #8A0F0F;
 box-shadow: 10px 10px 5px #8A0F0F;
}
';
?>

<?php include("incl/header.php"); ?>

<!--- Main -->
<section id="content">
	<article>
		<h1>htmlphp-me</h1>
		<figure>
			<img src="img/me.jpg">
			<figcaption>
				<p>Bild: Leende bild</p>
			</figcaption>
		</figure>
		<p>Mitt namn är Mads Nielsen och jobbar som utvecklare.</p>
		<p>Läser detta kurspaket då jag vill utöka mina kunskaper innom webbutveckling,<br> har jobbat en del med PHP, MySQL, HTML på fritiden då jag byggt ett par hemsidor.</p>
		<p>Annars finns det väll inte så mycket att säga om mig.</p>

		<?php include("incl/byline.php"); ?>
	</article>
</section>

<?php include("incl/footer.php"); ?>
