<?php
//
// Connect to the database
//
$db = new PDO("sqlite:$dbPath");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Display errors, but continue script

//
// Read from database
//
$stmt = $db->prepare('SELECT * FROM Article WHERE category = "article" ORDER BY pubdate DESC');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $db->query('SELECT COUNT(*) FROM Article WHERE category = "article"')->fetchColumn();
?>
<script type="text/javascript">
  function changeContent(sel) {
    var count = "<?php echo $count; ?>";
    var i;
    if (sel.value == 'all') {
      document.getElementById('head-all').style.display = "";
      document.getElementById('head').style.display = "none";
      for (i = 0; i < count; i++) {
        document.getElementById(i).style.display = "";
      }
    }
    else {
      document.getElementById('head-all').style.display = "none";
      document.getElementById('head').style.display = "";
      for (i = 0; i < count; i++) {
        if (i == sel.value) {
          document.getElementById(i).style.display = "";
        }
        else {
          document.getElementById(i).style.display = "none";
        }
      }
    }
  }
</script>

<div id='selector'>
  Välj artikel:
  <select onchange="changeContent(this)">
    <option value='all'>--Alla--</option>
    <?php
    $i = 0;
    foreach ($res as $art) {
      echo "<option value='" . $i++ . "'>" . $art['title'] . "</option>";
    }
    ?>
  </select>
</div>

<div id='head-all'><h1>Alla artiklar</h1></div>
<div id='head' style='display:none'><h1>Artikel</h1></div>
<?php
$i = 0;
foreach($res as $article): ?>
  <div class='article' id='<?php echo $i++; ?>'>
    <strong><?php echo $article['title']; ?></strong><br>
    <?php echo $article['content']; ?>
    <p class='articleauth'><?php echo $article['author']; ?></p>
  </div>
<?php endforeach; ?>
