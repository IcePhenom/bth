<?php
//
// Connect to the database
//
$db = new PDO("sqlite:$dbPath");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Display errors, but continue script

//
// Check if Save-button was pressed, save the report if true.
//
if(isset($_POST['doSave'])) {
  $strip = "<b><i><p><img>";

  // Add all form entries to an array
  $report[] = strip_tags($_POST["title"], $strip);
  $report[] = strip_tags($_POST["description"], $strip);
  $report[] = strip_tags($_POST["id"], $strip);

  $stmt = $db->prepare("UPDATE report SET title=?, description=? WHERE id=?");
  $stmt->execute($report);
  $output = "Uppdaterade data. Rowcount is = " . $stmt->rowCount() . ".";
}

//
// Create a select/option-list of the data
//
$stmt = $db->prepare('SELECT * FROM report;');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
$current = null;

$select = "<select id='input1' name='data' onchange='form.submit();'>";
$select .= "<option value='-1'>Välj data</option>";
foreach($res as $report) {
  $selected = "";
  if(isset($_POST['data']) && $_POST['data'] == $report['id']) {
    $selected = "selected";
    $current = $report;
  }
  $select .= "<option value='{$report['id']}' {$selected}>{$report['title']} ({$report['id']})</option>";
}
$select .= "</select>";
?>

<h1>Uppdatera data</h1>
<p>Välj den data som du vill ändra.</p>

<form method="post">
  <fieldset>
    <input type="hidden" name="id" value="<?php echo $current['id']; ?>">
    <p>
      <label for="input1">Data:</label><br>
      <?php echo $select; ?>
    </p>
    <p>
      <label for="input1">Titel:</label><br>
      <input type="text" class="text" name="title" value="<?php echo $current['title']; ?>">
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
