<?php 
include_once 'admin/class/newsclass.php';

$news = new news();
$newsResult = $news->getAllNewsFrontEnd();

?>


<div id = "news">

<div id = "newsword">
     <p class ="newswordfont">NEWS</p>
</div>
  
  <?php
    $counter =  1;
   If ($newsResult->num_rows > 0) {
     while ($row = $newsResult->fetch_assoc()) {
       if ($counter == 3){
        ?>
         <div class ="newsbox">
        <?php
       }else{
        ?>
         <div class ="newsbox" id="underline">
        <?php
       }
        ?> 

  <p class ="fontcolor"><?php print  date('F d Y',$row['date']); ?> </p>
  <a href="newspage.php?nid=<?php print $row['n_id'] ;?>" style="text-decoration:none"><p class ="fontcolor title"><?php print $row['title']   ?></p></a>
  <p class = "newsdesc"><?php print strip_tags(mb_substr( $row['description'],0,120, 'utf-8'))."..."; ?></p>
  <a href="newspage.php?nid=<?php print $row['n_id']; ?>" style="text-decoration:none">
  <p class="readmore">READ MORE</p>
  </a>
</div>
  
  <?php
      $counter++ ;
     }
    }
  
  ?>
  </div>

