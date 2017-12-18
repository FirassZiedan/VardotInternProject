<?php

require_once 'class/loginclass.php' ;
if ($_GET['logout']){
$li = new login();
$li->logout() ;

}


?>