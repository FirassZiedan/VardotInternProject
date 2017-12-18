<?php


include_once '../setting/conn.php';


class userinfo{

        function getinfo(){
          
            $conn =$GLOBALS['conn'];
            $sql = "SELECT * FROM `users` WHERE u_id =".$_SESSION['user_session'].";" ;
            $result =$conn->query($sql);
            if ($result->num_rows > 0) {
                return $result ;
            }else {
                echo "GETError  : " . $conn->error;
            }
        }
        
        function updateInfo ($id , $uname , $dname , $email){
           $conn =$GLOBALS['conn'];          
           $sql = sprintf("UPDATE `users` SET`user_name`='%s',`display_name`='%s',`email`='%s' WHERE u_id = ".$id.";" , $uname , $dname , $email );
           
            if ($conn->query($sql) === TRUE) {
              $_SESSION['messages'] =  "Record updated successfully";
            } else {
              echo "Error updating record: " . $conn->error;
            }
        }//end update info 
        
        function updatePass ($id , $newPass){
          $conn = $GLOBALS['conn'];      
          $newPass = md5($newPass);
          $sql = sprintf(" UPDATE `users` SET `Password`='%s' WHERE u_id =".$id." ;" , $newPass );
          //print_r($sql) ; die('h');
           if ($conn->query($sql) === TRUE) {
              $_SESSION['messages'] =  "Record updated successfully";
            } else {
              echo "Error updating record: " . $conn->error;
            }
        }//end update pass
        
        
      




}//end class




?>