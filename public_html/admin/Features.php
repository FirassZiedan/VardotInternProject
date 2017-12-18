<?php
require_once 'class/feacturesclass.php';
require_once 'class/loginclass.php' ;
include_once '../setting/conf.php';

$li = new login () ;
if(!$li->isLoggedIn()){
    header('Location: accessdebn.php');
}

$feat =  new feacture();
$featresult =$feat ->getFeact() ;


$messages = $_SESSION['messages'];

//unset($_SESSION['messages']);


$imgpath  ="../img/" ;

?>


<!doctype html>
<html lang="en">

<head>
<title><?php $GLOBALS['featurestitle']; ?></title>
<?php  include("includes/head.html") ?> 
</head>

<body>
    <div class="wrapper">
    <?php  include("includes/sildebar.php") ?>
    <div class="main-panel">
    <?php  include("includes/mainpanel.html") ?>
    <a class="navbar-brand" > <br> Features Page </a>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Feature Photo</h4>
                                </div>
                                <div class="card-content table-responsive">
                                  <?php  
                                    if ($messages != ''){
                                  ?>
                                    <div class="alert alert-success"><?php print $messages ?></div>
                                  <?php 
                                    }                                  
                                  ?>
                                <form method="GET" id = "" action = "featPage.php">
                                        <button class ="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal" name ="fid" value ="0" >+ Add Feature</button>
                                   </form>
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th></th>
                                            <th>Feature Pic</th>
                                            <th>Caption</th>
                                            <th>URL</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                If ($featresult->num_rows > 0) {
                                                    while ($row = $featresult->fetch_assoc() ) {
                                                        ?>
                                                    <form method="GET" id = "" action = "featPage.php">
                                                        <tr>                                                
                                                            <td><?php echo $row['fe_id']; ?></td> 
                                                            <td><img src="<?php echo $imgpath.$row['path']; ?>" style="width:50px" ></td> 
                                                            <td><?php echo $row['caption']; ?></td> 
                                                            <td><?php echo $row['url']; ?></td> 
                                                            <td class="text-primary"><button class ="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id ="buttSlider" data-id ="<?php echo $row['fe_id']; ?>" name ="fid" value="<?php echo $row['fe_id']; ?>" >Edit</button></td>
                                                        </tr>
                                                        </form> 
                                                        <?php
                                                                }
                                                            }else{
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
            <?php  include("includes/footer.html") ?>
        </div>
    </div>
</body>
<?php  include("includes/footerscripts.html") ?>

</html>