<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

$mfact['title'] = 'Assignments';
$mfact['main']  = '<h1>Please select module</h1>';

foreach ($mfact['menu']['assign']['sub'] as $link) {
	$mfact['main']  .= "
		<p><a href='".$link['url']."'>".$link['text']."</a></p>";
}

include(MFACT_THEME_PATH);
