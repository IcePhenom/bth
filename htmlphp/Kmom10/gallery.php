<?php
include("incl/config.php");
$title = "Galleri";
$pageId = "gallery";
$pageStyle = '';
?>

<?php include("incl/header.php"); ?>
<section id="content">
  <article class="left justify-para">
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
                'background' : 'rgba(0,0,0,0.75)'
              }
            }
          }
        });
      });
    </script>
    <?php

    $folder = dirname(__FILE__) . "/img/bmo/550";

    $images = array();

    foreach (scandir($folder) as $file) {
      if ($file != '.' && $file != '..') {
        $images[] = $file;
      }
    }

    $p = (isset($_GET['p'])) ? $_GET['p'] : 0;
    $perPage = 8;
    $pages = count($images)/$perPage;

    $image = array_slice($images, $p*$perPage, $perPage);

    $links = "";

    for ($i=0; $i < $pages; $i++) {
      $q = $i+1;
      $links .= ($p == $i) ? "Sida $q " : "<a href='gallery.php?p=$i'>Sida $q</a> ";
    }

    echo $links;

    echo "<ul id='pictures'>";
    foreach ($image as $img) {
      echo "<li><a class='fancybox' href='img/bmo/$img' data-fancybox-group='a'><img src='img/bmo/250/$img' alt='' /></a></li>";
    }
    echo '</ul>';
    ?>
  </article>
</section>
<?php include("incl/footer.php"); ?>
