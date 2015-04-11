<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

$mfact['title'] = 'Results';

if(isset($_GET['s'])) {
	$res = $db->SingleSelect("SELECT title,main FROM pres WHERE id = :id", array(':id' => $_GET['s']));
	$mfact['title'] .= ''.$res['title'];
	$mfact['main'] 	= '<h1>Results</h1>'.$res['main'];
} else {
	$mfact['main']  = '<h1>Please select assignment</h1>';
	foreach ($mfact['menu']['res']['sub'] as $link)
		$mfact['main']  .= "<p><a href='".$link['url']."'>".$link['text']."</a></p>";
}

include(MFACT_THEME_PATH);