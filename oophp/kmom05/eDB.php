<?php
include(__DIR__.'/config.php');

if(!$user->login_check())
		header("location:login.php");

if(isset($_GET['reset'])){
	$db->Insert(fread(fopen("resetMDB.sql", "r"),filesize("resetMDB.sql")));
	header("location:movieDB.php");
}
elseif(isset($_POST['save'])){
	if($_POST['save'] == 'Edit'){
		$id    = isset($_POST['id'])? strip_tags($_POST['id']) : (isset($_GET['edit'])? strip_tags($_GET['edit']) : null);
		$title = isset($_POST['title'])? strip_tags($_POST['title']) : null;
		$year  = isset($_POST['year'])? strip_tags($_POST['year'])  : null;

		is_numeric($id) or die('Check: Id must be numeric.');
		$db->Insert('UPDATE Movie SET Title = :t, Year = :y WHERE Id = :id', array(':t'=>$title,':y'=>$year,':id'=>$id));
	}
	elseif($_POST['save'] == 'Del'){
		$id = isset($_POST['id'])? strip_tags($_POST['id']) : (isset($_GET['del'])? strip_tags($_GET['del']) : null);

		$db->Insert('DELETE FROM Movie2Genre WHERE idMovie = :id', array(':id'=>$id));
		$db->Insert('DELETE FROM Movie WHERE Id = :id LIMIT 1', array(':id'=>$id));
	}
	elseif($_POST['save'] == 'Create'){
		$title = isset($_POST['title'])? strip_tags($_POST['title']) : null;
		$year  = isset($_POST['year'])? strip_tags($_POST['year'])  : null;

		$db->Insert('INSERT INTO Movie (Title,Year) VALUES (:t,:y)', array(':t'=>$title,':y'=>$year));
		$id = $db->LastInsertId();

		if(!empty($_POST['list']))
		    foreach($_POST['list'] as $genre)
		        $db->Insert('INSERT INTO Movie2Genre (idMovie,idGenre) VALUES (:idMovie,:idGenre)', array(':idMovie'=>$id,':idGenre'=>$genre));

		header("location:movieDB.php?&order=Id&o=desc");
	}
	header("location:movieDB.php");
}
elseif(isset($_GET['create'])){
	$genre = $db->Query('SELECT * FROM Genre');
	$mfact['title'] = 'MovieDB - CREATE';
	$mfact['main']  = "<h1>MovieDB</h1>
		<form method='post'>
			<fieldset>
			<legend>Skapa ny film</legend>
			<p><label>Titel:<br/><input type='text' name='title'/></label></p>
			<p><label>År:<br/><input type='text' name='year'/></label></p><p>";
			foreach ($genre as $val) {
				$mfact['main'] .= "<input type='checkbox' name='list[]' value='".$val->id."'> ".$val->name."<br>";
			}
			$mfact['main'] .= "</p><p><input type='submit' name='save' value='Create'/></p>
			</fieldset>
		</form>";
}
elseif(isset($_GET['edit'])){
	$res = $db->SingleSelect('SELECT * FROM Movie WHERE Id = :id', array(':id'=>$_GET['edit']));
	$mfact['title'] = 'MovieDB - EDIT';
	$mfact['main']  = "<h1>MovieDB</h1>
			<form method='post'>
				<fieldset>
				<legend>Update movie info</legend>
				<input type='hidden' name='id' value='".$res['Id']."'/>
				<p><label>Titel:<br/><input type='text' name='title' value='".$res['Title']."'/></label></p>
				<p><label>År:<br/><input type='text' name='year' value='".$res['Year']."'/></label></p>
				<p><input type='submit' name='save' value='Edit'/></p>
				</fieldset>
			</form>";
}
elseif(isset($_GET['del'])){
	$res = $db->SingleSelect('SELECT * FROM Movie WHERE Id = :id', array(':id'=>$_GET['del']));
	$mfact['title'] = 'MovieDB - DEL';
	$mfact['main']  = "<h1>MovieDB</h1>
			<form method='post'>
				<fieldset>
				<legend>Delete movie</legend>
				<input type='hidden' name='id' value='".$res['Id']."'/>
				<p>Remove ".$res['Title']."</p>
				<p><input type='submit' name='save' value='Del'/></p>
				</fieldset>
			</form>";
}
else
	header("location:movieDB.php");

include(MFACT_THEME_PATH);