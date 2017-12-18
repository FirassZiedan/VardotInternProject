<?php
include_once '../../setting/conf.php';
require_once 'class/loginclass.php';

$li = new login ();
if (!$li->isLoggedIn()) {
  header('Location: accessdebn.php');
}

require_once 'class/carousalclass.php';
include_once '../setting/conf.php';
$caro = new carousal();

$id = $_GET['sid'];

$imgpath = $GLOBALS['imgpath'];

//echo $id;
$has_error = false;

$messages = $_SESSION['messages'];
unset($_SESSION['messages']);

if ($id != 0) {
  $slidinfo = $caro->getOne($id);
}
  
$file = '';
$caption = '';

if (isset($_POST['action'])) {
  $action = $_POST['action'];
  $file = $_FILES;
  $caption = $_POST['caption'];
}
else {
  $action = '';
}

if ((($file == '' && $id == 0) || $caption == '') && ($action == 'save')) {
  $has_error = true;
}

if ($has_error == false) {
  if ($action == 'save') {
    require_once '../setting/upload.php';

    if ($_GET['sid'] > 0) {
      
      if ($_FILES['file']['size'] == 0){
        $file = '';
      }else{
        $file = $target_file ;
      }

      if ($caption != '') {
        $caro->updatCaro($_GET['sid'],$file , $caption);
        $_SESSION['messages'] = 'The item has been updated successfully.';
        header('Location: carousal.php');
      } else {
        $_SESSION['messages'] = 'You Must Fill Caption Filed.';
      }
    } else {

      if ($caption != '') {
        
        $caro->insertCaro($target_file, $caption);
        $_SESSION['messages'] = 'The item has been Added successfully.';
        header('Location: carousal.php');
      } else {
        $_SESSION['messages'] = 'You Must Fill All Filed.';
      }
    }
  } else if ($action == 'delete') {
    $caro->delete($_GET['sid']);
    header('Location: carousal.php');
  } else if ($action  == 'back') {
    //print_r($_POST); die () ;
    header('Location: carousal.php');
  }
}
?>
<!doctype html>
<html lang="en">

    <head>
        <title><?php echo $GLOBALS['carousaltitle'] ; ?></title>
        <?php include("includes/head.html") ?>
    </head>

    <body>
        <div class="wrapper">
            <?php include("includes/sildebar.php") ?>
            <div class="main-panel">
                <?php include("includes/mainpanel.html") ?>
                <a class="navbar-brand" > <br> Carousal Photo Page </a>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Carousal Photo</h4>
                                       
                                    </div>
                                    <div class="card-content table-responsive">

                                      <div class=""><?php print $messages; ?></div>

                                        <div class="modal-body">
                                            <div class="file-loading">
                                                <form method="POST" id = "caroform"  action ="<?php //print $_SERVER[SELF]   ?>" enctype="multipart/form-data">
                                                    <button value="save" type="submit" class="btn btn-success pull-right"  name="action" >Save</button>           

                                                    <input  id ="caroid"  class ="hidden" value=""> 

                                                    <?php
                                                    If ($slidinfo->num_rows > 0) {
                                                      while ($row = $slidinfo->fetch_assoc()) {
                                                        ?>

                                                        <img src="<?php echo $imgpath . $row['path']; ?>" id="changeimg" style="width:40% ;height:300; padding-bottom :20px;">   
                                                        <input name="file" id="file"  multiple type="file" onchange="readURL(this);">
                                                        
                                                        <div class="input-group">
                                                            <span class="input-group-addon" >Caption</span>
                                                            <input name="caption" id ="cap" type="text" class="form-control"  placeholder="" value ="<?php echo $row['caption']; ?>" maxlength="45" required>                                                     
                                                            <span id="remaining" style="float:right ; color:red ;"></span>
                                                            <span id="limit" style="float:right ;"></span>
                                                        </div>                                                                                                   

                                                        <?php
                                                      }
                                                    } else {
                                                      ?>


                                                      <img  id="changeimg" style="width: 0 ; margin-bottom:10px; " >   
                                                      <input id="input-b9" name="file" type="file" onchange="readURL(this);">                                 
                                                      <div class="input-group">
                                                          <span class="input-group-addon" >Caption</span> 
                                                          <input id="cap" name ="caption" type="text" class="form-control"  placeholder="" value ="<?php print $caption ?>" maxlength="45" required>
                                                          <span id="remaining" style="float:right ; color:red ;"></span><span id="limit" style="float:right ;">45</span>

                                                      </div>   
                                                    <?php
                                                    }
                                                    ?>    
                                                        </form>
                                                    <div class="modal-footer">
                                                      <form method="POST">
                                                        <button value="delete" type="submit" class="btn btn-danger pull-right"  name="action" onclick="return confirm('Are you sure you want to delete the item?');">Delete</button>        
                                                      </form>
                                                        <a href ="carousal.php" value="back" type="submit" class="btn btn-secondary pull-left"  name="action" >Back</a>        
                                              
                                            </div>
                                        </div>                                  
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