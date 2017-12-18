<?php
//include_once 'front-end.php' ;
include 'admin/class/submitionclass.php';

if ($_POST['action'] == 'submit'){
  $name = $_POST['name'] ;
  $email = $_POST['email'] ;
  $phone = $_POST['phone'] ;
  $msg = $_POST['message'];
  
  
  $sub = new submtion() ;
  $sub->insertsubmition($name, $phone, $email, $msg);
 
  //print_r($_POST);  die('hi');
  
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
       <?php include_once 'includes/head.html'; ?>
    </head>

    <body>
        <div class = "container-fluid">
                        <div class ="row">

              <?php
              if ($_POST['action'] == 'submit'){
              ?>
                <div class="alert alert-success">
                <strong>Success!</strong> Thank You For Submit .
                </div>
              <?php
                   unset($_POST);
                     $_POST['action'] = '';
                   
              }
              ?>

              </div>
         
            <!------- Header ---->
            <?php include_once 'includes/header.html' ?>
            <!---------------------->

            <!-----main pic ------------->
            <div class = "row"  >
                 <?php include_once 'includes/slider.php' ?>

            </div>
            <!----------topics ------>
            <div class = "row">
                <div class="container-fluid" >
                <!--services--->
                        <div class = "col-lg-6 col-sm-6 col-xs-12" id ="sr">
                                 <?php include_once 'includes/features.php' ?>
                        </div>
                        <!--news--->
                        <div class = "col-lg-6 col-xs-12" id = "ne">
                            <?php include_once 'includes/news.php' ?>
                        </div>
                </div>
         </div>
            <!------numbers bord-------->
            <div class ="row" id ="numbord">

              <div class ="container">
                  <div class ="row">
                     <div class ="col-lg-4 col-md-4 col-sx-12 ">
                        <img src=" img/1bord.png" class="bordimg">
                    </div>
                     <div class =" col-lg-4 col-md-4 col-sx-12">
                           <img src=" img/2bord.png" class="bordimg">
                    </div>
                     <div class ="col-lg-4 col-md-4 col-sx-12">
                        <img src = " img/3bord.png" class="bordimg" >
                    </div>
                  </div>
               </div>
            </div>
            <!--------------Events ----------------->
            <div class = "row" id ="evcards">
                   <?php include_once 'includes/events.php' ?>    
            </div>
            <!---------------apply---------------->
            <div class = "row" id = "marg">

                <div class="col-lg-12" id ="applydiv">

                    <div id = "applyworddiv ">

                            <p class ="fontcolor center-block" id= "applyword">ADMISSIONS ARE NOW OPEN FOR 2017/2018 INTAKE</p>
                          <a href="#" style="text-decoration:none">
                        <div id = "applynow" class="center-block">
                             <p >APPLAY NOW!</p>
                            </div>
                        </a>

                    </div>
                </div>

            </div>
            <!--------git in touch Form----------------->
            <div class ="row">
                <div class ="container " >
                    <div class="row">

                        <div class="col-xs-12 center-block" id="git">
                                <center>
                                <p id = "gitfont"><u>GET IN TOUCH </u></p>
                                </center>
                            <form id="conta" action="" method="POST" onsubmit="">
                                <div class="col-sm-6 col-xs-12">
                                  <input type="text" class="form-control inbox" id="name inBox" placeholder="Full Name" name="name" required>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                  <input type="number" class="form-control inbox" id="phone" placeholder="Phone Number" name="phone" required>
                                </div>
                                <div class="col-xs-12">
                                <input type="email" class="form-control inbox" id="email" placeholder="Email" name="email" required>
                                </div>
                                <div class="col-xs-12">
                                  <textarea id="message" class="form-control" placeholder="Message" name ="message" required></textarea>
                                 <center>
                                   <button name="action" value ="submit" type="submit" id="contact-submit" data-submit="...Sending" class="subbotton" onclick="return alert("Thanks" );"><p class= "contacttitle">SUBMIT</p></button>
                                 </center>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
            </div>
            <!---------------contact -------->
            <?php include_once 'includes/footer.html'; ?>
        </div> <!--- end container --->
      <?php include_once 'includes/footerscript.html';  ?>
    </body>
</html>
