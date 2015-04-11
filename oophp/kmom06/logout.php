<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

$user->logout();

header('Location:login.php');

include(MFACT_THEME_PATH);
