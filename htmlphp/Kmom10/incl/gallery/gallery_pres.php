<?php
require("gallery_main.php");

?>
<script type="text/javascript" src="incl/gallery/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="incl/gallery/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="incl/gallery/js/jquery.fancybox.css?v=2.1.5" media="screen" />
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

$gallery = new gallery(dirname(dirname(dirname(__FILE__))) . "/img/bmo/550", 10);
$gallery->loadGallery();

$pages = $gallery->paging();
$images = $gallery->listImages($p);

echo '<div class="paging">';
for ($i=0; $i < $pages; $i++) {
  echo ($p == $i) ? "Sida ".($i+1)." " : "<a href='gallery.php?p=$i'>Sida ".($i+1)."</a> ";
}
echo '</div>';

echo "<ul id='pictures'>";
foreach ($images as $img) {
  echo "<li><a class='fancybox' href='img/bmo/$img' data-fancybox-group='a'><img src='img/bmo/250/$img' alt='' /></a></li>";
}
echo '</ul>';
