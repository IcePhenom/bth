<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?=$title?></title>
		<link rel="shortcut icon" href="img/favicon.ico">
		<link rel="stylesheet" href="style/main.css" />
	</head>
	<body <?php echo isset($pageId) ? " id='$pageId' " : ""; ?>>
		<div id="page-wrapper">

			<!-- Header -->
			<header id="header">
				<div class="logo container">
					<div>
						<h1><a href="index.php" id="logo">BMO</a></h1>
						<p>Begravningsmuseum Online</p>
					</div>
				</div>
			</header>

			<!-- Nav -->
			<?php echo menu(); ?>
