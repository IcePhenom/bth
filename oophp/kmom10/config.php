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
define('MFACT_INSTALL_PATH', __DIR__ . '/../MFact2');
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
// $user = new CUser($db);
// $user->sec_session_start();

/**
 * Create the M! variable.
 */
$mfact = array();

/**
 * Site wide settings.
 */
$mfact['lang']         = 'sv';
$mfact['title_append'] = ' - Rental Machines';

$mfact['header'] =
"<div class='head left'><img src='img/head.png' alt='RM Rental Machine'><br>
<span class='siteslogan'>\"Oh my goddess, it's a rental\"</span></div>";

$mfact['image'] = "";

$mfact['footer'] =
"<span class='sitefooter'>Copyright (c) RM Rental Machines inc. 2014 | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span>";

/**
 * The menu
 */
$mfact['menu'] = array(
    'home'		=> array('text'=>'Home',	'url'=>'index.php',	 'title' => 'Main', 'sub' => 0),
    'hw' 		=> array('text'=>'Hardware',	'url'=>'hw.php',	 'title' => 'Products', 'sub' => 0),
    'news'    => array('text'=>'News',   'url'=>'news.php',   'title' => 'News', 'sub' => 0),
    'about'      => array('text'=>'About',  'url'=>'about.php', 'title' => 'About', 'sub' => 0)
);

/**
 * Theme related settings.
 */
$mfact['stylesheets'] = array('css/style.css', 'css/source.css', 'css/calendar.css', 'css/dbtable.css', 'css/dice.css', 'css/gallery.css');
$mfact['favicon']    = 'favicon.ico';

/**
 * Settings for JavaScript.
 */
$mfact['javascript_include'] = array('js/form.js','js/sha512.js', 'js/jquery-1.11.2.min.js', 'js/bjqs-1.3.js');