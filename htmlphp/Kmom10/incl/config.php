<?php
error_reporting(-1);

// start a named session
session_name(preg_replace('/[:\.\/-_]/', '', __FILE__));
session_start();

// include common functions
include_once(dirname(__FILE__) . "/../src/common.php");

// include functions for login & logout
include_once(dirname(__FILE__) . "/../src/login.php");
include_once(dirname(__FILE__) . "/static.php");

// account and password that can login
$userAccount = "john";
$userPassword = userPassword("doe");

// Path to the SQLite database file
$dbPath = dirname(__FILE__) . "/data/bmo.sqlite";

// Connect to the database
$db = new PDO("sqlite:$dbPath");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Display errors, but continue script
