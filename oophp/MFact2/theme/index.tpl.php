<!doctype html>
<html lang='<?=$lang?>'>
<head>
<meta charset='utf-8'/>
<title><?=get_title($title)?></title>
<?php if(isset($favicon)): ?><link rel='shortcut icon' href='<?=$favicon?>'/><?php endif; ?>
<?php foreach($stylesheets as $val): ?>
<link rel='stylesheet' type='text/css' href='<?=$val?>'/>
<?php endforeach; ?>
<?php foreach($javascript_include as $val): ?>
<script type="text/javascript" src='<?=$val?>'></script>
<?php endforeach; ?>
</head>
<body>
	<header>
		<?=$header?><?=menu($menu)?>
	</header>
	<section>
		<?=$image?><?=$main?>
	</section>
	<footer>
		<?=$footer?>
	</footer>
	<script>
		jQuery(document).ready(function($) {
			$('#mainImage').bjqs({});
		});
	</script>
</body>
</html>
