<!doctype html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title><?=$title?></title>
	<link rel="stylesheet" href="style/stylesheet.css" title="General stylesheet">
	<link rel="alternate stylesheet" href="style/debug.css" title="Debug stylesheet">
	<link rel="shortcut icon" href="img/favicon.ico">
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<!-- The body id helps with highlighting current menu choice -->
<body<?php echo isset($pageId)?" id='$pageId' ":""; ?>>
	<!-- Above header -->
	<header id="above">
		<?php echo userLoginMenu(); ?>
	  <!-- Relateted links -->
	  <nav class="related">
	    <a href="../Kmom01/me.php">kmom01</a>
	    <a href="../Kmom02/me.php">kmom02</a>
	    kmom03
	  </nav>
	</header>
	<!-- Header -->
	<header id="top">
	    <a href="me.php"><img src="img/logo.png" alt="htmlphp logo" width=300 height=70></a>
		<nav class="navmenu">
		    <a id="me-"     href="me.php">Me</a>
			<a id="report-" href="report.php">Redovisning</a>
			<a id="test-"	href="test.php">Test</a>
			<a id="source-" href="viewsource.php">Källkod</a>
		</nav>
	</header>