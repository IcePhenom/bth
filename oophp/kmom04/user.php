<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

if($user->login_check()){
	$mfact['title'] = "User";
	$mfact['main'] = "<h1>User logged in ".$_SESSION['username']."</h1>
						<p><a href='movieDB.php'>Edit movieDB</a></p>
						<p><a href='logout.php'>Logout</a></p>";
}
else{
	header("location:login.php");
}

include(MFACT_THEME_PATH);
