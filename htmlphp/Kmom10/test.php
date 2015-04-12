<?php include("incl/config.php");
$title = "Test sida";
$pageId = "test";
$pageStyle = '';

$path = "incl/test";
$file = "default.php";

test($title, $file);

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
