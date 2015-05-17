<?php
//
// Check if Save-button was pressed, save the ad if true.
//
if(isset($_POST['doSave'])) {
  $strip = "<b><i><p><img>";

  // Add all form entries to an array
  $object[] = strip_tags($_POST["title"], $strip);
  $object[] = strip_tags($_POST["category"], $strip);
  $object[] = strip_tags($_POST["text"], $strip);
  $object[] = strip_tags($_POST["owner"], $strip);
  $object[] = strip_tags($_POST["id"], $strip);

  $stmt = $db->prepare("UPDATE Object SET title=?, category=?, text=?, owner=? WHERE id=?");
  $stmt->execute($object);
  $output = "Uppdaterade objektet. Rowcount is = " . $stmt->rowCount() . ".";
}

//
// Create a select/option-list of the ads
//
$stmt = $db->prepare('SELECT * FROM Object');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
$current = null;

$select = "<select id='input1' name='object' onchange='form.submit();'>";
$select .= "<option value='-1'>Välj objekt</option>";
foreach($res as $object) {
  $selected = "";
  if(isset($_POST['object']) && $_POST['object'] == $object['id']) {
    $selected = "selected";
    $current = $object;
  }
  $select .= "<option value='{$object['id']}' {$selected}>{$object['title']} ({$object['id']})</option>";
}
$select .= "</select>";
?>

<h1>Uppdatera objekt</h1>
<p>Välj det objekt som du vill ändra.</p>

<form method="post">
  <fieldset>
    <input type="hidden" name="id" value="<?php echo $current['id']; ?>">

    <p>
      <label for="input1">Objekt:</label><br>
      <?php echo $select; ?>
    </p>

    <p>
      <label for="input1">Titel:</label><br>
      <input type="text" class="text" name="title" value="<?php echo $current['title']; ?>">
    </p>

    <p>
      <label for="input1">Categori:</label><br>
      <input type="text" class="text" name="category" value="<?php echo $current['category']; ?>">
    </p>

    <p>
      <label for="input1">Text:</label><br>
      <textarea style="width:100%;" name="text"><?php echo trim($current['text']); ?></textarea>
    </p>

    <p>
      <label for="input1">Ägare:</label><br>
      <input type="text" class="text" name="owner" value="<?php echo $current['owner']; ?>">
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
