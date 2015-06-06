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

  function paging() {
    return count($this->images)/$this->perPage;
  }

  function listImages($page) {
    return array_slice($this->images, $page*$this->perPage, $this->perPage);
  }
}
