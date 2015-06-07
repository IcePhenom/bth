<?php
$pageId = "style";
$pathToStyles = dirname(__FILE__) . "/../../style/";
$stylesheets = readDirectory($pathToStyles);

$select = "<select id='input1' name='stylesheet' onchange='form.submit();'>";
$select .= "<option value='-1'> -- Välj stylesheet -- </option>";
foreach($stylesheets as $val) {
  $selected = "";
  if(isset($_SESSION['stylesheet']) && $_SESSION['stylesheet'] == $val) {
    $selected = "selected";
  }
  if($val != "forms.css") {
    $select .= "<option value='{$val}' {$selected}>{$val}</option>";
  }
}
$select .= "</select>";

?>

<h1>Välj stylesheet</h1>

<p>Välj den stylesheet som du vill använda. Du kan välja bland de stylesheets som ligger
i katalogen <code>style/</code>.</p>

<form method="post" action="?p=choose-stylesheet-process">
  <fieldset>
    <legend>Välj Stylesheet</legend>
    <p>
      <label for="input1">Stylesheet:</label><br>
      <?php echo $select; ?>
    </p>

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
