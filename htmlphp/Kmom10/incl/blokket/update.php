<?php
//
// Set up the path and read the directory, store all files in array $files
//
$path = dirname(__FILE__) . "/data/";
$files = readDirectory($path);

//
// Check that the filename is valid by checking that it exists in the $files array.
//
$filename = null;
$isWritable = null;
if (isset($_POST['file']) && in_array($_POST['file'], $files)) {
  $filename = $path . $_POST['file'];
  if (is_writable($filename)) {
    $isWritable = true;
  }
  else {
    $isWritable = false;
  }
}

//
// Check if Save-button was pressed, save the file if true.
//
if (isset($_POST['doSave'])) {
  $res = putFileContents($filename, strip_tags($_POST['content'], "<b><i><p><img>"));
}

//
// Create a select/option-list based on the content of the array $files
//
$select = "<select id='input1' name='file' onchange='form.submit();'>";
$select .= "<option value='-1'>Välj Annons</option>";
foreach($files as $val) {
  $selected = "";
  if(isset($_POST['file']) && $_POST['file'] == $val) {
    $selected = "selected";
  }
  $select .= "<option value='{$val}' {$selected}>{$val}</option>";
}
$select .= "</select>";
?>

<h1>Uppdatera annons</h1>
<p>Välj den annons som du vill ändra.</p>

<form method="post">
  <fieldset>
    <p>
      <label for="input1">Annonser:</label><br>
      <?php echo $select; ?>
    </p>

    <p>
      <textarea style="width:100%;" name="content"><?php if($filename) echo getFileContents($filename); ?></textarea>
    </p>

    <p>
      <input type="submit" name="doSave" value="Spara" <?php if(!$isWritable) echo "disabled";  ?>>
      <input type="reset" value="Ångra">
    </p>

    <?php if($isWritable === false): ?>
    <p class="info">Filen är ej skrivbar. Gör den skrivbar med chmod 666 för att göra det möjligt att editera filen och spara dina ändringar.</p>
    <?php endif; ?>

    <?php if(isset($res)): ?>
    <p><output class="success"><?php echo $res ?></output></p>
    <?php endif; ?>

  </fieldset>
</form>

<p>Detta formulär är ett "self-submitting"-formulär, det postar sig till sig själv.</p>
<p>Formuläret använder funktioner från filen <code>src/common.php</code>, <code>getFileContents()</code> läser innehållet
från en fil på disk och <code>putFileContents()</code> skriver innehåll till en fil på disk.
<a href="viewsource.php?dir=src&amp;file=common.php#file">Källkoden till funktionerna hittar du här</a>.</p>
