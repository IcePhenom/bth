<?php
include("incl/config.php");
$title = "Om BMO";
$pageId = "about";
$pageStyle = '';

//
// Connect to the database
//
$dbPath = dirname(__FILE__) . "/incl/bmo/data/bmo.sqlite";
$db = new PDO("sqlite:$dbPath");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Display errors, but continue script

//
// Read from database
//
$stmt = $db->prepare('SELECT * FROM Article WHERE category = "about"');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("incl/header.php"); ?>

<!--- Main -->
<section id="content">
  <?php foreach($res as $article): ?>
    <div class='about'>
      <strong><?php echo $article['title']; ?></strong><br>
      <figure class="about-images">
        <img src="img/bmo/ronnyholm.jpg" width="500" height="250" alt="Bild på Ronny Holm">
        <figcaption>
          <p>Ronny Holm, organisationschef SKKF</p>
        </figcaption>
      </figure>
      <?php echo $article['content']; ?>
    </div>
  <?php endforeach; ?>
  <?php include("incl/byline.php"); ?>
</section>

<?php include("incl/footer.php"); ?>
