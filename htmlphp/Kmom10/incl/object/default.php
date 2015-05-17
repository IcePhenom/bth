<?php
//
// Connect to the database
//
$db = new PDO("sqlite:$dbPath");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Display errors, but continue script

//
// Read from database
//
$stmt = $db->prepare('SELECT * FROM Object');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $db->query('SELECT COUNT(*) FROM Object')->fetchColumn();
?>
<script type="text/javascript">
  function changeContent(sel) {
    var count = "<?php echo $count; ?>";
    var i;
    if (sel.value == 'all') {
      document.getElementById('head-all').style.display = "";
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
  Välj objekt:
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

<div id='head-all'><h1>Alla objekt</h1></div>
<div id='head' style='display:none'><h1>Objekt</h1></div>
<?php
$i = 0;
foreach($res as $object): ?>
  <div class='object' id='<?php echo $i++; ?>'>
    <strong><?php echo $object['title']; ?></strong><br>
    Kategori: <?php echo $object['category']; ?>
    <div class='obj_img'><img src='<?php echo $object['image']; ?>'></div>
    <?php echo $object['text']; ?>
    <p class='objectauth'><?php echo $object['owner']; ?></p>
  </div>
<?php endforeach; ?>
