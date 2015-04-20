<?php

/**
 * --- header ---------------------------------------------
 */

function stylesheet() {
  if (isset($_SESSION['stylesheet'])) {
    return "<link rel='stylesheet' href='style/" . $_SESSION['stylesheet'] . "'";
  }
  else {
      return "<link rel='stylesheet' href='style/stylesheet.css' title='General stylesheet'>
      <link rel='alternate stylesheet' href='style/debug.css' title='Debug stylesheet'>";
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
  </nav>";
}

function logo() {
  if (isset($_SESSION['stylesheet']) && $_SESSION['stylesheet'] == "fancy.css") {
    return "<a href='me.php'><img src='img/fancy.png' alt='fancy logo' width=200 height=90></a>";
  }
  else {
    return "<a href='me.php'><img src='img/logo.png' alt='htmlphp logo' width=300 height=70></a>";
  }
}

function menu() {
  return "<nav class='navmenu'>
    <a id='me-' href='me.php'>Me</a>
    <a id='report-' href='report.php'>Redovisning</a>
    <a id='test-' href='test.php'>Test</a>
    <a id='style-' href='style.php'>Style</a>
    <a id='blokket-' href='blokket.php'>Blokket</a>
    <a id='blokket2-' href='blokket2.php'>Blokket2</a>
    <a id='source-' href='viewsource.php'>Källkod</a>
    <a id='data-' href='data.php'>Data</a>

    <a id='hem-' href='index.php'>Data</a>
    <a id='data-' href='data.php'>Data</a>
    <a id='data-' href='data.php'>Data</a>
    <a id='data-' href='data.php'>Data</a>
    <a id='data-' href='data.php'>Data</a>
  </nav>";
}

/**
 * --- footer ---------------------------------------------
 */

function tools() {
  return "<a href='http://validator.w3.org/check/referer'>HTML5</a>
  <a href='http://jigsaw.w3.org/css-validator/check/referer'>CSS</a>
  <a href='http://jigsaw.w3.org/css-validator/check/referer?profile=css3'>CSS3</a>
  <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a>
  <a href='http://validator.w3.org/i18n-checker/check?uri=<?php echo getCurrentUrl(); ?>'>i18n</a>
  <a href='http://validator.w3.org/checklink?uri=<?php echo getCurrentUrl(); ?>'>Links</a>";
}


function manual() {
  return "<a href='http://www.w3.org/2009/cheatsheet/'>Cheatsheet</a>
  <a href='http://dev.w3.org/html5/spec/'>HTML5</a>
  <a href='http://www.w3.org/TR/CSS2/'>CSS2</a>
  <a href='http://www.w3.org/Style/CSS/current-work#CSS3'>CSS3</a>
  <a href='http://php.net/manual/en/index.php'>PHP</a>";
}

function pageTime($pageTimeGeneration) {
  if(isset($pageTimeGeneration)) {
    return "Page generated in " . round(microtime(true)-$pageTimeGeneration, 5) . " seconds";
  }
}

/**
 * --- main -----------------------------------------------
 */

function report() {
  $db = new PDO("sqlite:incl/data/data/static.sqlite");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

  $stmt = $db->prepare('SELECT * FROM report;');
  $stmt->execute();
  $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $ret = '';

  foreach ($res as $report) {
    $ret .= "<h2>" . $report['title'] . "</h2>";
    $ret .= $report['description'];
  }

  return $ret;
}

function style(&$title, &$file) {
  if (isset($_GET["p"])) {
    switch($_GET["p"]) {
      case "choose-stylesheet":
        $title = "Välj Stylesheet";
        $file  = "choose_stylesheet.php";
        return;

      case "edit-stylesheet":
        $title = "Edit Stylesheet";
        $file  = "edit_stylesheet.php";
        return;

      case "choose-stylesheet-process":
        include("style/choose_stylesheet_process.php");
        return;
    }
  }
}

function test(&$title, &$file) {
  if (isset($_GET["p"])) {
    switch($_GET["p"]) {
      case "kmom03-get":
        $title = "Test kmom03: Visa \$_GET";
        $file  = "kmom03_get.php";
        return;
      case "kmom03-getform":
        $title = "Test kmom03: Visa form med \$_GET";
        $file  = "kmom03_getform.php";
        return;
      case "kmom03-postform":
        $title = "Test kmom03: Visa form med \$_POST";
        $file  = "kmom03_postform.php";
        return;
      case "kmom03-validate":
        $title = "Test kmom03: Visa validering";
        $file  = "kmom03_validate.php";
        return;
      case "kmom03-server":
        $title = "Test kmom03: Visa \$_SERVER";
        $file  = "kmom03_server.php";
        return;
      case "kmom03-sessiondestroy":
        $title = "Test kmom03: Förstör sessionen";
        $file  = "kmom03_sessiondestroy.php";
        destroySession();
        return;
      case "kmom03-sessionchange":
        $title = "Test kmom03: Ändra värden i sessionen";
        $file  = "kmom03_sessionchange.php";
        return;
      case "kmom03-session":
        $title = "Test kmom03: ";
        $file  = "kmom03_session.php";
        return;
    }
  }
}

function blokket(&$title, &$file) {
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
      case "read":
        $title = "Visa annons";
        $file  = "read.php";
        return;
      case "read-all":
        $title = "Visa alla annonser";
        $file  = "read_all.php";
        return;
    }
  }
}

function blokket2(&$title, &$file) {
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
      case "read":
        $title = "Visa annons";
        $file  = "read.php";
        return;
      case "read-all":
        $title = "Visa alla annonser";
        $file  = "read_all.php";
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
  else {
    $ret = "<h1>Status login / logout</h1>
    <p>Denna webbplats har skyddade delar. Du måste logga in för att komma åt dem.</p>
    <p>För tillfället är du:";
    $ret .= userIsAuthenticated() ? "<strong>inloggad</strong>.</p>" : "<strong>ej inloggad</strong>.</p>";
    $ret .= userIsAuthenticated() ? "<p><a href='?p=logout'>Vill du logga ut</a>?</p>" : "<p><a href='?p=login'>Vill du logga in</a>?</p>";

    return $ret;;
  }
}
