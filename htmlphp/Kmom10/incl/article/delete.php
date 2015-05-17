<?php
//
// Connect to the database
//
$db = new PDO("sqlite:$dbPath");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Display errors, but continue script

//
// Check if Save-button was pressed, save the ad if true.
//
if(isset($_POST['doDelete'])) {
  $ad[] = $_POST["article"];

  $stmt = $db->prepare("DELETE FROM Article WHERE id=?");
  $stmt->execute($ad);
  $output = "Raderade artikel. Rowcount is = " . $stmt->rowCount() . ".";
}

//
// Create a select/option-list of the ads
//
$stmt = $db->prepare('SELECT * FROM Article WHERE category = "article"');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

$select = "<select id='input1' name='article'>";
foreach($res as $article) {
  $select .= "<option value='{$article['id']}'>{$article['title']} ({$article['id']})</option>";
}
$select .= "</select>";
?>

<h1>Ta bort en artikel</h1>
<p>Välj en artikel och klicka knappen "Radera" för att ta bort artiklen.</p>

<form method="post">
  <fieldset>
    <p>
      <label for="input1">Befintliga artiklar:</label><br>
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
