<?php
include("incl/config.php");
$title = "Status login / logout";
$pageId = "login";
$pageStyle = '';

$content = null;
$output = null;

authenticate($title, $content);
?>

<?php include("incl/header.php"); ?>
<section id="content">
  <div class="left border" style="width:80%;">
    <?php print authPrint($content); ?>
  </div>
</section>
<?php include("incl/footer.php"); ?>
