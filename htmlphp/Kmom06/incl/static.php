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

function menuAbove() {
  return "<nav class='related'>
    <a href='../Kmom01/me.php'>kmom01</a>
    <a href='../Kmom02/me.php'>kmom02</a>
    <a href='../Kmom03/me.php'>kmom03</a>
    <a href='../Kmom04/me.php'>kmom04</a>
    <a href='../Kmom05/me.php'>kmom05</a>
  </nav>";
}

function logo() {
  if (isset($_SESSION['stylesheet']) && $_SESSION['stylesheet'] == "fancys.css") {
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
    <a id='blokket-' href='blokket2.php'>Blokket2</a>
    <a id='source-' href='viewsource.php'>Källkod</a>
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
