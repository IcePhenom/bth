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

/**
 * --- main -----------------------------------------------
 */

function report() {
  return "<h2>Kmom01: Kom igång med HTML, CSS och PHP</h2>
  <p>Momentet var väldigt enkelt då jag tidigare har sysslat med HTML och webbutveckling.<br>
  Men en bra och enkel grund för de som ej tidigare har hållt på med HTML.<br>
  Jag stötte inte på några problem då jag även har använt BTH system för webbsidor i tidigare kurser.</p>
  <p>Valde även att modifiera CSS till att använda lite andra färger på sidan än standard.</p>
  <p>Sitter på flera olika plattformar när jag utvecklar, Windows 7 Pro 64-bit, Linux Mint 13 (Gammal laptop) samt lite Mac OSX.<br>
  Gemensamt är dock verktygen jag använder, <strong>Sublime Text 3</strong> med plugins för webbutveckling, <strong>XAMPP</strong> (Apache + MySQL + PHP) för att köra sidan lokalt när jag utvecklar samt <strong>Filezilla</strong> för FTP.</p>
  <p>För att visa sidan använder jag både Firefox och Chrome beroende på utvecklingsplatform.</p>" .

  "<h2>Kmom02: HTML-element och CSS-konstruktioner</h2>
  <p>Även detta moment var väldigt enkelt då jag har erfarenhet av HTML osv. sedan tidigare.</p>
  <p>Känns även bra att man redan nu lär ut principen att dela upp sidan i flera bitar (Header, Main, Footer etc.).<br>Detta leder till större återanvändbarhet av kod samt att man miskar tiden vid underhåll av sidan, man behöver endast ändra på ett ställe för att ändra header/footer, man slipper gå igenom och ändra på varje sida.</p>
  <p>Har sysslat med HTML/CSS/PHP/MySQL de senaste 10 åren, vilket gör att jag skulle säga att jag är erfaren.</p>
  <p>Guiderna skumläste jag bara då det mesta sitter redan, men de verkar som en bra genomgång och som ger en bra grund för de som är nybörjare.</p>
  <p>Strukturen är helt ok då man separerar de olika kursmomenten vilket underlättar att se utvecklingen som sker, samt underlättar rättningen för er.</p>" .

  "<h2>Kmom 03: Dynamisk webbplats med PHP</h2>
  <p>Jag har tidigare jobbat med" . ' $_GET, $_POST, $_SESSION och $_SERVER' . " vilket gjorde att momentet gick väldigt smidigt och utan problem.</p>
  <p>Trevlig liten \"bugg\" med getCurrentUrl(), och jag tycker den skall finnas kvar då de som inte är uppmärksamma får skylla sig själva.</p>
  <p>Återigen en vettig genomgång av de grundläggande variablerna i PHP som man måste kunna hantera om man skall programera PHP.</p>
  <p>Har sysslat med HTML/CSS/PHP/MySQL i olika omfattning de senaste 10 åren, vilket gör att jag skulle säga att jag är erfaren.</p>
  <p>Har även programerat med Java,C++,C,Scala,MySQL. Då PHP, Java och C++ delar grundläggande syntax med C är det väldigt enkelt att sätta sig in i även om man inte har erfarenhet av det tidigare.</p>
  <p>PHP är vad man gör det till. Tycker man det är tråkigt blir det tråkigt och tvärt om. Relativt enkelt att sätta sig in i och väldigt lätt att testa då detta sker direkt i webbläsaren och inte behöver kompileras först likt Java,C/C++.</p>
  <p>PHP20 guiden är bra om man är ny i PHP, dock använde jag den inte utan körde på egna kunskaper.</p>" .

  "<h2>Kmom04: CSS och en style-väljare i PHP</h2>
  <p>Detta var ett intressant moment, att låta användaren välja CSS har jag inte stött på tidigare och var därför lärorikt att gå igenom.</p>
  <p>Själva stylingen med CSS var inga problem då det är en reguljär del i att utveckla hemsidor som jag gjort ett bra tag.</p>
  <p>Resultatet av det hela blev en ny insikt i hur man kan låta användaren \"anpassa\" utseendet på sin sida utan att den behöver kunna något om webbdesign och CSS.</p>
  <p>Har kunskap sedan tidigare av CSS, det var inga problem att bemästra det under detta kursmoment.</p>
  <p>Har sysslat med HTML/CSS/PHP/MySQL i olika omfattning de senaste 10 åren, vilket gör att jag skulle säga att jag är erfaren.</p>
  <p>Med CSS kan man på ett väldigt enkelt och snabbt sätt skapa en ny design på en sida utan att man behöver ändra på HTML strukturer nämnvärt.</p>
  <p>Ja jag lyckades med style väljaren, det extra CSS gjorde jag genom att välja färgglada kombinationer för att styla sidan, går under namnet fancy.css.</p>";
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
