<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require_once 'class/loginclass.php' ;

$li = new login () ;
$li->logout();
//session_start();
if ($_POST["username"] != null && $_POST["password"] != null ){
   
    

    $li->checkLogIn($_POST["username"] , $_POST["password"] ) ;
    $_SESSION['username'] = $_POST["username"];
    $_SESSION['password']=  $_POST["password"];

}


?>
<!doctype html>
<html lang="en">

<head>
<title>Material Dashboard by Creative Tim</title>
<?php  include("includes/head.html") ?>
</head>

<body>
<body id="login">
    <div class="container">
      <div class ="row">
        <div class ="col-md-3"></div>
        
        <div class ="col-md-6">
        
    <div class="wrapper">
        <div class="card center-block" data-color="purple" style ="width : 500px ; padding:30px;">

      <form class="form-signin center-block"  method ="POST" >
        <h2 class="form-signin-heading ">Log In</h2>
            <input type="text" class="input-block-level center-block" placeholder="User Name" name ="username" style ="width : 100%" required>
            <br><input type="password" class="input-block-level center-block" placeholder="Password" name ="password" style ="width : 100%" required>
            <button class="btn btn-large btn-primary pull-right" type="submit">Sign in</button>
      </form>
         </div>
     </div>
        </div>
            <div class ="col-md-3">
          </div>
      
      </div>
    </div> 
  </body>
</body>
</html>