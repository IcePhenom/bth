<?php
//
// Check if Save-button was pressed, save the ad if true.
//
if(isset($_POST['doCreate'])) {
  $object[] = strip_tags($_POST["title"], "<b><i><p><img>");

  $stmt = $db->prepare("INSERT INTO Object (title) VALUES (?)");
  $stmt->execute($object);
  $output = "Lade till en ntt objekt med id " . $db->lastInsertId() . ". Rowcount is = " . $stmt->rowCount() . ".";
}

//
// Create a select/option-list of the ads
//
$stmt = $db->prepare('SELECT * FROM Object');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

$select = "<select id='input1' multiple name='object'>";
foreach($res as $object) {
  $select .= "<option value='{$object['id']}'>{$object['title']} ({$object['id']})</option>";
}
$select .= "</select>";
?>

<h1>Lägg till objekt</h1>
<p>Ange ett unikt namn på ett objekt och klicka på knappen för att spara den.</p>

<form method="post">
  <fieldset>
    <p>
      <label for="input1">Befintliga objekt:</label><br>
      <?php echo $select; ?>
    </p>

    <p>
      <label for="input2">Titel på nytt objekt:</label><br>
      <input id="input2" class="text" name="title">
    </p>

    <p>
      <input type="submit" name="doCreate" value="Skapa">
      <input type="reset" value="Ångra">
    </p>

    <?php if(isset($output)): ?>
    <p><output class="info"><?php echo $output ?></output></p>
    <?php endif; ?>
  </fieldset>
</form>
