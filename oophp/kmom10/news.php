<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

$news = new CNews($db);
$filter = new CFilter();

$id = isset($_GET['nid']) && !empty($_GET['nid']) ? $_GET['nid'] : null;
$cat = isset($_GET['cat']) && !empty($_GET['cat']) ? $_GET['cat'] : null;

$mfact['title'] = "News";

if($id){
	$res = $news->getNews($id);
	$mfact['main'] = "<div class='news'>
	<div class='breadCrumb'><a href='news.php'>News</a> / <a href='news.php?cat=".$res['category']."'>".$res['category']."</a> / ".$res['title']."</div>
	<div class='newsTitle'>".$res['title']."</div>
	<div class='newsInfo noLink'>".$res['text']."</div>
	</div>";
}
else if($cat){
	$mfact['main'] = "<div class='news'>
	<div class='breadCrumb'><a href='news.php'>News</a> / <a href='news.php?cat=".$cat."'>".$cat."</a> / </div>";

	foreach ($news->getAllNews($cat) as $res) {
		$mfact['main'] .= "<div class='newsTitle noLink'><a href='news.php?nid=".$res['id']."'>".$res['title']."</a></div>
		<div class='newsInfo noLink bottom'>".$res['data']."</div>";
	}
	$mfact['main'] .= "</div>";
}
else{
	$mfact['main'] =
	"<div class='category'>
	<table>
	<td><a href='".$news->oldQuery(array('cat' => 'Products'))."'>Product news</a></td>
	<td><a href='".$news->oldQuery(array('cat' => 'Company'))."'>Company news</a></td>
	<td><a href='".$news->oldQuery(array('cat' => 'Campain'))."'>Campain news</a></td>
	</table>
	</div>
	<div class='news'>";
	foreach ($news->getAllNews() as $res) {
		$mfact['main'] .= "<div class='newsTitle noLink'><a href='news.php?nid=".$res['id']."'>".$res['title']."</a></div>
		<div class='newsInfo noLink bottom'>".$res['data']."</div>";
	}
	$mfact['main'] .= "</div>";
}

include(MFACT_THEME_PATH);
