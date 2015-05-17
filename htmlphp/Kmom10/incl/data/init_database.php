<?php
// Reset database to original
echo "<h3>Återställer databasen till sitt ursprung</h2>";

$file = dirname($dbPath) . '/backup.sqlite';
$newfile = dirname($dbPath) . '/bmo.sqlite';

if (!copy($file, $newfile)) {
  echo "Kunde inte återställa databasen......";
}
else {
  echo "Databasen återställd";
}
