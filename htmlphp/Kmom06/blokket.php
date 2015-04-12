<?php
include("incl/config.php");
$title  = "Blokket, annonsplatsen";
$pageId = "blokket";
$pageStyle = '';

$path = "incl/blokket";
$file = "default.php";

blokket($title, $file);
?>

<?php include("incl/header.php"); ?>
<section id="content">
  <aside class="right" style="width:22%;">
    <?php include("$path/aside.php"); ?>
  </aside>
  <article class="left border justify-para" style="width:72%;">
    <p class="quiet small">Källkod till denna sida, <code><?php echo "$path/$file"; ?></code>, <a href="viewsource.php?dir=<?php echo $path; ?>&amp;file=<?php echo $file; ?>#file">hittar du här</a>.</p>
    <?php include("$path/$file"); ?>
    <?php include("incl/byline.php"); ?>
    <hr>
  </article>
</section>
<?php include("incl/footer.php"); ?>
