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
  $ad[] = strip_tags($_POST["title"], $strip);
  $ad[] = strip_tags($_POST["description"], $strip);
  $ad[] = strip_tags($_POST["image"], $strip);
  $ad[] = strip_tags($_POST["id"], $strip);

  $stmt = $db->prepare("UPDATE Ads SET title=?, description=?, image=? WHERE id=?");
  $stmt->execute($ad);
  $output = "Uppdaterade annonsen. Rowcount is = " . $stmt->rowCount() . ".";
}

//
// Create a select/option-list of the ads
//
$stmt = $db->prepare('SELECT * FROM Ads;');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
$current = null;

$select = "<select id='input1' name='ads' onchange='form.submit();'>";
$select .= "<option value='-1'>Välj Annons</option>";
foreach($res as $ad) {
  $selected = "";
  if(isset($_POST['ads']) && $_POST['ads'] == $ad['id']) {
    $selected = "selected";
    $current = $ad;
  }
  $select .= "<option value='{$ad['id']}' {$selected}>{$ad['title']} ({$ad['id']})</option>";
}
$select .= "</select>";
?>

<h1>Uppdatera annons</h1>
<p>Välj den annons som du vill ändra.</p>

<form method="post">
  <fieldset>
    <input type="hidden" name="id" value="<?php echo $current['id']; ?>">

    <p>
      <label for="input1">Annonser:</label><br>
      <?php echo $select; ?>
    </p>

    <p>
      <label for="input1">Titel:</label><br>
      <input type="text" class="text" name="title" value="<?php echo $current['title']; ?>">
    </p>

    <p>
      <label for="input1">Bildlänk (relativ på servern eller direkt med http://server.com/bild.png):</label><br>
      <input type="link" class="text" name="image" value="<?php echo $current['image']; ?>">
    </p>

    <p>
      <textarea style="width:100%;" name="description"><?php echo $current['description']; ?></textarea>
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
