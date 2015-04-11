<?php
include("incl/config.php");

$title = "Mina redovisningar av kursmomenten";
$pageId = "source";

$sourceBasedir=dirname(__FILE__);
$sourceNoEcho=true;
include("src/source.php");
$pageStyle=$sourceStyle;

include("incl/header.php"); ?>

<!--- Main -->
<section id="content">
	<?php echo $sourceBody;  ?>
</section>

<?php include("incl/footer.php"); ?>
