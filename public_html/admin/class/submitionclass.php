<?php

include_once  'setting/conn.php';

class submtion {

    
    function getsub(){
           
            $conn  = $GLOBALS['conn'];
            $sql =" SELECT * FROM `submitions` WHERE  NOT `status` = 2 ORDER BY s_id DESC; ";
            $result =$conn->query($sql);
            
            if ($result->num_rows > 0) {
                return $result ;
            }else {
                echo "Error updating record: " . $conn->error;
            }


    }
    function getOne($id){
        $conn  = $GLOBALS['conn'];
        $sql ="SELECT * FROM `submitions` WHERE s_id =".$id ;        
        $result =$conn->query($sql);
        
        if ($result->num_rows > 0) {
            return $result ;
        }else {
            echo "Error updating record: " . $conn->error;
        }

    }

    function status($st , $id){
        $conn  = $GLOBALS['conn'];          
        $sql = "UPDATE submitions SET `status`=".$st." WHERE s_id=".$id.";";               
        if ($conn->query($sql) === TRUE) {
           // echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

    }
    
    
    function insertsubmition($name , $phone , $email , $msg ){
     
        $conn  = $GLOBALS['conn'];          
        $date = date('Y-m-d H:i:s');  
        $sql = "INSERT INTO `submitions`(`name`, `phone`, `email`, `message`, `date`) "
                      . " VALUES ('".$name."' , ".$phone ."  , '".$email."' , '".$msg."' , '".$date."');"; 
   
        if ($conn->query($sql) === TRUE) {
            //echo "Record updated successfully";
      
        } else {
            echo "Error updating record: " . $conn->error;
             die('hi');
        }
    }






}







?>