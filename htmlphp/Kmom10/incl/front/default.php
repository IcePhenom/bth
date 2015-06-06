<?php
// Read from database
$stmt = $db->prepare('SELECT * FROM Front');
$stmt->execute();
$front = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<h2><?php echo $front['title']; ?></h2>
<figure class='about-images'>
  <img class='front-image' src='<?php echo $front['image']; ?>' alt='Bild framsida'>
  <figcaption>
    <p><?php echo $front['imgdesc']; ?></p>
  </figcaption>
</figure>
<?php echo $front['content']; ?>
