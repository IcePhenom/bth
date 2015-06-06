<h1>Initiera och kontrollera databasen</h1>

<p>Databasfilen sparas i katalogen:<br> <code><?php echo dirname($dbPath); ?></code></p>

<?php if(is_writable(dirname($dbPath))): ?>
  <p class="success">Katalogen är skrivbar.</p>
<?php else: ?>
  <p class="alert">Katalogen är ej skrivbar. Skapa katalogen och gör den skrivbar.</p>
  <?php return; ?>
<?php endif; ?>

<?php
// Creating the database and initiating it with content
if(isset($_GET['create-database'])) {
  include(dirname(dirname(__FILE__)) . "/data/init_database.php");
}

// Testing the connection with the database
// The $dbPath is defined in blokket2.php
if(is_file($dbPath)) {
  echo "<p class='success'>Databasfilen <code>$dbPath</code> finns och kunde öppnas.</p>";
} else {
  echo "<p class='alert'>Databasfilen finns ej. <a href='?p=init&amp;create-database'>Klicka här för att skapa och initiera databasen</a>.</p>";
  return;
}
?>

<?php if(is_writable($dbPath)): ?>
  <p class="success">Databasfilen är skrivbar.</p>
<?php else: ?>
  <p class="alert">Databasfilen är ej skrivbar. Gör chmod 666 för att göra filen skrivbar.</p>
  <?php return; ?>
<?php endif; ?>

<p><a href="?p=init&amp;create-database">Klicka på denna länk för att återställa databasen till sitt ursprungliga skick. Befintliga data
raderas och en uppsättning default-data skapas</a>.</p>
