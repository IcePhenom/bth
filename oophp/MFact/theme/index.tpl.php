<!doctype html>
<html class='no-js' lang='<?=$lang?>'>
<head>
<meta charset='utf-8'/>
<title><?=get_title($title)?></title>
<?php if(isset($favicon)): ?><link rel='shortcut icon' href='<?=$favicon?>'/><?php endif; ?>
<?php foreach($stylesheets as $val): ?>
<link rel='stylesheet' type='text/css' href='<?=$val?>'/>
<?php endforeach; ?>
<script src='<?=$modernizr?>'></script> <!-- NOT NEEDED? -->
</head>
<body>
	<header>
		<?=menu($menu)?>
	</header>
	<main>
		<section>
		    <div class='left main_top'><?=$header?></div>
		</section>
		<section>
			<div class='left main_center'><?=$main?></div>
			<aside><?=$side?></aside>
		</section>
		<footer>
			<div><?=$footer?></div>
		</footer>
	</main>


<!-- NOT NEEDED? -->
<?php if(isset($jquery)):?><script src='<?=$jquery?>'></script><?php endif; ?>

<?php if(isset($javascript_include)): foreach($javascript_include as $val): ?>
<script src='<?=$val?>'></script>
<?php endforeach; endif; ?>

<?php if(isset($google_analytics)): ?>
<script>
  var _gaq=[['_setAccount','<?=$google_analytics?>'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<?php endif; ?>
<!-- END NOT NEEDED? -->

</body>
</html>
