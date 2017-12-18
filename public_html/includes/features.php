<?php 

include_once 'admin/class/feacturesclass.php';

$feat =  new feacture();
$featresult =$feat ->getFeactFrontEnd() ;

$img = "img/";



  If ($featresult->num_rows > 0) {
  while ($row = $featresult->fetch_assoc() ) {
?>

<div class ="cube">
  <a target="_blank" href="<?php print $row['url'];  ?> ">
    <img src="<?php print $img.$row['path'] ; ?> " class="imgcube">
     <div class ="textcube">
        <p class ="textcudefont"><?php print $row['caption'] ; ?></p>
        </div>
    </a>
</div>
  
    <?php 
     }
  }
  ?>



<!---
<div class ="cube">
    <img src=" img/item2.png" class="imgcube">
     <div class ="textcube">
            <p class ="textcudefont">GRADUATE COURSES</p>
        </div>
</div>
<div class ="cube">
    <img src=" img/item1.png" class="imgcube">
        <div class ="textcube">
            <p class ="textcudefont">UNDERGRADUATE COURSES</p>
        </div>
</div>

<div class ="cube">
    <img src=" img/item4.png" class="imgcube">
     <div class ="textcube">
            <p class ="textcudefont">SCHOLARSHIPS</p>
        </div>
</div>

<div class ="cube">
    <img src=" img/item3.png" class="imgcube">
     <div class ="textcube">
            <p class ="textcudefont">INTERNATIONAL STUDENTS</p>
        </div>
</div>
-->