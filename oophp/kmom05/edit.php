<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

$edit = new CContent($db);

if(isset($_GET['reset'])){
	$edit->resetDatabase();
	$db->Insert(fread(fopen("resetContent.sql", "r"),filesize("resetContent.sql")));
	header("location:content.php");
}

$id     	= isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
$title  	= isset($_POST['title']) ? $_POST['title'] : null;
$slug  		= isset($_POST['slug'])  ? $_POST['slug']  : null;
$url    	= isset($_POST['url'])   ? strip_tags($_POST['url']) : null;
$data   	= isset($_POST['data'])  ? $_POST['data'] : "";
$type   	= isset($_POST['type'])  ? strip_tags($_POST['type']) : "";
$filter 	= isset($_POST['filter']) ? $_POST['filter'] : "";
$published 	= isset($_POST['published'])  ? strip_tags($_POST['published']) : "";
$add	   	= isset($_POST['add'])  ? true : false;
$save   	= isset($_POST['save'])  ? true : false;
$delete   	= isset($_GET['del'])  ? true : false;
$acronym 	= isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;

if(!$user->login_check())
	die('CHECK: You must be logged in to add/edit/delete');
is_numeric($id) or die('CHECK: Id must be numeric');

$mfact['title'] = "Uppdatera innehåll";
$out = null;
if($add) {
	$url = empty($url) ? "" : $url;
	$param = array($title, $slug, $url, $data, $type, $filter, $published);

	if($edit->add($param))
		$out = "Post $title tillgad";
	else
		$out = "Post $title lades INTE till";

	$mfact['main'] = "
	<h1>".$mfact['title']."</h1>

	<output>{$out}</output>
	<p><a href='content.php'>Tillbaka</a></p>";

}
else if($save) {
	$url = empty($url) ? "" : $url;
	$param = array($title, $slug, $url, $data, $type, $filter, $published, $id);

	if($edit->save($param))
		$out = "Info $title sparat";
	else
		$out = "Info $title sparades INTE";

	$mfact['main'] = "
	<h1>".$mfact['title']."</h1>

	<output>{$out}</output>
	<p><a href='content.php'>Tillbaka</a></p>";
}
else if($delete) {
	if($edit->remove(array($id)))
		$out = "Post bortagen";
	else
		$out = "Post INTE bortagen";

	$mfact['main'] = "
	<h1>".$mfact['title']."</h1>

	<output>{$out}</output>
	<p><a href='content.php'>Tillbaka</a></p>";
}
else if($id != null && $id != -1) {
	$c = $edit->load($id);

	if(!isset($c))
		die('Misslyckades: det finns inget innehåll med id '. $id);

	$title  	= htmlentities($c['title'], null, 'UTF-8');
	$slug   	= htmlentities($c['slug'], null, 'UTF-8');
	$url    	= htmlentities($c['url'], null, 'UTF-8');
	$data   	= htmlentities($c['DATA'], null, 'UTF-8');
	$type   	= htmlentities($c['TYPE'], null, 'UTF-8');
	$filter 	= htmlentities($c['FILTER'], null, 'UTF-8');
	$published 	= htmlentities($c['published'], null, 'UTF-8');

	$mfact['main'] = "
		<h1>".$mfact['title']."</h1>

		<form method=post>
			<fieldset>
			<legend>Uppdatera innehåll</legend>
			<input type='hidden' name='id' value='{$id}'/>
			<p><label>Titel:<br/><input type='text' name='title' value='{$title}'/></label></p>
			<p><label>Slug:<br/><input type='text' name='slug' value='{$slug}'/></label></p>
			<p><label>Url:<br/><input type='text' name='url' value='{$url}'/></label></p>
			<p><label>Text:<br/><textarea name='data'>{$data}</textarea></label></p>
			<p><label>Type:<br/><input type='text' name='type' value='{$type}'/></label></p>
			<p><label>Filter:<br/><input type='text' name='filter' value='{$filter}'/></label></p>
			<p><label>Publiseringsdatum:<br/><input type='text' name='published' value='{$published}'/></label></p>
			<p class=buttons><input type='submit' name='save' value='Spara'/></p>
			<p><a href='content.php'>Avbryt</a></p>
			</fieldset>
		</form>
		";
}
else {
	$mfact['main'] = "
		<h1>".$mfact['title']."</h1>

		<form method=post>
			<fieldset>
			<legend>Lägg till innehåll</legend>
			<p><label>Titel:*</label><br/><input type='text' name='title'/></p>
			<p><label>Slug:*</label><br/><input type='text' name='slug'/></p>
			<p><label>Url:*</label><br/><input type='text' name='url'/></p>
			<p><label>Text:</label><br/><textarea name='data'></textarea></p>
			<p><label>Type: (post, page)</label><br/><input type='text' name='type'/></p>
			<p><label>Filter: (bbcode, link, markdown, nl2br)</label><br/><input type='text' name='filter'/></p>
			<p><label>Publiseringsdatum: (ÅÅÅÅ-MM-DD TT:MM:SS)</label><br/><input type='text' name='published'/></p>
			<p class=buttons><input type='submit' name='add' value='Spara'/></p>
			<p><a href='content.php'>Avbryt</a></p>
			</fieldset>
		</form>
		*Måste anges.
		";
}

include(MFACT_THEME_PATH);
