<?php
require("gallery_main.php");
?>
<h2>Galleri</h2>
<script type="text/javascript" src="incl/gallery/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="incl/gallery/js/jquery.fancybox.js?v=2.1.5"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".fancybox").fancybox({
      helpers : {
        title : {
          type : 'inside'
        },
        overlay : {
          css : {
            'background' : 'rgba(160,160,160,0.75)'
          }
        }
      }
    });
  });
</script>
<?php
$p = (isset($_GET['p'])) ? $_GET['p'] : 0;
$n = (isset($_GET['n'])) ? $_GET['n'] : 10;

$gallery = new gallery(dirname(dirname(dirname(__FILE__))) . "/img/bmo/550", $n);
$gallery->loadGallery();

$pages = $gallery->paging();
$images = $gallery->listImages($p);

echo '<div class="perPage">Bilder per sida ';
for ($i=5; $i <= 15; $i+=5) {

  echo "<a href='gallery.php?p=0&n=$i'>$i</a> ";
}
echo '</div>';

echo '<div class="paging">';
for ($i=0; $i < $pages; $i++) {
  echo ($p == $i) ? "Sida ".($i+1)." " : "<a href='gallery.php?p=$i&n=$n'>Sida ".($i+1)."</a> ";
}
echo '</div>';

echo "<ul id='pictures'>";
foreach ($images as $img) {
  echo "<li><a class='fancybox' href='img/bmo/$img' data-fancybox-group='a'><img src='img/bmo/250/$img' alt='' /></a></li>";
}
echo '</ul>';
