<?php
include("incl/config.php");
$title = "Begravningsmuseum Online";
$pageId = "index";
$pageStyle = '';

$path = "incl/front";
$file = "default.php";
f_front($title, $file);
?>

<?php include("incl/header.php"); ?>

<!--- Main -->
<section id="content">
  <?php if (userIsAuthenticated()) {?>
    <aside class="right" style="width:22%;">
      <?php include("$path/aside.php"); ?>
    </aside>
    <article class="left border justify-para" style="width:72%;">
  <?php }
  else { ?>
    <article class="left justify-para">
  <?php } ?>
    <?php include("$path/$file"); ?>
    </article>
</section>

<?php include("incl/footer.php"); ?>
