<?php
//
// Check if Save-button was pressed, save the ad if true.
//
if(isset($_POST['doDelete'])) {
  $ad[] = $_POST["object"];

  $stmt = $db->prepare("DELETE FROM Object WHERE id=?");
  $stmt->execute($ad);
  $output = "Raderade objekt. Rowcount is = " . $stmt->rowCount() . ".";
}

//
// Create a select/option-list of the ads
//
$stmt = $db->prepare('SELECT * FROM Object');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

$select = "<select id='input1' name='object'>";
foreach($res as $object) {
  $select .= "<option value='{$object['id']}'>{$object['title']} ({$object['id']})</option>";
}
$select .= "</select>";
?>

<h1>Ta bort ett objekt</h1>
<p>Välj ett objekt och klicka knappen "Radera" för att ta bort objektet.</p>

<form method="post">
  <fieldset>
    <p>
      <label for="input1">Befintliga objekt:</label><br>
      <?php echo $select; ?>
    </p>

    <p>
      <input type="submit" name="doDelete" value="Radera">
    </p>

    <?php if(isset($output)): ?>
    <p><output class="info"><?php echo $output ?></output></p>
    <?php endif; ?>
  </fieldset>
</form>
