<?php include("incl/config.php");
$title = "Test sida";
$pageId = "test";
$pageStyle = '';

// Check if the url contains a querystring with a page-part.
$p = isset($_GET["p"])? $_GET["p"] : null;

$path = "incl/test";
$file = "default.php";

if($p == "kmom03-get") {
	$title = "Test kmom03: Visa \$_GET";
	$file  = "kmom03_get.php";
}
else if($p == "kmom03-getform") {
	$title = "Test kmom03: Visa form med \$_GET";
	$file  = "kmom03_getform.php";
}
else if($p == "kmom03-postform") {
	$title = "Test kmom03: Visa form med \$_POST";
	$file  = "kmom03_postform.php";
}
else if($p == "kmom03-validate") {
	$title = "Test kmom03: Visa validering";
	$file  = "kmom03_validate.php";
}
else if($p == "kmom03-server") {
	$title = "Test kmom03: Visa \$_SERVER";
	$file  = "kmom03_server.php";
}
else if($p == "kmom03-sessiondestroy") {
	$title = "Test kmom03: Förstör sessionen";
	$file  = "kmom03_sessiondestroy.php";
	destroySession();
}
else if($p == "kmom03-sessionchange") {
	$title = "Test kmom03: Ändra värden i sessionen";
	$file  = "kmom03_sessionchange.php";
}
else if($p == "kmom03-session") {
	$title = "Test kmom03: ";
	$file  = "kmom03_session.php";
}

include("incl/header.php"); ?>

<section id="content">
	<aside class="right aside_right">
		<?php include("$path/aside.php") ?>
	</aside>
	<article class="left border justify-para" style="width:72%;">
		<p>Källkod till detta testfall, <code><?php echo "$path/$file"; ?></code>, <a href="viewsource.php?dir=<?php echo $path; ?>&amp;file=<?php echo $file; ?>#file">hittar du här</a>.</p>
		<?php include("$path/$file"); ?>
	</article>

	<?php include("incl/byline.php"); ?>
</section>

<?php include("incl/footer.php"); ?>
