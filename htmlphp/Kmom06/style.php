<?php
include("incl/config.php");
$pageId = "style";

// Check if the url contains a querystring with a page-part.
$p = isset($_GET["p"]) ? $_GET["p"] : null;

// Is the page known?
$path = "incl/style";
$file = null;
switch($p) {
  case "choose-stylesheet":
    $title   = "Välj Stylesheet";
    $file    = "choose_stylesheet.php";
    break;

  case "edit-stylesheet":
    $title   = "Edit Stylesheet";
    $file    = "edit_stylesheet.php";
    break;

  case "choose-stylesheet-process":
    include("$path/choose_stylesheet_process.php");
    break;

  default:
    $title   = "Välj style för webbplatsen.";
    $file    = "default.php";
}
?>

<?php include("incl/header.php"); ?>
<section id="content">
  <aside class="right" style="width:22%;">
    <?php include("$path/aside.php"); ?>
  </aside>
  <article class="left border justify-para" style="width:72%;">
    <p class="quiet small">Källkod till denna sida, <code><?php echo "$path/$file"; ?></code>,
    <a href="viewsource.php?dir=<?php echo $path; ?>&amp;file=<?php echo $file; ?>#file">hittar du här</a>.</p>
    <?php include("$path/$file"); ?>
    <?php include("incl/byline.php"); ?>
    <hr>
  </article>
</section>
<?php include("incl/footer.php"); ?>
