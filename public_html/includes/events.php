<?php 
include_once 'admin/class/eventclass.php';

$event = new event();
$newsRes =  $event->getEventFrontEnd();

$img = "img/";
 ?>



<div class ="col-lg-12 col-xs-12" id ="evtit">
  <center class ="fontcolor" id="eventword"><u> EVENTS </u></center>
</div>


<?php
If ($newsRes->num_rows > 0) {
  while ($row = $newsRes->fetch_assoc()) {
    ?>
<div class ="col-sm-12 col-md-4 ">
<div class = "main-content maincont">              
    <div >
      <img src="<?php print $img.$row['path']  ?>" id="evimg" class="img-responsive">
     
      <div class ="" >
        <img src= " img/cal.png" class ="eventcal">
        <p class =" eventdate">  <?php print (date('d',$row['date'])); ?>  </p>
        <p class =" eventdate1 block-center"><?php print (date('F',$row['date'])); ?></p>
      </div>
    </div>
    <div class ="description">
        <div>
            <p class = "desctd"><?php print date('h:i A', strtotime($row['time_start'])); ?> -<?php print date('h:i A', strtotime($row['time_end']));?> | <?php print $row['name']; ?>  </p>
        </div>
        <div>
            <h3 class ="desctitle">
               <?php print $row['title']; ?>
            </h3>
        </div>
        <div class="article">
            <p><?php print strip_tags(mb_substr( $row['description'], 0,120, 'utf-8'))."...";   ?></p>
        </div>
    </div>
    <a href="#" style="text-decoration:none">
    <div class="learnmore">
        <p class ="fontcolor">LEARN MORE</p>
    </div>
    </a>
</div>
</div>
<?php 
  }
}
?>
