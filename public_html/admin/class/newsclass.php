<?php

include_once 'setting/conn.php';
 $imgpath  =$GLOBALS['imgpath'] ;

 class news {
   
   function getAllNews(){
     $conn = $GLOBALS['conn'];
     
     $sql = "SELECT * FROM `node` INNER JOIN `users` ON `node`.`u_id` = `users`.`u_id` WHERE `node`.`type` = 3  ORDER BY n_id DESC ";
     
     $result =$conn->query($sql);
      
       if ($result->num_rows > 0) {
            return $result ;
       }else {
            echo "Error  : " . $conn->error;
       }
     
     
     
   }//end getallnews
   
  function  getOneNews($id){
     $conn = $GLOBALS['conn'];
     
     $sql = "SELECT * FROM `node` WHERE `type` = 3  AND n_id = ".$id;
     
     $result =$conn->query($sql);
      
       if ($result->num_rows > 0) {
            return $result ;
        }else {
            echo "Error  : " . $conn->error;
        }
    }//end getonenews
  
  function  deleteNews($id){
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
  
  
  function insertNews($title , $date , $desc , $uid){
     $conn = $GLOBALS['conn'];
     
     $sql = "INSERT INTO `node` (`title`,`date`,`description` , `u_id`,`type`) VALUES ( '".$title."','".$date."' ,'".$desc."' ,".$uid.", 3 ) ";
     
      $result =$conn->query($sql);
      
       if ($result->num_rows > 0) {
            return TRUE;
        }else {
            echo "Error  : " . $conn->error;
            return FALSE;
        }
  }//end insert 
  
  function  updateNews( $nid , $title,$date,$desc , $uid){
    $conn = $GLOBALS['conn'];
     
     $sql = "UPDATE `node` SET `title` ='".$title."', `date`='".$date."', `description` ='".$desc."'  , `u_id`=".$uid."  WHERE n_id =".$nid.";"; 
     
      $result =$conn->query($sql);
      
       if ($result->num_rows > 0) {
            return TRUE;
        }else {
            echo "Error  : " . $conn->error;
            return FALSE;
        }
  }
  
  
  
  
  function getAllNewsFrontEnd(){
     $conn = $GLOBALS['conn'];
     
     $sql = "SELECT  * FROM `node` INNER JOIN `users` ON `node`.`u_id` = `users`.`u_id` WHERE `node`.`type` = 3   ORDER BY n_id DESC   LIMIT 3  ;";
     
     $result =$conn->query($sql);
      
       if ($result->num_rows > 0) {
            return $result ;
       }else {
            echo "Error  : " . $conn->error;
       }
    
 }
 
 }
 
 
 
?>