<?php
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
        document.getElementById(i+'-full').style.display = "none";
        document.getElementById(i+'-teaser').style.display = "";
      }
    }
    else {
      document.getElementById('head-all').style.display = "none";
      document.getElementById('head').style.display = "";
      for (i = 0; i < count; i++) {
        if (i == sel.value) {
          document.getElementById(i+'-full').style.display = "";
          document.getElementById(i+'-teaser').style.display = "none";
        }
        else {
          document.getElementById(i+'-full').style.display = "none";
          document.getElementById(i+'-teaser').style.display = "none";
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
  <div class='article' id='<?php echo $i . '-teaser'; ?>'>
    <h1><?php echo $article['title']; ?></h1>
    <?php echo substr($article['content'], 0, 400) . '... <a href="?art=' . $i . '">Läs hela artiklen</a>'; ?>
    <p class='articleauth'><?php echo $article['author']; ?></p>
  </div>
  <div class='article' style='display:none' id='<?php echo $i . '-full'; ?>'>
    <h1><?php echo $article['title']; ?></h1>
    <?php echo $article['content']; ?>
    <p class='articleauth'><?php echo $article['author']; ?></p>
  </div>
  <?php $i++; ?>
<?php endforeach; ?>

<?php $art = isset($_GET['art']) ? $_GET['art'] : 'all'; ?>

<script type="text/javascript">
  var page = {
    value:"<?php echo $art; ?>"
  };
  window.onload = changeContent(page);
</script>
