<?php
class gallery {
  private $path;
  private $perPage;
  private $images;

  function __construct($path, $perPage) {
    $this->path = $path;
    $this->perPage = $perPage;
  }

  function loadGallery() {
    $this->images = array();

    foreach (scandir($this->path) as $file) {
      if ($file != '.' && $file != '..') {
        $this->images[] = $file;
      }
    }
  }

  function paging($currentPage) {
    $pages = count($this->images)/$this->perPage;

    $ret = "";

    for ($i=0; $i < $pages; $i++) {
      $ret .= ($currentPage == $i) ? "Sida ".($i+1)." " : "<a href='gallery.php?p=$i&n=" . $this->perPage . "'>Sida ".($i+1)."</a> ";
    }
    return $ret;
  }

  function listImages($page) {
    return array_slice($this->images, $page*$this->perPage, $this->perPage);
  }
}
