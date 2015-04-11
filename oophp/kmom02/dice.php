<?php 
/**
 * This is a MFact pagecontroller.
 *
 */
// Include the essential config-file which also creates the $mfact variable with its defaults.
include(__DIR__.'/config.php'); 



// Demonstration of module CDice
$game = new CDieGame();

// Do it and store it all in variables in the M! container.
$mfact['title'] = "Dice game";

$mfact['main'] = 
"<h1>Kasta tärning</h1>".$game->show();


// Finally, leave it all to the rendering phase of M!.
include(MFACT_THEME_PATH);
