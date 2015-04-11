<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$title?></title>
	<link rel="stylesheet" href="style/stylesheet.css" title="General stylesheet">
	<link rel="alternate stylesheet" href="style/debug.css" title="Debug stylesheet">
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
<body<?php if(isset($pageId)) echo " id='$pageId' "; ?>>
	<!-- Above header -->
	<header id="above">
	  <!-- Relateted links -->
	  <nav class="related">
	    <a href="../Kmom01/me.php">kmom01</a>
	    kmom02
	  </nav>
	</header>
	<!-- Header -->
	<header id="top">
	    <a href="me.php"><img src="img/logo.png" alt="htmlphp logo" width=300 height=70></a>
		<nav class="navmenu">
		    <a id="me-"     href="me.php">Me</a>
			<a id="report-" href="report.php">Redovisning</a>
			<a id="source-" href="viewsource.php">Källkod</a>
		</nav>
	</header>