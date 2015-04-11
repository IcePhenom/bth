<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

$page = new CPage($db);
$filter = new CFilter();

$url = isset($_GET['url']) ? $_GET['url'] : null;
$acr = $user->login_check() ? $_SESSION['username'] : null;

$res = $page->getPage($url);

if(isset($res[0]))
	$cont = $res[0];
else
	die('Inget innehåll');

$title = htmlentities($cont->title, null, 'UTF-8');
$data  = $filter->doFilter(htmlentities($cont->DATA, null, 'UTF-8'), $cont->FILTER);

$edit = $acr ? "<a href='edit.php?id=".$cont->id."'>Uppdatera sidan</a>" : null;

$mfact['title'] = $title;
$mfact['main'] = "
	<h1>".$title."</h1>"
	.$data.
	"<br>".$edit;

include(MFACT_THEME_PATH);
