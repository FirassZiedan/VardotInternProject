<?php
require_once 'class/loginclass.php';
include_once 'class/newsclass.php';
session_start();
$li = new login ();
if (!$li->isLoggedIn()) {
  header('Location: accessdebn.php');
}

$news = new news();

$messages = $_SESSION['messages'];
unset($_SESSION['messages']);

$id = $_GET['nid'];
$newsResult = $news->getOneNews($id);

$date = date('Y-m-d');

If ($newsResult->num_rows > 0) {
  $row = $newsResult->fetch_assoc();
  $title = $row['title'];
  $date = $row['date'];
  $date = date('Y-m-d',$row['date']);
  $desc = $row['description'];
}

$has_error = FALSE;

if ($_POST['action'] == 'save') {
  $title = $_POST['title'];
  $date = $_POST['date'];
  if ($date != '') {
    $date = strtotime($date) ;
  }
    
  $desc = $_POST['editor1'];
  $userID = $_SESSION['user_session'];  
}



if (($title == '' || $date == '' || $desc == '' ) && $_POST['action'] == 'save') {
  $has_error = TRUE;
}

if ($has_error == FALSE) {
  if ($_POST['action'] == 'save') {

    if ($_GET['nid'] > 0) {
      $news->updateNews($id , $title, $date,$desc , $userID);
      $_SESSION['messages'] = 'The item has been updated successfully.';
      header('Location: news.php');
    } else {
      $news->insertNews($title , $date , $desc , $userID);
      $_SESSION['messages'] = 'The item has been Added successfully.';
      header('Location: news.php');
    }//end else 
  } else if ($_POST['action'] == 'delete') {
    $news->deleteNews($id);
    $_SESSION['messages'] = 'The item has been Deleted successfully.';
    header('Location: news.php');
  } else if ($_POST['action'] == 'back') {
    //print_r (strtotime($date));
    //print_r(date('Y-m-d H:i:s', strtotime($date) ));     
    header('Location: news.php');
  }
}//end has_error if
else {
  $_SESSION['messages'] = 'You Must Fill all Fileds .';
}
?>
<!doctype html>
<html lang="en">

    <head>
        <title><?php  $GLOBALS['newstitle']; ?></title>
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
                                        <h4 class="title">News</h4>
                                    </div>

                                    <div class="card-content table-responsive">
                                        <div class="messages"><?php print $messages ?></div>
                                        <div class="modal-body">
                                            <div class="file-loading">

                                                <form method="POST" id = "caroform"  action ="<?php //print $_SERVER[SELF]  ?>">
                                                  <button value="save" type="submit" class="btn btn-success pull-right"  name="action">Save</button>           
                                                  <div class="input-group">
                                                    <span class="input-group-addon">Titel</span>
                                                    <input id="title" type="text" class="form-control" name="title" placeholder="" value ="<?php echo $title ?>" required>
                                                  </div>

                                                  <div class="input-group" style="width : 250px;">
                                                      <span class="input-group-addon">Date</span>
                                                      <input id="date" type="date" class="form-control" name="date" placeholder="" value = "<?php print $date ?>" required>
                                                  </div>
                                                  <title>Description</title>
                                                  <textarea name="editor1"><?php echo $desc ?></textarea>
                                                  </form>  
                                                    <div class="modal-footer">
                                                      <a href ="news.php" value="back" type="submit" class="btn btn-secondary pull-left"  name="action">Back</a>           
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