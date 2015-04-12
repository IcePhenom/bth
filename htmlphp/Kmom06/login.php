<?php
include("incl/config.php");
$pageId = "login";
$pageStyle = '';

// Check if the url contains a querystring with a page-part.
$p = isset($_GET["p"])? $_GET["p"] : null;

// Is the action a known action?
$content = null;
$output = null;
$title = "Status login / logout";

if($p == "login") {
  $title = "Logga in";
  $content = userLogin();
}
else if ($p == "logout") {
  $title = "Logga ut";
  $content = userLogout();
}
?>

<?php include("incl/header.php"); ?>
<section id="content">
  <div class="left border" style="width:80%;">

    <?php if(isset($content)):
      echo $content;
    else: ?>
      <h1>Status login / logout</h1>
      <p>Denna webbplats har skyddade delar. Du måste logga in för att komma åt dem.</p>
      <p>För tillfället är du:
      <?php if(userIsAuthenticated()): ?>
        <strong>inloggad</strong>.</p>
        <p><a href="?p=logout">Vill du logga ut</a>?</p>
      <?php else: ?>
        <strong>ej inloggad</strong>.</p>
        <p><a href="?p=login">Vill du logga in</a>?</p>
      <?php endif; ?>
    <?php endif; ?>

    <hr>
  </div>
</section>
<?php include("incl/footer.php"); ?>
