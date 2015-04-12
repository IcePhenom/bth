<!doctype html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title><?=$title?></title>
	<!-- links to external stylesheets -->
	<?php echo stylesheet(); ?>

	<link rel="shortcut icon" href="img/favicon.ico">

	<!-- Each page can set $pageStyle to create an internal stylesheet -->
	<?php echo pageStyle($pageStyle); ?>

	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<!-- The body id helps with highlighting current menu choice -->
<body<?php echo isset($pageId) ? " id='$pageId' " : ""; ?>>
	<!-- Above header -->
	<header id="above">
		<?php echo userLoginMenu(); ?>
	  <!-- Relateted links -->
	  <?php echo menuAbove(); ?>
	</header>
	<!-- Header -->
	<header>
		<?php echo logo(); ?>

		<?php echo menu(); ?>
	</header>
