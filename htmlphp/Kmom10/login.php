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
<!-- Main -->
  <div id="main-wrapper">
    <div id="main" class="container">
      <div class="row">
        <div class="content">
          <!-- Content -->
          <article class="box page-content">
            <?php print authPrint($content); ?>
          </article>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include("incl/footer.php"); ?>
</body>
</html>
