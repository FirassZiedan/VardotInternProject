<?php
require_once 'class/loginclass.php' ;

$li = new login () ;
if(!$li->isLoggedIn()){
    header('Location: accessdebn.php');
}

require_once 'class/feacturesclass.php';
$feat =  new feacture();
$id = $_GET['fid'] ;
$featresult = $feat->getOne($id) ;

$messages = $_SESSION['messages'];
unset($_SESSION['messages']);

$url = $_POST['url'];
$file = $_POST['file'];
$caption = $_POST['caption']; 

If ($featresult->num_rows > 0) { 
$row = $featresult->fetch_assoc() ;
$rfe_id  = $row['fe_id'];
$rf_id = $row['f_id'];
$rpath = $imgpath.$row['path'];
$rname = $row['name'];
$rurl = $row['url'];
$rcaption = $row['caption'] ;
}else{
$rfe_id  = '';
$rf_id = '';
$rname ='';
$rurl = '';
$rcaption ='' ;
}


if ($_POST['action'] == 'save') {
  require_once '../setting/upload.php';
   //print_r($_POST);die('hi');
   $vurl = TRUE;
    if( $vurl == FALSE ){
     $messages = "URL Is Not a Valid" ; 
    }else{   
    $id = $_POST['featid'];
    $f_id = $_POST['fileid'];

    if ($_GET['fid'] > 0 ){         
      
      
            $feat->updateFeact($id ,$f_id  , $url , $file, $caption);
            $_SESSION['messages'] = 'The item has been updated successfully.';
            header('Location: Features.php');         
    }else{
        if ($_FILES['file']['size'] != 0  && $_POST['caption'] !=''){
            $feat->insertFeact($url , $target_file , $caption);
             $_SESSION['messages'] = 'The item has been Added successfully.';
            header('Location: Features.php');         
        }else{
            $_SESSION['messages'] = 'You Must Fill pic Fileds .';    
        }    
    }//end else 
    }
   //header('Location: Features.php');

}else if ($_POST['action'] == 'delete'){
    $fileid= $rf_id ;
    $feid= $rfe_id ;
    $feat->delete($feid , $fileid);
     $_SESSION['messages'] = 'The item has been Deleted successfully.';
    header('Location: Features.php');
}else if ($_POST['action'] == 'back'){
    //print_r($_POST); die () ;
    header('Location: Features.php');
}
$imgpath  =$GLOBALS['imgpath'] ;
?>


<!doctype html>
<html lang="en">

<head>
<title><?php $GLOBALS['featurestitle'];  ?></title>
<?php  include("includes/head.html") ?>
</head>

<body>
    <div class="wrapper">
    <?php  include("includes/sildebar.php") ?>
        <div class="main-panel">
        <?php  include("includes/mainpanel.html") ?>
        <a class="navbar-brand" > <br> Feature Page </a>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Feature Photo</h4>
                                </div>
                                <div class="card-content table-responsive">
                                     <div class="msgadmin"><?php print $messages ?></div>
                                <div class="modal-body">
                                <div class="file-loading">
                                
                                <form method="post" id = "caroform"  action ="<?php //print $_SERVER[SELF] ?>" enctype="multipart/form-data">                                
                                  <button value="save" type="submit" class="btn btn-success pull-right"  name="action">Save</button>           
                                  <input name = "featid"  class ="hidden"  value=" <?php print $rfe_id; ?>"> 
                                  <input  name  ="fileid" class ="hidden"  value=" <?php print $rf_id; ?>"> 
                                  <img src="<?php print $rpath; ?>" id="changeimg" style="<?php if ($rpath == '' ) {?> width:0 <?php }else{ ?> width:15% <?php } ?>   ; padding-bottom :20px;">   
                                  <input id="input-b9" name="file" multiple type="file" onchange="readURL(this);" value ="<?php print $name; ?>">                                 
                                  <div class="input-group">
                                  <span class="input-group-addon" >URL</span>
                                  <input id="url" name = "url" type ="url" class="form-control"  placeholder="" value ="<?php print $rurl; ?>" required >                                                     
                                  </div>
                                  <div class="input-group">
                                  <span class="input-group-addon" >Caption</span>
                                  <input id="capf" name ="caption" type="text" class="form-control"  placeholder="" value ="<?php print $rcaption; ?>" maxlength="30" required>                                                     
                                   <span id="remaining" style="float:right ; color:red ;"></span>
                                   <span id="limit" style="float:right ;">30</span>
                                  </div>                                                                                                   
                                </form>
                                            <div class="modal-footer">
                                            <a href ="Features.php" value="back" type="submit" class="btn btn-secondary pull-left"  name="action">Back</a>           
                                            <form method="POST">
                                            <button value="delete" type="submit" class="btn btn-danger pull-leftt"  name="action" onclick="return confirm('Are you sure you want to delete the item?');">Delete</button>                                                             
                                            </form>
                                            </div>
                                          
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