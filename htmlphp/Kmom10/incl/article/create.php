<?php
//
// Connect to the database
//
$db = new PDO("sqlite:$dbPath");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Display errors, but continue script

//
// Check if Save-button was pressed, save the ad if true.
//
if(isset($_POST['doCreate'])) {
  $article[] = strip_tags($_POST["title"], "<b><i><p><img>");
  $article[] = 'article';

  $stmt = $db->prepare("INSERT INTO Article (title,category) VALUES (?,?)");
  $stmt->execute($article);
  $output = "Lade till en ny artikel med id " . $db->lastInsertId() . ". Rowcount is = " . $stmt->rowCount() . ".";
}

//
// Create a select/option-list of the ads
//
$stmt = $db->prepare('SELECT * FROM Article WHERE category = "article" ORDER BY pubdate DESC');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

$select = "<select id='input1' multiple name='article'>";
foreach($res as $article) {
  $select .= "<option value='{$article['id']}'>{$article['title']} ({$article['id']})</option>";
}
$select .= "</select>";
?>

<h1>Lägg till artikel</h1>
<p>Ange ett unikt namn på en artikel och klicka på knappen för att spara den.</p>

<form method="post">
  <fieldset>
    <p>
      <label for="input1">Befintliga artiklar:</label><br>
      <?php echo $select; ?>
    </p>

    <p>
      <label for="input2">Titel på ny artikel:</label><br>
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
