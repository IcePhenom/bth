<?php
include("incl/config.php");
$title = "Mina redovisningar av kursmomenten";
$pageId = "report";
$pageStyle = '';
?>

<?php include("incl/header.php"); ?>

<!--- Main -->
<section id="content">
	<h1>Redovisning av kursmomenten</h1>
		<?php echo report(); ?>

	<?php include("incl/byline.php"); ?>
</section>

<?php include("incl/footer.php"); ?>
