<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

$movie = new CMovieDB($db);

$title = isset($_GET['title']) && !empty($_GET['title'])? $_GET['title'] : null;
$genre = isset($_GET['genre'])? $_GET['genre'] : null;
$perPage  = isset($_GET['perPage']) && is_numeric($_GET['perPage'])? $_GET['perPage'] : 8;
$page  = isset($_GET['page']) && is_numeric($_GET['page'])? $_GET['page'] : 1;
$from  = isset($_GET['from']) && !empty($_GET['from'])? $_GET['from'] : null;
$to    = isset($_GET['to']) && !empty($_GET['to'])? $_GET['to'] : null;
$order = isset($_GET['order'])? $_GET['order'] : 'Id';
$o     = isset($_GET['o'])? $_GET['o'] : 'asc';

in_array($order, array('Id', 'Title', 'Year')) or die('Check: Not valid column.');
in_array($o, array('asc', 'desc')) or die('Check: Not valid sort order.');

$movie->setup($perPage, $page, $user);

$mfact['title'] = 'MovieDB';
$mfact['main'] = "<h1>MovieDB</h1>
		<form>
		<fieldset>
		<legend>Search</legend>
		<input type=hidden name=genre value='{$genre}'/>
		<input type=hidden name=perPage value='{$perPage}'/>
		<input type=hidden name=page value='1'/>
		<p><label>Titel (delsträng, använd % som *): <input type='search' name='title' value='{$title}'/></label></p>
		<p><label>Genre: </label>".$movie->genres($genre)."</p>
		<p><label>Skapad mellan åren: <input type='text' name='from' value='{$from}'/></label>
			- <label><input type='text' name='to' value='{$to}'/></label></p>
		<p><input type='submit' value='Search'/></p>
		<p><a href='?'>Show all</a></p>";
if($user->login_check())
	$mfact['main'] .= "<p><a href='eDB.php?reset=1'>Reset DB</a></p><p><a href='eDB.php?create=1'>Add movie</a></p>";

$mfact['main'] .= "</fieldset></form>".$movie->show($order, $o, $title, $from, $to, $genre, $perPage, $page);
$mfact['main'] .= "<p>Search string: ".$movie->showQuery()."</p><p>variables: ".$movie->showVariable()."</p>";

$mfact['side'] = "<h2>Månadens film</h2><p>".$movie->movieMonth()."</p>";

include(MFACT_THEME_PATH);
