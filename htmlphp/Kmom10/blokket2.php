<?php
include("incl/config.php");
$title = "Blokket2, annonsplatsen";
$pageId = "blokket2";
$pageStyle = '';

$path = "incl/blokket2";
$file = "default.php";
blokket2($title, $file);

// Path to the SQLite database file
$dbPath = dirname(__FILE__) . "/incl/blokket2/data/blokket2.sqlite";
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
