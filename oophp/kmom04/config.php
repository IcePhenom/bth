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
 * Settings for the database.
 */
$mfact['database']['dsn']            = 'mysql:host=blu-ray.student.bth.se;dbname=manr14;';
$mfact['database']['username']       = 'manr14';
$mfact['database']['password']       = 'N41t)Wn5';
$mfact['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");

/**
 * Start the session.
 */
$db = new CDatabase($mfact['database']);
$user = new CUser($db);
$user->sec_session_start();

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
    		'kmom1' => array('text'=>'Kmom_01', 'url'=>'pres.php?s=kmom1', 'title' => 'Redovisning Kmom01'),
    		'kmom2' => array('text'=>'Kmom_02', 'url'=>'pres.php?s=kmom2', 'title' => 'Redovisning Kmom02'),
    		'kmom3' => array('text'=>'Kmom_03', 'url'=>'pres.php?s=kmom3', 'title' => 'Redovisning Kmom03'),
    		'kmom4' => array('text'=>'Kmom_04', 'url'=>'pres.php?s=kmom4', 'title' => 'Redovisning Kmom04'),
    		'kmom5' => array('text'=>'Kmom_05', 'url'=>'pres.php?s=kmom5', 'title' => 'Redovisning Kmom05'),
    		'kmom6' => array('text'=>'Kmom_06', 'url'=>'pres.php?s=kmom6', 'title' => 'Redovisning Kmom06'),
    		'kmom7' => array('text'=>'Kmom_07', 'url'=>'pres.php?s=kmom7', 'title' => 'Redovisning Kmom07')
    		)),
    'assign'    => array('text'=>'Assigments',   'url'=>'assign.php',   'title' => 'Redovisning',
        'sub' => array(
            'dice' => array('text'=>'Dice game',  'url'=>'dice.php', 'title' => 'Tärnings spel', 'sub' => 0),
            'cal'  => array('text'=>'Calender',  'url'=>'calender.php', 'title' => 'Månadens Babe', 'sub' => 0),
            'mov'  => array('text'=>'MovieDB',  'url'=>'movieDB.php', 'title' => 'Filmdatabas', 'sub' => 0)
            )),
    'user'      => array('text'=>'User',  'url'=>'user.php', 'title' => 'Användare', 'sub' => 0),
    'source'    => array('text'=>'Source',	'url'=>'source.php', 'title' => 'Källkod', 'sub' => 0)
);

/**
 * Theme related settings.
 */
$mfact['stylesheets'] = array('css/style.css', 'css/source.css');
$mfact['favicon']    = 'favicon.ico';

/**
 * Settings for JavaScript.
 */
$mfact['javascript_include'] = array('js/form.js','js/sha512.js');