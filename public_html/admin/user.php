<?php
require_once 'class/loginclass.php' ;
include_once 'class/uesrclass.php' ;

$li = new login () ;
if(!$li->isLoggedIn()){
    header('Location: accessdebn.php');
}

$messages = $_SESSION['messages'];
unset($_SESSION['messages']);

$user = new  userinfo();
$infoRes = $user->getinfo() ;

$id = $_SESSION['user_session'] ;

If ($infoRes->num_rows > 0) {
  $row = $infoRes->fetch_assoc();

  $username = $row['user_name'];
  $desname = $row['display_name'];
  $email =$row['email'];
  $password = $row['Password'];
 }
 
 if ($_POST['action'] == 'save') {
   header("Refresh:0; url=user.php");
   $uname = $_POST['username'];
   $dname = $_POST['displayname'];
   $email = $_POST['email'];
   $user->updateInfo($id, $uname, $dname, $email);
     
 //header('Location: carousal.php');
 
 }else if ($_POST['action'] == 'savepass'){
  $oldpass = $_POST['pass'];
  $oldpass = md5($oldpass) ;
  $newpass = $_POST['newpass'];
  $renewpass = $_POST['renewpass'];
  if ($oldpass == $password ){
    if($newpass == $renewpass){
      $user->updatePass($id, $newpass) ;
         $pmessage = "Success! New Password Saved ";
    }else{
      $passmessage = "new password not match ";
    }
  }else{
    $passmessage =  "wrong password";
  }
  
 }
 
?>

<!doctype html>
<html lang="en">

<head>
<title></title>
<?php  include("includes/head.html") ?>  
</head>

<body>
    <div class="wrapper">
    <?php  include("includes/sildebar.php") ?>
    <div class="main-panel">
    <?php  include("includes/mainpanel.html") ?>
    <a class="navbar-brand" > <br> Profile Page </a>
             <div class="content">
                <div class="container-fluid">
                    <div class="row">
                <div class="col-md-12 block-center">
                    <div class="card">
                        <div class="card-header" data-background-color="purple">
                            <h4 class="title">Edit Profile</h4>
                        </div>
                        <div class="card-content">
                           <?php 
                            if ($passmessage != ''){
                           ?>
                            <div class ="alert alert-danger" style="width: 50%"> <?php print $passmessage ;  ?></div>
                            <?php 
                            $passmessage=NULL;
                            unset($_POST);
                            }
                            ?>
                            <?php  
                            if ($messages != ''){
                            ?>
                            <div class="alert alert-success"><?php print $messages ?></div>
                            <?php 
                             }                                  
                            ?>
                            <?php 
                            if ($pmessage != ''){
                           ?>
                            <div class ="alert alert-success" style="width: 50%"> <?php print $pmessage ;  ?></div>
                            <?php 
                            $pmessage=NULL;
                            unset($_POST);
                            }
                            ?>
                            <?php  
                            if ($messages != ''){
                            ?>
                            <div class="alert alert-success"><?php print $messages ?></div>
                            <?php 
                             }                                  
                            ?>
                          <form method="POST">
                                <div class="row">                                          
                                    <div class="col-md-6">
                                  <div class="form-group label-floating">
                                      <label class="control-label">Username</label>
                                      <input type="text" name ="username" class="form-control" value="<?php print $username ;?>" required>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group label-floating">
                                      <label class="control-label">Email address</label>
                                      <input type="email" name ="email" class="form-control" value="<?php print $email; ?>" required>
                                  </div>
                                </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group label-floating">
                                          <label class="control-label">Display Name</label>
                                          <input type="text" name ="displayname" class="form-control"value ="<?php print $desname; ?>" required>
                                  </div>
                                </div>

                              </div>
                       <button type="submit" class="btn btn-primary pull-right" name ="action" value="save">Update Profile</button>

                        </form>
                            <a  class=" " data-toggle="collapse" data-target="#chpass" style ="cursor: pointer;" >Change Password</a>
                        </div>  
                        <div class = "row">                          
                          <div class ="col-md-8">                              
                             <div id="chpass" class="collapse">                                                               
                              <form class="form-horizontal" method="POST">
                              <!---old password ------>
                              <div class="form-group">
                              <label class="col-sm-4 control-label" for="old-pass" >Old Password</label>
                              <div class="col-sm-8">
                              <input type="password" name ="pass" class="form-control"  id="old-pass" placeholder="Password"/>
                              </div>
                            </div>
                            <!------ new password ------>
                            <div class="form-group">
                              <label class="col-sm-4 control-label" for="new-pass" >New Password</label>
                              <div class="col-sm-8">
                              <input type="password" name ="newpass" class="form-control" id="new-pass" placeholder="Password"/>
                              </div>
                            </div>
                            <!-- rewrite password -------- -->
                            <div class="form-group">
                              <label class="col-sm-4 control-label" for="re-pass" >Confirm Password</label>
                              <div class="col-sm-8">
                              <input type="password" name ="renewpass" class="form-control" id="re-pass"  placeholder="Password"/>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary" name ="action" value="savepass">Save changes</button>
                            </div>               
                            </form>
                            </div> 
                          </div> 
                        </div> 
                        <div class="col-md-4">                           
                        </div>
                    </div>
                </div>
            </div>
            <?php  include("includes/footer.html") ;?>
          <?php  include("includes/footerscripts.html") ;?>
        </div>
        </div>
    </div>
</div>
</body>

</html>




