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
