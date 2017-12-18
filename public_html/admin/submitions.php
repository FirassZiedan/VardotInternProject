<?php 

require_once 'class/submitionclass.php';

require_once 'class/loginclass.php' ;

$li = new login () ;
if(!$li->isLoggedIn()){
    header('Location: accessdebn.php');
}

$sub = new submtion ();

$res = $sub->getsub() ;

?> 

<!doctype html>
<html lang="en">

<head>
<title><?php $GLOBALS['subtitle'];  ?></title>
<?php  include("includes/head.html") ?>
</head>

<body>
<div class="wrapper">
<?php  include("includes/sildebar.php") ?>
<div class="main-panel">
<?php  include("includes/mainpanel.html") ?>
<a class="navbar-brand" > <br> Submitions Page </a>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header" data-background-color="purple">
                  <h4 class="title">Submitions</h4>
              </div>
              <div class="card-content table-responsive">
                 <?php  
                    if ($messages != ''){
                  ?>
                    <div class="alert alert-success"><?php print $messages ?></div>
                  <?php 
                    }                                  
                  ?>
                <table class="table">
                  <thead class="text-primary">
                    <th></th>
                    <th>Name</th>
                    <th>Email </th>
                    <th>Time</th>
                    <th>Status</th>
                    <th></th>
                  </thead>
                  <form method="GET" id = "caroform" action = "submitiond.php">
                  <tbody>
                    
                    <?php
                      If ($res->num_rows > 0) {
                      while ($row = $res->fetch_assoc() ) {

                      if ($row['status']== 0){
                          $status = "UnRead";
                      }else if ($row['status'] == 1){
                          $status = "Read";
                      }else if ($row['status']== 2){
                          $status = "Delete";
                      }
                    ?>
                    
                     <tr>                                                
                         <td><?php echo $row['s_id']; ?></td>                                                         
                         <td><?php echo $row['name']; ?></td> 
                         <td><?php echo $row['email']; ?></td>                                                         
                         <td><?php echo $row['date']; ?></td> 
                         <td><?php echo $status ; ?></td>
                         <td class="text-primary"><button class ="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id ="buttSlider" data-id ="<?php echo $row['s_id']; ?>" name ="sid" value="<?php echo $row['s_id']; ?>" >Details</button></td>
                     </tr>
                     
                      <?php
                        }
                      }else{
                      ?>  
                      <td colspan="6"> No Result </td> 
                      <?php
                      }
                      ?>
                      
                        </tbody>
                      </form> 
                    </table>
                </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php  include("includes/footer.html") ?>
    </div>
</div>
</body>
<?php  include("includes/footerscripts.html") ?>
</html>