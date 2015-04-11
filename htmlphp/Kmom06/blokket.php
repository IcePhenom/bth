<?php
include("incl/config.php");
$title = "Blokket";
$pageId = "blokket";

// Check if the url contains a querystring with a page-part.
$p = isset($_GET["p"]) ? $_GET["p"] : null;

// Is the page known?
$path = "incl/blokket";
$file = null;
switch($p) {
  case "init":
    $pageTitle   = "Initiera annonserna";
    $file        = "init.php";
    break;

  case "update":
    $pageTitle   = "Visa och uppdatera annonser";
    $file        = "update.php";
    break;

  case "create":
    $pageTitle   = "Skapa ny annons";
    $file        = "create.php";
    break;

  case "delete":
    $pageTitle   = "Radera annons";
    $file        = "delete.php";
    break;

  case "read":
    $pageTitle   = "Visa annons";
    $file        = "read.php";
    break;

  case "read-all":
    $pageTitle   = "Visa alla annonser";
    $file        = "read_all.php";
    break;

  default:
    $pageTitle   = "Blokket, annonsplatsen";
    $file        = "default.php";
}
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
