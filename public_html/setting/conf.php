<?php


//echo "conf page is included ........................................................";

// To hide Errors 
error_reporting(0);

//To shows Errors
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
session_start();


$dbusername = "root";
$dbpassword = "root";
$dbhost = "localhost";
$db ="mydb";
$imgpath = "../img/";

$GLOBALS['dbusername']= $dbusername ;
$GLOBALS['dbpassword']= $dbpassword ;
$GLOBALS['dbhost']= $dbhost ;
$GLOBALS['db']= $db ;
$GLOBALS['conn']= $conn ;
$GLOBALS['imgpath'] =$imgpath ;

$_SESSION['messages'] ="";
$_SESSION['username'] ="";
$_SESSION['sessid']= "";
$_SESSION['disname'] ="";

$GLOBALS['username'] = ""; 
$GLOBALS['named'] = "";
$GLOBALS['uid'] = "" ;


$GLOBALS['carousaltitle'] = "Carousal";
$GLOBALS['featurestitle'] = "Features";
$GLOBALS['eventtitle'] = "Event" ;
$GLOBALS['newstitle'] = "News";
$GLOBALS['subtitle'] ="Submitios";
$GLOBALS['usertitle'] = "User Profile";


?>