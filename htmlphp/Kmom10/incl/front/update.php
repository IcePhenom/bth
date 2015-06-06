<?php
// Check if Save-button was pressed, save the front if true.
if(isset($_POST['doSave'])) {
  $strip = "<b><i><p><img><br><br/>";

  // Add all form entries to an array
  $front[] = strip_tags($_POST["title"], $strip);
  $front[] = strip_tags($_POST["content"], $strip);
  $front[] = strip_tags($_POST["image"], $strip);
  $front[] = strip_tags($_POST["imgdesc"], $strip);
  $front[] = strip_tags($_POST["id"], $strip);

  $stmt = $db->prepare("UPDATE Front SET title=?, content=?, image=?, imgdesc=? WHERE id=?");
  $stmt->execute($front);
  $output = "Uppdaterade framsidan. Rowcount is = " . $stmt->rowCount() . ".";
}

// Create a select/option-list of the ads
$stmt = $db->prepare('SELECT * FROM Front');
$stmt->execute();
$front = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<header>
  <h2>Uppdatera framsida</h2>
</header>
<section>
  <form method="post">
    <fieldset>
      <input type="hidden" name="id" value="<?php echo $front['id']; ?>">
      <p>
        <label for="title">Titel:</label><br>
        <input id="title" type="text" class="text" name="title" value="<?php echo $front['title']; ?>">
      </p>
      <p>
        <label for="image">Bild:</label><br>
        <input id="image" type="text" class="text" name="image" value="<?php echo $front['image']; ?>">
      </p>
      <p>
        <label for="imgdesc">Bild beskrivning:</label><br>
        <input id="imgdesc" type="text" class="text" name="imgdesc" value="<?php echo $front['imgdesc']; ?>">
      </p>
      <p>
        <label for="body">Text: (Tillåtna taggar &lt;b&gt;&lt;i&gt;&lt;p&gt;&lt;br&gt;)</label><br>
        <textarea id="body" style="width:100%;" name="content"><?php echo trim($front['content']); ?></textarea>
      </p>
      <p>
        <input type="submit" name="doSave" value="Spara" <?php if(!isset($front['id'])) echo "disabled";  ?>>
        <input type="reset" value="Ångra">
      </p>
      <?php if(isset($output)): ?>
      <p><output class="success"><?php echo $output; ?></output></p>
      <?php endif; ?>
    </fieldset>
  </form>
</section>
