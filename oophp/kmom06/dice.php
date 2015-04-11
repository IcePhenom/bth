<?php
/**
 * This is a MFact pagecontroller.
 */
include(__DIR__.'/config.php');

$game = new CDieGame();

$mfact['title'] = "Dice game";
$mfact['main'] = "<h1>Kasta tärning</h1>".$game->show();
$mfact['side'] = $game->side();

include(MFACT_THEME_PATH);
