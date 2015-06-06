<?php
include("incl/config.php");
$title = "Objekt";
$pageId = "object";
$pageStyle = '';

$path = "incl/object";
$file = "default.php";
f_object($title, $file);
?>

<?php include("incl/header.php"); ?>
<!-- Main -->
  <div id="main-wrapper">
    <div id="main" class="container">
      <div class="row">
        <?php if (userIsAuthenticated()) {?>
        <div class="content content-left">
        <?php } else { ?>
        <div class="content">
        <?php } ?>
          <!-- Content -->
          <article class="box page-content">
            <?php include("$path/$file"); ?>
          </article>
        </div>

        <!-- Sidebar -->
        <?php if (userIsAuthenticated()) {?>
          <aside class="sidebar">
            <section>
              <?php include("$path/aside.php"); ?>
            </section>
          </aside>
        <?php } ?>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include("incl/footer.php"); ?>
</body>
</html>
