<?php
include("incl/config.php");
$title = "Galleri";
$pageId = "gallery";
$pageStyle = '';
?>

<?php include("incl/header.php"); ?>
<!-- Main -->
  <div id="main-wrapper">
    <div id="main" class="container">
      <div class="row">
        <div class="content">
          <!-- Content -->
          <article class="box page-content">
            <?php include("incl/gallery/gallery_pres.php"); ?>
          </article>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include("incl/footer.php"); ?>
</body>
</html>
