<?php
//
// Connect to the database
//
$db = new PDO("sqlite:$dbPath");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Display errors, but continue script

//
// Check if Save-button was pressed, save the data if true.
//
if(isset($_POST['doDelete'])) {
  $data[] = $_POST["data"];

  $stmt = $db->prepare("DELETE FROM report WHERE id=?");
  $stmt->execute($data);
  $output = "Raderade data. Rowcount is = " . $stmt->rowCount() . ".";
}

//
// Create a select/option-list of the data
//
$stmt = $db->prepare('SELECT * FROM report;');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

$select = "<select id='input1' name='data'>";
foreach($res as $data) {
  $select .= "<option value='{$data['id']}'>{$data['title']} ({$data['id']})</option>";
}
$select .= "</select>";
?>

<h1>Ta bort en data</h1>
<p>Välj en data och klicka knappen "Radera" för att ta bort data.</p>

<form method="post">
  <fieldset>
    <p>
      <label for="input1">Befintliga data:</label><br>
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
