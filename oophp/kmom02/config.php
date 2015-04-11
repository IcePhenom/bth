<?php
/**
 * Config-file for M!. Change settings here to affect installation.
 */

/**
 * Set the error reporting.
 */
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly


/**
 * Define M! paths.
 */
define('MFACT_INSTALL_PATH', __DIR__ . '/../MFact');
define('MFACT_THEME_PATH', MFACT_INSTALL_PATH . '/theme/render.php');


/**
 * Include bootstrapping functions.
 */
include(MFACT_INSTALL_PATH . '/src/bootstrap.php');


/**
 * Start the session.
 */
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();


/**
 * Create the M! variable.
 */
$mfact = array();


/**
 * Site wide settings.
 */
$mfact['lang']         = 'sv';
$mfact['title_append'] = ' - Nielsen 2014';

$mfact['header'] =
"<div class='left'><img class='sitelogo' src='img/mfact.png' alt='M! Logo'/></div>
<div class='left'><span class='sitetitle'>M! template design</span><br>
<span class='siteslogan'>MFact modules for PHP development</span></div>";

$mfact['side'] =
"Sidebar";

$mfact['footer'] =
"<span class='sitefooter'>Copyright (c) Mads Nielsen 2014 | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span>";

/**
 * The menu
 */
$mfact['menu'] = array(
    'home'		=> array('text'=>'Home',	'url'=>'index.php',	 'title' => 'Presentation', 'sub' => 0),
    'res' 		=> array('text'=>'Results',	'url'=>'pres.php',	 'title' => 'Redovisning',
    	'sub' => array(
    		'kmom1' => array('text'=>'Kmom01', 'url'=>'pres.php?s=kmom1', 'title' => 'Redovisning Kmom01'),
    		'kmom2' => array('text'=>'Kmom02', 'url'=>'pres.php?s=kmom2', 'title' => 'Redovisning Kmom02'),
    		'kmom3' => array('text'=>'Kmom03', 'url'=>'pres.php?s=kmom3', 'title' => 'Redovisning Kmom03'),
    		'kmom4' => array('text'=>'Kmom04', 'url'=>'pres.php?s=kmom4', 'title' => 'Redovisning Kmom04'),
    		'kmom5' => array('text'=>'Kmom05', 'url'=>'pres.php?s=kmom5', 'title' => 'Redovisning Kmom05'),
    		'kmom6' => array('text'=>'Kmom06', 'url'=>'pres.php?s=kmom6', 'title' => 'Redovisning Kmom06'),
    		'kmom7' => array('text'=>'Kmom07', 'url'=>'pres.php?s=kmom7', 'title' => 'Redovisning Kmom07'),
    		)),
    'dice'      => array('text'=>'Dice game',  'url'=>'dice.php', 'title' => 'Tärnings spel', 'sub' => 0),
    'cal'       => array('text'=>'Calender',  'url'=>'calender.php', 'title' => 'Månadens Babe', 'sub' => 0),
    'source'    => array('text'=>'Source',	'url'=>'source.php', 'title' => 'Källkod', 'sub' => 0)
);

/**
 * Theme related settings.
 */
$mfact['stylesheets'] = array('css/style.css', 'css/source.css');
$mfact['favicon']    = 'favicon.ico';