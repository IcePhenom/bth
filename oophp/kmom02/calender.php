<?php 
/**
 * This is a MFact pagecontroller.
 *
 */
// Include the essential config-file which also creates the $mfact variable with its defaults.
include(__DIR__.'/config.php'); 



// Demonstration of module CCalender
$cal = new CCalender(0);

// Do it and store it all in variables in the M! container.
$mfact['title'] = "Calender";

$mfact['main'] = 
"<h1>Kalender Mini</h1>".$cal->show(true)."<br><br><h1>Kalender regular</h1>".$cal->show();


// Finally, leave it all to the rendering phase of M!.
include(MFACT_THEME_PATH);
