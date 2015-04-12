<?php
// Creating the database and initiating it with content
echo "<h3>Creating and populating the database</h2>";

$db = new PDO("sqlite:$dbPath");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Display errors, but continue script

// Create a table, but only if it not already exists.
$stmt = $db->prepare('
  CREATE TABLE IF NOT EXISTS report
  (
    id INTEGER PRIMARY KEY NOT NULL UNIQUE,
    title TEXT,
    description TEXT
  );
');
echo "<p>Creating table if it does not exists by executing SQL statement:<pre>" . $stmt->queryString . "</pre></p>";
$stmt->execute();
