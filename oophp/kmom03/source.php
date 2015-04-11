<?php 
/**
 * This is a M! pagecontroller.
 *
 */
// Include the essential config-file which also creates the $mfact variable with its defaults.
include(__DIR__.'/config.php'); 
$source = new CSource(array('secure_dir' => '..', 'base_dir' => '..'));


// Do it and store it all in variables in the M! container.
$mfact['title'] = "Source";

$mfact['main'] = 
"<h1>View sourcecode</h1>".
$source->View();

// Finally, leave it all to the rendering phase of M!.
include(MFACT_THEME_PATH);
