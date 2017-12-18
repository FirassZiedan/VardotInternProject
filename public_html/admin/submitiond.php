<?php 

require_once 'class/submitionclass.php';
require_once 'class/loginclass.php' ;
session_start();
$li = new login () ;
if(!$li->isLoggedIn()){
    header('Location: accessdebn.php');
}

$sub = new submtion ();
$id = $_GET['sid'];
$res = $sub->getOne($id) ;



if ($_POST['action'] == 'read') {
    $res = $sub->status(1,$id) ;
     header('Location: submitions.php');
    }else if ($_POST['action'] == 'delete'){
        $res = $sub->status(2,$id);
        header('Location: submitions.php');
    }else if ($_POST['action'] == 'back'){
        header('Location: submitions.php');
    }
    


?>
<!doctype html>
<html lang="en">

<head>
<title><?php $GLOBALS['subtitle'];  ?></title>
<?php  include("includes/head.html") ?>
</head>

<body>
    <div class="wrapper">
    <?php  include("includes/sildebar.php") ?>
    <div class="main-panel">
    <?php  include("includes/mainpanel.html") ?>
    <a class="navbar-brand" > <br> Submition Details Page </a>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Submition </h4>
                                </div>
                                <div class="card-content table-responsive">

                                <div class="modal-body">
                                    <div class="file-loading">
                                    <form method="POST" id = "caroform"  action ="<?php print $_SERVER[SELF] ?>"> 
                                    
                                    <?php
                                            If ($res->num_rows > 0) {
                                                while ($row = $res->fetch_assoc() ) {
                                                        
                                                  
                                                        if ($row['status'] != 1 ){
                                                          
                                                        ?>
                                                       <button value="read" type="submit" class="btn btn-success pull-right"  name="action">Mark As Read</button>
                                                       <?php
                                                        }
                                                       ?>
                                                       <div class="input-group">
                                                            <span class="input-group-addon">Name</span>
                                                            <input id="msg" type="text" class="form-control" name="name" value ="<?php echo $row['name']; ?>"  disabled>
                                                        </div>
                                                            <div class="input-group">
                                                            <span class="input-group-addon">Phone Number</span>
                                                        <input id="msg" type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>"  disabled>
                                                        </div>
                                                            <div class="input-group">
                                                            <span class="input-group-addon">Email</span>
                                                        <input id="msg" type="text" class="form-control" name="Email" value ="<?php echo $row['email']; ?>"   disabled>
                                                        </div>
                                                        <div class="input-group"> 
                                                            <span class="input-group-addon">Date</span>
                                                            <input id="msg" type="text" class="form-control" name="date" value="<?php echo $row['date']; ?>"  disabled>                                                
                                                        </div>      


                                                        <div class="form-group">
                                                            <label for="comment">Massege</label>
                                                            <textarea class="form-control" rows="5" id="comment" disabled ><?php echo $row['message']; ?></textarea>
                                                        </div>                                                                                            

                                                    <?php
                                                        
                                                }
                                            }
                                        ?>
                                    
                                    
                                   


                   
                    <div class="modal-footer">
                        <button value="delete" type="submit" class="btn btn-danger pull-right"  name="action" onclick="return confirm('Are you sure you want to delete the item?');">Delete</button>        
                        <a href ="submitions.php " value="back" type="submit" class="btn btn-secondary pull-left"  name="action">Back</a>        
                      
                        
                    </div>
                  </form>
                    
                    

                </div>
                                   
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