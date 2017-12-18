<?php
require_once 'class/loginclass.php';
include_once 'class/eventclass.php';
$li = new login ();
if (!$li->isLoggedIn()) {
  header('Location: accessdebn.php');
}

$event = new event();

$messages = $_SESSION['messages'];
unset($_SESSION['messages']);

$id = $_GET['nid'];
$eventResult = $event->getOneevent($id);

$has_error = FALSE;

 If ($eventResult->num_rows > 0) {
$row = $eventResult->fetch_assoc();
$rpath = "../img/".$row['path'] ;
$rdate = date('Y-m-d',$row['date']);
$rs_time = $row['time_start'];
$re_time = $row['time_end'];
$rplace =  $row['name'];
$rtitle= $row['title']  ;
$rdesc  = $row['description'] ;
$nodeid = $row['n_id'];
$eventid = $row['e_id'];
$placeid = $row['p_id'];
$fileid = $row['f_id'];
}else{
$rpath ='' ;
$rdate = date('Y-m-d');
$rs_time = '';
$re_time = '';
$rplace = '';
$rtitle= '';
$rdesc  = '' ;
}
//if (($title == '' || $date == '' || $desc == '' ) && $_POST['action'] == 'save') {
  //$has_error = TRUE;
//}

//if ($has_error == FALSE) {
  if ($_POST['action'] == 'save') {
     require_once '../setting/upload.php';
    //------------------------------------
      $stitle = $_POST['title'];
      $sdate = $_POST['date'];
      $sdate = strtotime($sdate) ;
      $sdesc = $_POST['editor1'];
      $suserID = $_SESSION['user_session'];
      
      $splace = $_POST['place'];
      $ss_time = $_POST['starttime'];
      $se_time = $_POST['endtime'];
      

      if ($_FILES['file']['size'] == 0){
        $spath= '';
      }else{
        $spath = $target_file;
      }
    //------------------------------------
    
    
    //print_r ($_POST); die ('hi');
       // print ($target_file);        die('g');
    if ($_GET['nid'] > 0) {
      $event->updateevent($nodeid , $eventid , $placeid , $fileid ,$suserID , $stitle , $sdesc , $sdate , $spath , $splace ,$ss_time , $se_time );
      $_SESSION['messages'] = 'The item has been updated successfully.';
      header('Location: events.php');
    } else {
      $event->insertevent($stitle , $sdesc , $sdate , $suserID ,$spath , $splace ,$ss_time , $se_time);
      $_SESSION['messages'] = 'The item has been Added successfully.';
      header('Location: events.php');
    }//end else 
  } else if ($_POST['action'] == 'delete') {
    $event->deleteevent($id);
    $_SESSION['messages'] = 'The item has been Deleted successfully.';
    header('Location: events.php');
  } else if ($_POST['action'] == 'back') {
    //print_r (strtotime($date));
    //print_r(date('Y-m-d H:i:s', strtotime($date) ));     
    header('Location: events.php');
  }
//}//end has_error if
//else {
//  $_SESSION['messages'] = 'You Must Fill all Fileds .';
//}
  
  
  
$img = $GLOBALS['imgpath'];
?>
<!doctype html>
<html lang="en">

    <head>
        <title><?php $GLOBALS['eventtitle'];  ?></title>
        <?php include("includes/head.html") ?>
    </head>

    <body>
        <div class="wrapper">
            <?php include("includes/sildebar.php") ?>
            <div class="main-panel">
                <?php include("includes/mainpanel.html") ?>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Event</h4>
                                    </div>

          <div class="card-content table-responsive">
            <div class=""><?php print $messages ?></div>
            <div class="modal-body">
              <div class="file-loading">

                <form method="POST" id = "caroform"  action ="<?php //print $_SERVER[SELF]  ?>" enctype="multipart/form-data">

                    <button value="save" type="submit" class="btn btn-success pull-right"  name="action">Save</button>           

                    <img id="changeimg" src="<?php print $rpath ;?>" alt="" style=" width : auto" />

                <input id="input-b9" name="file" multiple type="file" onchange="readURL(this);" style="margin-top: 4px ; ">

                <div class="input-group" style="width : 250px;">
                  <span class="input-group-addon">Date</span>
                  <input id="date" type="date" class="form-control" name="date" value="<?php print $rdate ; ?>" placeholder="" required>
                </div>
                <div class="input-group" style="width :75px;">
                <span class="input-group-addon">Start Time</span>
                <input id="starttime" type="time" class="form-control" name="starttime" placeholder="" value = "<?php print $rs_time ;  ?>" required>
                </div>
                <div class="input-group" style="width:75px;">
                <span class="input-group-addon">End Time</span>
                <input id="endtime" type="time" class="form-control" name="endtime" placeholder="" value="<?php print $re_time;  ?>" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon">Place</span>
                  <input id="place" type="text" class="form-control" name="place" placeholder="" value="<?php print $rplace; ?>" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon">Titel</span>
                  <input id="title" type="text" class="form-control" name="title" placeholder="" value="<?php print $rtitle; ?>" required>
                </div>


                <title>Description</title>
                <textarea name="editor1" required> <?php print $rdesc; ?></textarea>
                </form>
                <div class="modal-footer">
                <a href ="events.php " value="back" type="submit" class="btn btn-secondary pull-left"  name="action">Back</a>           
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
      </div>
        </div>
    </div>
    <?php// include("includes/footer.html") ?>
</div>
</div>
</body>
<?php include("includes/footerscripts.html") ?>
</html>
