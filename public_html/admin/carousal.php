<?php

require_once 'class/carousalclass.php';
require_once 'class/loginclass.php';

$li = new login ();
if (!$li->isLoggedIn()) {
  header('Location: accessdebn.php');
}


$caro = new carousal();

$messages = $_SESSION['messages'];
unset($_SESSION['messages']);

$picResult = $caro->getCaro();


//while ($row = $picResult->fetch_assoc() ){
//print_r($row);}


$imgpath = $GLOBALS['imgpath']; 
?>
<!doctype html>
<html lang="en">

    <head>
        <title><?php $GLOBALS['carousaltitle']; ?></title>
        <?php include("includes/head.html") ?>
    </head>

    <body>
        <div class="wrapper">
            <?php include("includes/sildebar.php") ?>
            <div class="main-panel">
                <?php include("includes/mainpanel.html") ?>
                <a class="navbar-brand" > <br> Carousal Page </a>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Carousal Photo</h4>                                       
                                    </div>
                                    <div class="card-content table-responsive">
                                          <?php  
                                    if ($messages != ''){
                                  ?>
                                    <div class="alert alert-success"><?php print $messages ?></div>
                                  <?php 
                                    }                                  
                                  ?>
                                        <form method="GET" id = "" action = "slidPage.php">
                                            <button class ="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal" id ="buttSlider" data-id="0" name ="sid" value ="0" >+ Add Carousal</button>
                                        </form>
                                        <table class="table" id ="carotable">
                                            <thead class="text-primary">
                                            <th></th>
                                            <th>Img</th>
                                            <th>Caption</th>
                                            <th></th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                If ($picResult->num_rows > 0) {
                                                  while ($row = $picResult->fetch_assoc()) {
                                                    ?>
                                                <form method="GET" id = "caroform" action = "slidPage.php">
                                                    <tr>                                                
                                                        <td><?php echo $row['f_id']; ?></td> 
                                                        <td><img src="<?php echo $imgpath . $row['path']; ?>" style="width:50px" ></td> 

                                                        <td><?php echo $row['caption']; ?></td> 
                                                        <td class="text-primary"><button class ="btn btn-primary" id ="buttSlider" data-id ="<?php echo $row['f_id']; ?>" name ="sid" value="<?php echo $row['f_id']; ?>" >Edit</button></td>
                                                    </tr>
                                                </form> 
                                                <?php
                                              }
                                            } else {
                                              ?>
                                              <td colspan="6"> No Result </td> 
                                              <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>




                </div>
                <?php include("includes/footer.html") ?>
            </div>
        </div>
    </body>
    <?php include("includes/footerscripts.html") ?>
</html>