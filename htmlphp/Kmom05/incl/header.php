<!doctype html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title><?=$title?></title>
	<!-- links to external stylesheets -->
	<?php if(isset($_SESSION['stylesheet'])): ?>
		<link rel="stylesheet" href="style/<?php echo $_SESSION['stylesheet']; ?>">
	<?php else: ?>
		<link rel="stylesheet" href="style/stylesheet.css" title="General stylesheet">
		<link rel="alternate stylesheet" href="style/debug.css" title="Debug stylesheet">
	<?php endif; ?>
	<link rel="shortcut icon" href="img/favicon.ico">

	<!-- Each page can set $pageStyle to create an internal stylesheet -->
	<?php if(isset($pageStyle)) : ?>
	<style type="text/css">
		<?php echo $pageStyle; ?>
	</style>
	<?php endif; ?>

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
	    <a href="../Kmom03/me.php">kmom03</a>
	    <a href="../Kmom04/me.php">kmom04</a>
	  </nav>
	</header>
	<!-- Header -->
	<header>
		<?php if(isset($_SESSION['stylesheet']) && $_SESSION['stylesheet'] == "fancy.css"): ?>
		<a href="me.php"><img src="img/fancy.png" alt="fancy logo" width=200 height=90></a>
		<?php else: ?>
	    <a href="me.php"><img src="img/logo.png" alt="htmlphp logo" width=300 height=70></a>
	    <?php endif; ?>
		<nav class="navmenu">
		    <a id="me-"     href="me.php">Me</a>
			<a id="report-" href="report.php">Redovisning</a>
			<a id="test-"	href="test.php">Test</a>
			<a id="style-"	href="style.php">Style</a>
			<a id="blokket-"	href="blokket.php">Blokket</a>
			<a id="source-" href="viewsource.php">Källkod</a>
		</nav>
	</header>
