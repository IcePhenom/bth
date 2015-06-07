<?php
include("incl/config.php");
$title = "Edit static data on the page";
$pageId = "data";
$pageStyle = '';

$path = "incl/data";
$file = "default.php";
blokket2($title, $file);

// Path to the SQLite database file
$dbPath = dirname(__FILE__) . "/incl/data/data/static.sqlite";

$content = null;
$output = null;

authenticate($title, $content);
?>

<?php include("incl/header.php"); ?>
<section id="content">
  <?php if (!userIsAuthenticated()) {
    print authPrint($content);
  }
  else {?>
    <aside class="right" style="width:22%;">
      <?php include("$path/aside.php"); ?>
    </aside>
    <article class="left border justify-para" style="width:72%;">
      <p class="quiet small">Källkod till denna sida, <code><?php echo "$path/$file"; ?></code>, <a href="viewsource.php?dir=<?php echo $path; ?>&amp;file=<?php echo $file; ?>#file">hittar du här</a>.</p>
      <?php include("$path/$file"); ?>
      <?php include("incl/byline.php"); ?>
    </article>
  <?php } ?>
</section>
<?php include("incl/footer.php"); ?>
