<?php
include_once 'admin/class/newsclass.php';

$news = new news();
$id = $_GET['nid'];
$newsResult = $news->getOneNews($id);


$allnewsResult = $news->getAllNews();

If ($newsResult->num_rows > 0) {
  $row = $newsResult->fetch_assoc();
  $title = $row['title'];
  $date = $row['date'];
  $date = date('Y-m-d',$row['date']);
  $desc = $row['description'];
}




?>


<!DOCTYPE html>

<html lang="en">
    <head>
       <?php include_once 'includes/head.html'; ?>
    </head>

    <body>
        <div class = "container-fluid">
            <?php include_once 'includes/header.html' ?>
        </div>
        <div class = "container-fluid">
          <div class ="row">
              
                <div id = "newspage">
                  <div id = "newsword">
                       <p class ="newswordfont">NEWS</p>
                  </div>
                  
                  <center><h1 class = "fontcolor "><?php print $title ; ?></h1></center>
                   <p class ="fontcolor "><?php print  date('F , d Y',$row['date']); ?></p>
                  <br>
                  <p class ="newsdesc"><?php print $desc ; ?></p>                                          
                </div>
                                                
          </div>


        </div>
          <?php include_once 'includes/footer.html'; ?>
          <?php include_once 'includes/footerscript.html';  ?>
    </body>
</html>