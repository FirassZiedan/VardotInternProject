<?php 
require_once 'class/loginclass.php' ;
session_start();
$li = new login () ;
if(!$li->isLoggedIn()){
    header('Location: accessdebn.php');
}

?>

<!doctype html>
<html lang="en">

<head>
<title>Dashboard</title>
<?php  include("includes/head.html");
        include("includes/logout.php") ; ?>
</head>

<body>
    <div class="wrapper">
    <?php  include("includes/sildebar.php") ?>
    <div class="main-panel">
    <?php  include("includes/mainpanel.html") ?>
    <a class="navbar-brand" > <br> Dashboard Page </a>
            <div class="content">
               
            </div>
    <center><img src="../img/logo.png"style="width: 50%"></center>  
        </div>
    </div>
</body>
<?php  include("includes/footerscripts.html") ?>
</html>