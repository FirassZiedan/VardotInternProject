<?php

//----------------------
/*
error_reporting(0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);
*/
//-----------------------

class mySQLConn{
    public $dbh;  //Variable for storing connection

public function connect(/*$set_host, $set_username, $set_password, $set_database*/){
  $this->host = "localhost"; //$set_host;
  $this->username = "root"; //$set_username;
  $this->password = "root"; //$set_password;
  $this->database = "mydb"; //$set_database;
  $this->dbh = mysql_connect($this->host, $this->username, $this->password , $this->database)or die("cannot connect"); //Store data connection specifier in object
 // mysql_select_db($this->database)or die("cannot select DB");

}

public function query($sql)
{
     return mysql_query($sql,$this->dbh);  //Specify connection handler when doing query
}

public function fetch($sql)
{
     return mysql_fetch_array($this->query($sql));
}

}
//$connect = new mySQL();
//$connect->connect('localhost', 'root', 'root', 'mydb');
//$settings_query = mysql_query("SELECT * FROM users where username", $connect->dbh); //Specify connection handler when doing query
//$settings = mysql_fetch_array($settings_query);

            
include_once 'loginclass.php';
$login = new login($dbh);

?>