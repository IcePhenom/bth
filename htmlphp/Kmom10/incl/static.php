<?php
/**
 * --- header ---------------------------------------------
 */

function stylesheet() {
  if (isset($_SESSION['stylesheet'])) {
    return "<link rel='stylesheet' href='style/" . $_SESSION['stylesheet'] . "'";
  }
  else {
      return "<link rel='stylesheet' href='style/stylesheet.css' title='General stylesheet'>";
  };
}

function pageStyle($pageStyle) {
  if (isset($pageStyle)) {
    return '<style type="text/css">' . $pageStyle . '</style>';
  }
}

function menuRelated() {
  return "<nav class='related'>
    <a href='../Kmom01/me.php'>kmom01</a>
    <a href='../Kmom02/me.php'>kmom02</a>
    <a href='../Kmom03/me.php'>kmom03</a>
    <a href='../Kmom04/me.php'>kmom04</a>
    <a href='../Kmom05/me.php'>kmom05</a>
    <a href='../Kmom06/me.php'>kmom06</a>
    <a href='../Kmom10/me.php'>kmom10</a>
  </nav>";
}

function logo() {
  return "<a href='index.php'><img src='img/logo2.png' alt='BMO logo'></a>";
}

function menu() {
  return "<nav class='navmenu'>
    <a id='index-' href='index.php'>Hem</a>
    <a id='article-' href='article.php'>Artiklar</a>
    <a id='object-' href='object.php'>Objekt</a>
    <a id='gallery-' href='gallery.php'>Galleri</a>
    <a id='about-' href='about.php'>Om BMO</a>"
    . userLoginMenu() .
  "</nav>";
}

/**
 * --- footer ---------------------------------------------
 */

function tools() {
  $url = getCurrentUrl();
  return "<a href='http://validator.w3.org/check/referer'>HTML5</a>
  <a href='http://jigsaw.w3.org/css-validator/check/referer'>CSS</a>
  <a href='http://jigsaw.w3.org/css-validator/check/referer?profile=css3'>CSS3</a>
  <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a>
  <a href='http://validator.w3.org/i18n-checker/check?uri=" . $url . "'>i18n</a>
  <a href='http://validator.w3.org/checklink?uri=" . $url . "'>Links</a>";
}

/**
 * --- main -----------------------------------------------
 */

function f_front(&$title, &$file) {
  if (isset($_GET["p"])) {
    switch($_GET["p"]) {
      case "init":
        $title = "Initiera";
        $file  = "init.php";
        return;
      case "update":
        $title = "Updatera framsida";
        $file  = "update.php";
        return;
    }
  }
}

function f_article(&$title, &$file) {
  if (isset($_GET["p"])) {
    switch($_GET["p"]) {
      case "init":
        $title = "Initiera annonserna";
        $file  = "init.php";
        return;
      case "update":
        $title = "Visa och uppdatera annonser";
        $file  = "update.php";
        return;
      case "create":
        $title = "Skapa ny annons";
        $file  = "create.php";
        return;
      case "delete":
        $title = "Radera annons";
        $file  = "delete.php";
        return;
      case "read-all":
        $title = "Visa alla annonser";
        $file  = "default.php";
        return;
    }
  }
}

function f_object(&$title, &$file) {
  if (isset($_GET["p"])) {
    switch($_GET["p"]) {
      case "init":
        $title = "Initiera objekten";
        $file  = "init.php";
        return;
      case "update":
        $title = "Visa och uppdatera objekt";
        $file  = "update.php";
        return;
      case "create":
        $title = "Skapa nytt objekt";
        $file  = "create.php";
        return;
      case "delete":
        $title = "Radera objekt";
        $file  = "delete.php";
        return;
      case "read-all":
        $title = "Visa alla objekt";
        $file  = "default.php";
        return;
    }
  }
}

function authenticate(&$title, &$content) {
  $p = isset($_GET["p"])? $_GET["p"] : null;

  if($p == "login") {
    $title = "Logga in";
    $content = userLogin();
  }
  else if ($p == "logout") {
    $title = "Logga ut";
    $content = userLogout();
  }
}

function authPrint($content) {
  if(isset($content)) {
    return $content;
  }
}
