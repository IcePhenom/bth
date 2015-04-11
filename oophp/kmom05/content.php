<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

$content = new CContent($db);

if($user->login_check())
	$res = $content->getAllContent();
else
	$res = $content->getContent();

$list = null;
foreach ($res as $key => $val) {
	if($user->login_check())
		$list .= "<li>".$val->TYPE." (".$val->stat."): <a href='".$content->getUrlToContent($val)."'>".htmlentities($val->title, null, 'UTF-8')."</a> (<a href='edit.php?id=".$val->id."'>Edit</a> <a href='edit.php?del=1&id=".$val->id."'>Ta bort</a>)</li>\n";
	else
		$list .= "<li>".$val->TYPE.": <a href='".$content->getUrlToContent($val)."'>".htmlentities($val->title, null, 'UTF-8')."</a></li>\n";
}

$mfact['title'] = "Visa allt innehåll";
$mfact['main'] = "<h1>".$mfact['title'].
				"</h1><p>Lista med innehåll</p>
				<ul>".$list."</ul>
				<p><a href='blog.php'>Visa blogg</a>";
if($user->login_check())
				$mfact['main'] .= " <a href='edit.php?id=-1'>Lägg till innehåll</a> <a href='edit.php?reset=1'>Återställ</a></p>";

include(MFACT_THEME_PATH);
