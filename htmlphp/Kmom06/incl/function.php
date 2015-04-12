<?php
function stylesheet($stylesheet) {
  if (isset($stylesheet)) {
    return "<link rel='stylesheet' href='style/$stylesheet;'";
  }
  else {
      return "<link rel='stylesheet' href='style/stylesheet.css' title='General stylesheet'><br>
      <link rel='alternate stylesheet' href='style/debug.css' title='Debug stylesheet'>";
  };
}

function pageStyle($pagestyle) {
  if (isset($pageStyle)) {
    return '<style type="text/css">' . $pageStyle . '</style>';
  }
}

function menuAbove() {
  return "<nav class='related'><br>
    <a href='../Kmom01/me.php'>kmom01</a><br>
    <a href='../Kmom02/me.php'>kmom02</a><br>
    <a href='../Kmom03/me.php'>kmom03</a><br>
    <a href='../Kmom04/me.php'>kmom04</a><br>
  </nav>";
}

function logo($stylesheet, $logotype) {
  if (isset($stylesheet) && $stylesheet == $logotype) {
    return "<a href='me.php'><img src='img/fancy.png' alt='fancy logo' width=200 height=90></a>";
  }
  else {
    return "<a href='me.php'><img src='img/logo.png' alt='htmlphp logo' width=300 height=70></a>";
  }
}
