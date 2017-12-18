<?php 

include_once '../setting/conn.php';
 $imgpath  =$GLOBALS['imgpath'] ;


class feacture{

    /**
     * Get the feature id
     */
    function getFeact(){
        $conn = $GLOBALS['conn'];
        $sql = "SELECT * FROM `features`   INNER join `files`   on features.f_id = files.f_id where files.type_id = 2 ORDER BY fe_id DESC"  ;
        $result =$conn->query($sql);
        
        if ($result->num_rows > 0) {
            return $result ;
        }else {
            echo "Error  : " . $conn->error;
        }
    }
        function getOne($id){
            $conn = $GLOBALS['conn'];
            

             $sql = "SELECT * FROM `features` 
                     INNER join `files` on features.f_id = files.f_id
                     WHERE files.type_id = 2  AND features.fe_id=".$id.";"  ;
             
                                $result =$conn->query($sql);
             
                                 if ($result->num_rows > 0) {
                                   
                                     return $result ;
             
                                 }else {
                                    echo "Error  : " . $conn->error;
                                }


        }
        function delete($id , $f_id){
            $conn = $GLOBALS['conn'];
            
            $sql = "DELETE FROM `files` where f_id =".$f_id  ;                      

             if ($result->num_rows > 0) {
               
                 return $result ;

             }else {
                echo "Error  : " . $conn->error;
            }
             $sql = "DELETE FROM `features` where fe_id =".$id  ;
             
             $result =$conn->query($sql);
 
              if ($result->num_rows > 0) {
                
                  return $result ;
 
              }else {
                echo "Error  : " . $conn->error;
            }
 

        }
        function insertFeact($url , $file , $cap){           
            $conn = $GLOBALS['conn'];
            

                $sql = "INSERT INTO `files` (`name`, `path`, `caption`, `type_id`)
                                VALUES (`name`,'".$file."','".strtoupper($cap)."', 2)";
               

                        if ($conn->query($sql) === TRUE) {
                       
                        } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        }

                $sql = "INSERT INTO `features` (`url`, `f_id` , `name`)
                 VALUES ('".$url."', (SELECT max(f_id) From `files` WHERE type_id = 2) , '' )";
                

                        if ($conn->query($sql) === TRUE) {
                       
                        } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        }


        }
        function updateFeact($id ,$f_id ,  $url , $file , $cap){
            $conn = $GLOBALS['conn'];
            
                   
                   
                   $sql = "UPDATE `files` SET  `caption` = '".strtoupper($cap)."' " ;
                  
                    if ($file != ''){
                        $sql = $sql.", `path` = '".$file."'" ; 
                    }

                    $sql = $sql." WHERE f_id =".$f_id ; 
                   
                    if ($conn->query($sql) === TRUE) {

                    } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    }

   
                    $sql = "UPDATE `features` SET `url` ='".$url."'  WHERE fe_id =".$id ;                   
        
                    if ($conn->query($sql) === TRUE) {

                    } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    }


                
        }
        
        
        
        function checkURL ($url){      
            
         // return  filter_var($url, 	FILTER_FLAG_SCHEME_REQUIRED);
          $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

            // The Text you want to filter for urls
            $text = "The text you want to filter goes here. http://google.com";

            // Check if there is a url in the text
            if(preg_match($reg_exUrl, $text, $url)) {

              return TRUE;

            } else {

              return FALSE;
}

          
          /*if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED | FILTER_FLAG_QUERY_REQUIRED)) {
                  //echo "URL is valid";
                  return TRUE;
              }
              else {
                  //echo "URL is invalid";
                  return FALSE;
              }*/
            }
          
              function getFeactFrontEnd(){
        $conn = $GLOBALS['conn'];
        $sql = "SELECT * FROM `features`   INNER join `files`   on features.f_id = files.f_id where files.type_id = 2 ORDER BY fe_id DESC LIMIT 4"  ;
        $result =$conn->query($sql);
        
        if ($result->num_rows > 0) {
            return $result ;
        }else {
            echo "Error  : " . $conn->error;
        }
    }
        
        
        
        
        





}// end the class 




?>