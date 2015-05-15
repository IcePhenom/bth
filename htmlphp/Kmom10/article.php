<?php
include("incl/config.php");
$title = "Artiklar";
$pageId = "article";
$pageStyle = '';

$path = "incl/article";
$file = "default.php";
f_article($title, $file);

// Path to the SQLite database file
$dbPath = dirname(__FILE__) . "/incl/data/bmo.sqlite";
?>

<?php include("incl/header.php"); ?>
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
