<?php
//
// Connect to the database
//
$db = new PDO("sqlite:$dbPath");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Display errors, but continue script

//
// Check if Save-button was pressed, save the ad if true.
//
if(isset($_POST['doSave'])) {
  $strip = "<b><i><p><img>";

  // Add all form entries to an array
  $article[] = strip_tags($_POST["title"], $strip);
  $article[] = strip_tags($_POST["content"], $strip);
  $article[] = strip_tags($_POST["auth"], $strip);
  $article[] = strip_tags($_POST["id"], $strip);

  $stmt = $db->prepare("UPDATE Article SET title=?, content=?, author=? WHERE id=?");
  $stmt->execute($article);
  $output = "Uppdaterade annonsen. Rowcount is = " . $stmt->rowCount() . ".";
}

//
// Create a select/option-list of the ads
//
$stmt = $db->prepare('SELECT * FROM Article WHERE category = "article" ORDER BY pubdate DESC');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
$current = null;

$select = "<select id='input1' name='article' onchange='form.submit();'>";
$select .= "<option value='-1'>Välj Artikel</option>";
foreach($res as $article) {
  $selected = "";
  if(isset($_POST['article']) && $_POST['article'] == $article['id']) {
    $selected = "selected";
    $current = $article;
  }
  $select .= "<option value='{$article['id']}' {$selected}>{$article['title']} ({$article['id']})</option>";
}
$select .= "</select>";
?>

<h1>Uppdatera annons</h1>
<p>Välj den annons som du vill ändra.</p>

<form method="post">
  <fieldset>
    <input type="hidden" name="id" value="<?php echo $current['id']; ?>">

    <p>
      <label for="input1">Artiklar:</label><br>
      <?php echo $select; ?>
    </p>

    <p>
      <label for="input1">Titel:</label><br>
      <input type="text" class="text" name="title" value="<?php echo $current['title']; ?>">
    </p>

    <p>
      <label for="input1">Text:</label><br>
      <textarea style="width:100%;" name="content"><?php echo trim($current['content']); ?></textarea>
    </p>

    <p>
      <label for="input1">Författare:</label><br>
      <input type="text" class="text" name="auth" value="<?php echo $current['author']; ?>">
    </p>

    <p>
      <input type="submit" name="doSave" value="Spara" <?php if(!isset($current['id'])) echo "disabled";  ?>>
      <input type="reset" value="Ångra">
    </p>

    <?php if(isset($output)): ?>
    <p><output class="success"><?php echo $output; ?></output></p>
    <?php endif; ?>
  </fieldset>
</form>
