<?php

include 'conf.php';
//echo "conn page is included ........................................................";




class database{
    private $username ;
    private $password ;
    private $host ;
    private $dbc;

   
   
/*
    function __construct() {
        $username = $GLOBALS['dbusername'] ; 
        $password = $GLOBALS['dbpassword']  ;
        $host = $GLOBALS['dbhost'];
        $dbc = $GLOBALS['db'] ;
       

    }
*/

    function connect(){
                $username = $GLOBALS['dbusername'] ; 
                $password = $GLOBALS['dbpassword']  ;
                $host = $GLOBALS['dbhost'];
                $dbc = $GLOBALS['db'] ;
                

                $conn = new mysqli( $host , $username , $password, $dbc );
        
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }
                
                $GLOBALS['conn'] = $conn ;
                
    }


    function logout(){



        session_destroy();


    }





   



}



$dbtest = new database();
$dbtest->connect() ;


?>