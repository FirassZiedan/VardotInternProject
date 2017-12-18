<?php
require_once 'class/loginclass.php' ;
include_once 'class/newsclass.php';

$li = new login () ;
if(!$li->isLoggedIn()){
    header('Location: accessdebn.php');
}

$news = new news();

$messages = $_SESSION['messages'];
unset($_SESSION['messages']);

$newsResult = $news->getAllNews();

?>
<!doctype html>
<html lang="en">

<head>
<title><?php $GLOBALS['newstitle']; ?></title>
<?php  include("includes/head.html") ?>
</head>

<body>
    <div class="wrapper">
    <?php  include("includes/sildebar.php") ?>
    <div class="main-panel">
    <?php  include("includes/mainpanel.html") ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">News</h4>
                                </div>
                                <div class="card-content table-responsive">
                                     <div class="card-content table-responsive " >
                                        <?php  
                                    if ($messages != ''){
                                  ?>
                                    <div class="alert alert-success"><?php print $messages ?></div>
                                  <?php 
                                    }                                  
                                  ?>
                                        <form method="GET" id = "" action = "newsform.php">
                                        <button class ="btn btn-primary pull-right"  id ="newsbutt" data-id="0" name ="nid" value ="0" >+ Add News</button>
                                        </form>
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Title </th>
                                            <th>Author</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                             <?php
                                                If ($newsResult->num_rows > 0) {
                                                  while ($row = $newsResult->fetch_assoc()) {
                                                    ?>
                                                <form method="GET" id = "newsform" action = "newsform.php">
                                                    <tr>                                                
                                                        <td><?php echo $row['n_id']; ?></td>                                                        
                                                        <td><?php echo (date('Y-m-d',$row['date'])); ?></td>
                                                        <td><?php echo $row['title']; ?></td>
                                                        <td><?php echo $row['display_name']; ?></td>
                                                        <td class="text-primary"><button class ="btn btn-primary" id ="newsbutt" data-id ="<?php echo $row['n_id']; ?>" name ="nid" value="<?php echo $row['n_id']; ?>" >Edit</button></td>
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