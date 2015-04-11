<?php
$pageId = "style";
$pathToStyles = dirname(__FILE__) . "/../../style/";
$stylesheets = readDirectory($pathToStyles);

$select = "<select id='input1' name='stylesheet' onchange='form.submit();'>";
$select .= "<option value='-1'> -- Välj stylesheet -- </option>";
foreach($stylesheets as $val) {
  $selected = "";
  if(isset($_POST['stylesheet']) && $_POST['stylesheet'] == $val) {
    $selected = "selected";
  }
  if($val != "forms.css") {
    $select .= "<option value='{$val}' {$selected}>{$val}</option>";
  }
}
$select .= "</select>";

$filename = null;
$isWritable = null;
if (isset($_POST['stylesheet']) && in_array($_POST['stylesheet'], $stylesheets)) {
  $filename = $pathToStyles . $_POST['stylesheet'];
  if (is_writable($filename)) {
    $isWritable = true;
  }
  else {
    $isWritable = false;
  }
}

if(isset($_POST['doSave'])) {
  $resFromSave = putFileContents($filename, strip_tags($_POST['styleContent']));
}
?>

<h1>Edit stylesheet</h1>

<p>Välj den stylesheet som du vill editera. Du kan välja bland stylesheets i katalogen <code>style/</code>.</p>

<form method="post" action="">
  <fieldset>
    <legend>Edit Stylesheet</legend>
    <p>
      <label for="input1">Stylesheet:</label><br>
      <?php echo $select; ?>
    </p>

    <p>
      <textarea style="width:100%; height:30em;" name="styleContent">
        <?php if($filename) echo getFileContents($filename); ?>
      </textarea>
    </p>

    <p>
      <input type="submit" name="doSave" value="Save" <?php if(!$isWritable) echo "disabled";  ?>>
      <input type="reset" value="Cancel">
    </p>

    <?php if($isWritable === false): ?>
      <p class="info">Filen är ej skrivbar. Gör den skrivbar med chmod 666 för att göra det möjligt att editera filen och spara dina ändringar.</p>
    <?php endif; ?>

    <?php if(isset($resFromSave)): ?>
      <p>
        <output class="success"><?php echo $resFromSave ?></output>
      </p>
    <?php endif; ?>

    <p>
      <?php
      if(isset($_SESSION['stylesheet'])) {
        echo "Din nuvarande stylesheet är '{$_SESSION['stylesheet']}'.";
      }
      else {
        echo "Du använder webbplatsens standard stylesheet.";
      }
      ?>
    </p>

  </fieldset>
</form>
