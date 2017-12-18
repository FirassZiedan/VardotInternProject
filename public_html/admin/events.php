<?php
require_once 'class/loginclass.php' ;
include_once 'class/eventclass.php';

$li = new login () ;
if(!$li->isLoggedIn()){
    header('Location: accessdebn.php');
}


$messages = $_SESSION['messages'];
unset($_SESSION['messages']);

$event = new event();

$newsRes =  $event->getAllevents();





?>
<!doctype html>
<html lang="en">

<head>
<title><?php $GLOBALS['eventtitle'];  ?></title>
<?php  include("includes/head.html") ?>
</head>

<body>
    <div class="wrapper">
    <?php  include("includes/sildebar.php") ?>
        <div class="main-panel">
        <?php  include("includes/mainpanel.html") ?>
        <a class="navbar-brand" > <br> Events Page </a>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Events</h4>
                                </div>
                                <div class="card-content table-responsive">
                                   <?php  
                                    if ($messages != ''){
                                  ?>
                                    <div class="alert alert-success"><?php print $messages ?></div>
                                  <?php 
                                    }                                  
                                  ?>
                                    <form method="GET" id = "" action = "eventform.php">
                                          <button class ="btn btn-primary pull-right"  id ="newsbutt" data-id="0" name ="nid" value ="0" >+ Add Events</button>
                                          </form>                               
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Time Start </th>
                                            <th>Time End</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                          <?php
                                                If ($newsRes->num_rows > 0) {
                                                  while ($row = $newsRes->fetch_assoc()) {
                                                    ?>
                                        <form method="GET" id = "newsform" action = "eventform.php">
                                                    <tr>                                                
                                                        <td><?php echo $row['n_id']; ?></td>                                                        
                                                        <td><?php echo (date('Y-m-d',$row['date'])); ?></td>
                                                        <td><?php echo $row['time_start']; ?></td>
                                                        <td><?php echo $row['time_end']; ?></td>
                                                        <td><?php echo $row['title']; ?></td>
                                                        <td><?php echo $row['display_name']; ?></td>
                                                        <td class="text-primary"><button class ="btn btn-primary" id ="eventbutt" data-id ="<?php echo $row['n_id']; ?>" name ="nid" value="<?php echo $row['n_id']; ?>" >Edit</button></td>
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
            <?php  include("includes/footer.html") ?>
        </div>
    </div>
</body>
<?php  include("includes/footerscripts.html") ?>
</html>