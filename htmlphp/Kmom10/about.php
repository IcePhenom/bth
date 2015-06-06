<?php
include("incl/config.php");
$title = "Om BMO";
$pageId = "about";
$pageStyle = '';

//
// Read from database
//
$stmt = $db->prepare('SELECT * FROM Article WHERE category = "about"');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
$article = $res[0];
?>

<?php include("incl/header.php"); ?>
<!-- Main -->
  <div id="main-wrapper">
    <div id="main" class="container">
      <div class="row">
        <div class="content">
          <!-- Content -->
          <article class="box page-content">
            <div class='about'>
              <strong><?php echo $article['title']; ?></strong><br>
              <figure class="about-images">
                <img src="img/bmo/ronnyholm.jpg" width="400" height="250" alt="Bild på Ronny Holm">
                <figcaption>
                  <p>Ronny Holm, organisationschef SKKF</p>
                </figcaption>
              </figure>
              <?php echo $article['content']; ?>
            </div>
          </article>
        </div>
      </div>
      <!-- Byline -->
      <div class="row">
        <section>
          <?php include("incl/byline.php"); ?>
        </section>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include("incl/footer.php"); ?>
</body>
</html>
