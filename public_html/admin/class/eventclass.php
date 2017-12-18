<?php

include_once '../setting/conn.php';
 $imgpath  =$GLOBALS['imgpath'] ;

 class event {
   
   function getAllevents(){
     $conn = $GLOBALS['conn'];
     
     $sql = "SELECT * FROM `node` INNER JOIN `event_filed` ON node.n_id = event_filed.n_id INNER JOIN `users` ON node.u_id = users.u_id WHERE node.type = 4 ORDER BY e_id DESC  ";
     
      $result =$conn->query($sql);
      
       if ($result->num_rows > 0) {
            return $result ;
        }else {
            echo "Error  : " . $conn->error;
        }
     
     
     
   }//end getallnews
   
  function  getOneevent($id){
     $conn = $GLOBALS['conn'];
     
     $sql = "SELECT `node`.`n_id` , node.title , node.description , node.date, event_filed.e_id , event_filed.time_start , event_filed.time_end , event_filed.f_id , files.path , places.name , users.display_name , places.p_id\n"
    . " FROM `node` \n"
    . " INNER JOIN `event_filed` ON node.n_id = event_filed.n_id \n"
    . " INNER JOIN `users` ON node.u_id = users.u_id \n"
    . " INNER JOIN `files` ON event_filed.f_id = files.f_id\n"
    . " INNER JOIN `places` ON event_filed.p_id = places.p_id \n"
    . " WHERE node.type = 4 AND node.n_id =".$id;
     
      $result =$conn->query($sql);
      
       if ($result->num_rows > 0) {
            return $result ;
        }else {
            echo "Error  : " . $conn->error;
        }
  }//end getonenews
  
  function  deleteevent($id){
     $conn = $GLOBALS['conn'];
     
     $sql = "DELETE FROM `node` WHERE n_id=".$id;
     
      $result =$conn->query($sql);
      
       if ($result->num_rows > 0) {
            return TRUE;
        }else {
            echo "Error  : " . $conn->error;
            return FALSE;
        }
  }//end delete 
  
  
  function insertevent($title , $desc , $date , $uid ,$path , $place ,$s_time , $e_time ){
   
    $conn =$GLOBALS['conn'] ;
    $sql = "INSERT INTO `node`( `title`, `description`, `date`, `u_id`, `type`) VALUES ('".$title."','".$desc."','".$date."',".$uid.",4) ;" ;

    if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
        
    $sql = "INSERT INTO `files`( `name`, `path`, `caption`, `type_id`) VALUES ('test' ,'".$path."' , ' ' , 4) ;" ;
      
  if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
        
    $sql = "INSERT INTO `places`(`name`) VALUES ('".$place."')" ;

    if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
       
    $sql = "INSERT INTO `event_filed`(`time_start`, `time_end`, `f_id`, `p_id`, `n_id`) VALUES ('".$s_time."','".$e_time."',(SELECT max(f_id) From `files` WHERE type_id = 4),(SELECT max(p_id) From `places`),(SELECT max(n_id) From `node` WHERE type= 4))" ;

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
  }//end insertevent 
  
  function  updateevent($nodeid , $eventid , $placeid , $fileid ,$userID , $title , $desc , $date , $path , $place ,$s_time , $e_time ){
    $conn =$GLOBALS['conn'] ;
   
      $sql = "UPDATE `node` SET "
        . " `title` = '".$title."' "
        . ", `description` = '".$desc."' "
        . ", `date` = '".$date."' "
        . ", `u_id` = ".$userID." "
        . " WHERE n_id= ".$nodeid.";" ;
      if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
      } else {
      echo "Error updating record: " . $conn->error;
      }
      
      if ($path !='' ){       
     $sql = "UPDATE `files` SET `path` = '".$path."' WHERE f_id = ".$fileid.";" ;
      if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
      } else {
      echo "Error updating record: " . $conn->error;
      }
      }//end check  path
      
      $sql = "UPDATE `places` SET `name` =  '".$place."' WHERE p_id = ".$placeid.";" ;
      if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
      } else {
      echo "Error updating record: " . $conn->error;
      }
          
    $sql = "UPDATE `event_filed` SET "
      . "`time_start` = '".$s_time."'"
      . ", `time_end` = '".$e_time."'"
      . "WHERE e_id = ".$eventid.";" ;
    if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
      } else {
      echo "Error updating record: " . $conn->error;
      }
      
      
    
    
  }//end updateevent 
   
  
  
  function  getEventFrontEnd(){
     $conn = $GLOBALS['conn'];
     
     $sql = "SELECT `node`.`n_id` , node.title , node.description , node.date, event_filed.e_id , event_filed.time_start , event_filed.time_end , event_filed.f_id , files.path , places.name , users.display_name , places.p_id\n"
    . " FROM `node` \n"
    . " INNER JOIN `event_filed` ON node.n_id = event_filed.n_id \n"
    . " INNER JOIN `users` ON node.u_id = users.u_id \n"
    . " INNER JOIN `files` ON event_filed.f_id = files.f_id\n"
    . " INNER JOIN `places` ON event_filed.p_id = places.p_id \n"
    . " WHERE node.type = 4 ORDER BY n_id DESC LIMIT 3 ";
     
      $result =$conn->query($sql);
      
       if ($result->num_rows > 0) {
            return $result ;
        }else {
            echo "Error  : " . $conn->error;
        }
  }//end getonenews
  
  
 }
 
 
 
 
?>

