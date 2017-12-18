<?php

include_once 'admin/class/carousalclass.php';
$img ='img/';
$caro = new carousal();
$picResult = $caro->getCaro();

?>

                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                      <?php 
                      $count= 0;
                       If ($picResult->num_rows > 0) {
                         $rowcount = $picResult->num_rows ;
                          for ($x = 0 ; $x < $rowcount ;$x++) {
                            if ($count == 0 ){
                             ?>  <li data-target="#myCarousel" data-slide-to="<?php print $count; ?>" class="active"></li> <?php
                           }else {
                               ?> <li data-target="#myCarousel" data-slide-to="<?php print $count; ?>"></li> <?php
                           }
                           $count++ ;
                          }
                       }
                      ?>                      
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php
                        $counter  = 0 ;
                        If ($picResult->num_rows > 0) {
                          while ($row = $picResult->fetch_assoc()) {
                           if ($counter == 0 ){
                             ?>  <div class="item active" ><?php
                           }else {
                               ?> <div class="item" > <?php
                           }
                           $counter++ ;
                            ?>                                            
                          <img src="<?php echo $img.$row['path'] ;?> " alt=""  id ="mainpic">
                          <div src=" " id= "pictext">
                            <p class ="textpicfont"><?php print $row['caption'] ?> </p> 
                          </div>
                               
                          </div>
                          
                      <?php
                          }
                        }
                      ?>                           
                        
                    </div>
                </div>
              
                    