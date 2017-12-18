<?php

include_once '../setting/conn.php';

class login {              
                public function checkLogIn ($user_name , $u_password){
                   
                    $conn = $GLOBALS['conn'];

                    $sql = "SELECT *  FROM `users` Where user_name ='".$user_name."'" ;
                    
                    $result =$conn->query($sql);

                    $u_password = md5($u_password) ;
                    //echo $row["Password"] ;

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc() ){
                            if ($u_password == $row["Password"]){
                              
                                 $GLOBALS['username'] = $user_name; 
                                 $GLOBALS['named'] = $row['display_name'];
                                 $GLOBALS['uid'] = $row['u_id'] ;
                                 //print_r($GLOBALS['uid'].'hhh'.$row['u_id']); die('h');
                                 $_SESSION['user_session'] = $row['u_id'];
                                 $_SESSION['username'] = $user_name; 
                                 $_SESSION['named'] = $row['display_name']; 
                                 $_SESSION['sessid']= $row['u_id'] ;
                                                          
                                  header('Location: dashboard.php');
                            }else{
                                echo "<script> alert ('Wrong Password') ; </script> " ; 
                            }
                     
                        } 
                        } else {
                                 echo  "<script> alert ('Wrong Username') ; </script> " ;              
                        }            
               }


               function isLoggedIn() {
                if (isset($_SESSION['user_session'])) {
                    return TRUE;
                }
                else {
                    return FALSE;
                }
            }


            function logout(){
                unset($_SESSION['user_session']);
               //header('Location: index.php');

                }
            
            
            }
           
                
?>            