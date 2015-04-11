<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

$blog = new CBlog($db);
$filter = new CFilter();

$slug = isset($_GET['slug']) ? $_GET['slug'] : null;
$acr = $user->login_check() ? $_SESSION['username'] : null;

$res = $blog->getBlog($slug);

$mfact['title'] = "Bloggen";

$mfact['main'] = null;

if(isset($res[0])) {
	foreach ($res as $c) {
		$title = htmlentities($c->title, null, 'UTF-8');
		$data  = $filter->doFilter(htmlentities($c->DATA, null, 'UTF-8'), $c->FILTER);

		if($slug)
			$mfact['title'] = "$title | ".$mfact['title'];

		$edit = $acr ? "<a href='edit.php?id=".$c->id."'>Uppdatera posten</a>" : null;

		$mfact['main'] .= "
		<h1><a href='blog.php?slug=".$c->slug."'>".$title."</a></h1>"
		.$data.
		"<br>".$edit;
	}
}
else if($slug)
	$mfact['main'] = "Det fanns ingen blogpost";
else
	$mfact['main'] = "Det fanns inga blogboster";

include(MFACT_THEME_PATH);
