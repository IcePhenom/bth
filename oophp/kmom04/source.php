<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');
$source = new CSource(array('secure_dir' => '..', 'base_dir' => '..'));

$mfact['title'] = "Source";
$mfact['main'] = "<h1>View sourcecode</h1>".$source->View();

include(MFACT_THEME_PATH);
