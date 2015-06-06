<?php
// Read from database
$stmt = $db->prepare('SELECT * FROM Object');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $db->prepare('SELECT * FROM Object GROUP BY category');
$stmt2->execute();
$cat = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
<script type="text/javascript">
  function changeContent(sel) {
    var count = "<?php echo $db->query('SELECT COUNT(*) FROM Object')->fetchColumn(); ?>";
    var i;
    if (sel.value == 'all') {
      document.getElementById('select-cat').style.display = "";
      document.getElementById('head-all').style.display = "";
      document.getElementById('head').style.display = "none";
      for (i = 0; i < count; i++) {
        document.getElementById(i).style.display = "";
      }
    }
    else {
      document.getElementById('select-cat').style.display = "none";
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

  function changeContentCategory(sel) {
    var count = "<?php echo $db->query('SELECT COUNT(*) FROM Object')->fetchColumn(); ?>";
    var i;
    if (sel.value == 'all') {
      document.getElementById('select-title').style.display = "";
      document.getElementById('head-all').style.display = "";
      document.getElementById('head-cat').style.display = "none";
      for (i = 0; i < count; i++) {
        document.getElementById(i).style.display = "";
      }
    }
    else {
      document.getElementById('select-title').style.display = "none";
      document.getElementById('head-all').style.display = "none";
      document.getElementById('head-cat').style.display = "";
      for (i = 0; i < count; i++) {
        if (document.getElementById('cat-' + i).className == sel.value) {
          document.getElementById(i).style.display = "";
        }
        else {
          document.getElementById(i).style.display = "none";
        }
      }
    }
  }
</script>

<div id='select-title'>
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

<div id='select-cat'>
  Välj kategori:
  <select onchange="changeContentCategory(this)">
    <option value='all'>--Alla--</option>
    <?php
    foreach ($cat as $type) {
      echo "<option value='" . $type['category'] . "'>" . $type['category'] . "</option>";
    }
    ?>
  </select>
</div>

<div id='head-all'><h2>Alla objekt</h2></div>
<div id='head-cat' style='display:none'><h2>Objekt kategori</h2></div>
<div id='head' style='display:none'><h2>Objekt</h2></div>
<?php
$i = 0;
$j = 0;
foreach($res as $object): ?>
  <div class='object' id='<?php echo $i++; ?>'>
    <strong><?php echo $object['title']; ?></strong><br>
    <div id='cat-<?php echo $j++; ?>' class='<?php echo $object['category']; ?>'>Kategori: <?php echo $object['category']; ?></div>
    <div class='obj_img'><img src='<?php echo $object['image']; ?>' alt='<?php echo $object['title']; ?>'></div>
    <?php echo $object['text']; ?>
    <p class='objectauth'><?php echo $object['owner']; ?></p>
  </div>
<?php endforeach; ?>
