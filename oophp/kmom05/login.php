<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

if(isset($_POST['user'])){
	if(isset($_POST['user'], $_POST['p'])){
		if($user->login($_POST['user'], $_POST['p'])){
			header("Location: user.php");
		}
		else{
			header("Location: login.php?e=1");
		}
	}
}
else{
	$mfact['title'] = "Login";
	$mfact['main'] = "<h1>User login</h1>
	<p>To login use bob:bob</p>
	<form action='login.php' method='post' name='login_form'>
		<input type='hidden' name='p'>
		<p>
			<label>Namn</label>
			<input class='text-input' type='text' name='user' id='user' />
		</p>
		<div class='clear'></div>
		<p>
			<label>Pass</label>
			<input class='text-input' type='password' name='password' id='password' />
		</p>
		<p>
			<input class='button' onclick='formhash(this.form, this.form.password)' type='submit' value='Login' />
		</p>
	</form>";

	if(isset($_GET['e'])){
		$mfact['main'] .= "<p class='redText'>BAD User OR Pass</p>";
	}
}

include(MFACT_THEME_PATH);
