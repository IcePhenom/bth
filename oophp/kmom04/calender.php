<?php
/**
 * This is a MFact pagecontroller.
 */
include(__DIR__.'/config.php');

$cal = new CCalender();

$mfact['title'] = "Calender";
$mfact['main'] = "<h1>Kalender regular</h1>".$cal->show();
$mfact['side'] = "<h2>Kalender Mini</h2>".$cal->show(true);

include(MFACT_THEME_PATH);
