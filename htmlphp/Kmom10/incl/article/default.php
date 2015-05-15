<?php
//
// Connect to the database
//
$db = new PDO("sqlite:$dbPath");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Display errors, but continue script

//
// Read from database
//
$stmt = $db->prepare('SELECT * FROM Article WHERE category = "article" ORDER BY pubdate DESC');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Visa alla artiklar</h1>
<?php foreach($res as $article): ?>
  <div class='article'>
    <strong><?php echo $article['title']; ?></strong><br>
    <?php echo $article['content']; ?>
    <p class='articleauth'><?php echo $article['author']; ?></p>
  </div>
<?php endforeach; ?>
