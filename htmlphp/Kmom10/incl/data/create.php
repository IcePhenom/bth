<?php
//
// Connect to the database
//
$db = new PDO("sqlite:$dbPath");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Display errors, but continue script

//
// Check if Save-button was pressed, save the report if true.
//
if(isset($_POST['doCreate'])) {
  $report[] = strip_tags($_POST["title"], "<b><i><p><img>");

  $stmt = $db->prepare("INSERT INTO report (title) VALUES (?)");
  $stmt->execute($report);
  $output = "Lade till en ny data med id " . $db->lastInsertId() . ". Rowcount is = " . $stmt->rowCount() . ".";
}

//
// Create a select/option-list of the data
//
$stmt = $db->prepare('SELECT * FROM report;');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

$select = "<select id='input1' multiple name='data'>";
foreach($res as $report) {
  $select .= "<option value='{$report['id']}'>{$report['title']} ({$report['id']})</option>";
}
$select .= "</select>";
?>

<h1>Lägg till data</h1>
<p>Ange ett unikt namn på en data och klicka på knappen för att spara den.</p>

<form method="post">
  <fieldset>
    <p>
      <label for="input1">Befintliga data:</label><br>
      <?php echo $select; ?>
    </p>

    <p>
      <label for="input2">Titel på ny data:</label><br>
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
