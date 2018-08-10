                     
<?php
include('php/connection.php');
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
include ('php/query.php');
?>
<!doctype html>
<html lang="en">
<head>
  <?php include 'inc/head.php'; ?>                   
</head>
<body>
  <?php include 'inc/header.php'; ?>
  <section id="main">
    <?php if ($_SESSION['level'] != 'admin') { ?>
   <a class="fix-me button" data-target="#feed" data-toggle="modal" href="">Feedback <span class="glyphicon glyphicon-comment"></span></a>
   <?php } ?>
    <div class="container">
     <div class="row">
      <div class="col-md-2">
        <div class="list-group ">
          <a href="home.php" class="list-group-item"><img src="img/home.png" class="hd3"> Home </a>
            <?php if ($_SESSION['level']=='clerk') { ?>
          <a href="attendance.php" class="list-group-item"><img src="img/employee.png" class="hd3"> Attendance</a>
            <a href="collection.php" class="list-group-item"><img src="img/weight.png" class="hd3"> Collection</a>
           <?php }  if($_SESSION['level']!=='staff'){ ?>
              <a href="staff.php" id="stuff2" class="list-group-item"><img src="img/worker.png" class="hd3">  Employees </a>
                    <?php }?>
                <a href="payment.php" id="payHist" class="list-group-item"><img src="img/pay.png" class="hd3">  Payment</a>
                  <?php if($_SESSION['level']=='clerk'){  ?>
                  <a href="register.php" id="regc2" class="list-group-item"><img src="img/addP.png" class="hd3">  Add Employee </a>
                    <?php } else if($_SESSION['level']=='admin'){?>
                    <a href="sms.php" class="list-group-item"><img src="img/nit.png" class="hd3">Send SMS</a>
                  <a href="register.php" id="regc2" class="list-group-item "><img src="img/pple2.png" class="hd3"> Register Clerk </a>
                    <a href="stats.php" id="st" class="list-group-item"><img src="img/reports.png" class="hd3"> Reports </a>
                    <?php } if($_SESSION['level']=='admin'){  ?>
                    <a href="settings.php" class="list-group-item"><img src="img/settings.png" class="hd3"> Settings</a>
                    <?php }?>
                   <a href="changePassword.php" class="list-group-item main-color-bg"><img src="img/pass.png" class="hd3" align="center"> Password</a>
                    </div>                                      
      </div>
                  <div class="col-md-10" id="pan">
                    <div class="panel panel-default">
                      <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Change Password</h3>   
                      </div>
                      <div class="panel-body">  
                                        <div class="col-md-12">
                                           <div class="col-md-1"></div>
                                         <div class="col-md-10 well homePan">
                                        <form class="form-group homePan" method="POST" id="updatePassword">
                                          <label><b>Current Password:</b></label>
                                           <?php $staf=$_SESSION['staff_id'];
                                            $pass="SELECT password FROM staff where staff_id='$staf'";
                                                 $pw=$con->query($pass);
                                                $passRow=$pw->fetch_assoc(); ?>
                              <input type="hidden" name="pas" id="empl" value="<?= $staf; ?>" class="form-control"><br> 
                              <input type="password" name="pass" class="form-control"><br> 
                              <input type="hidden" name="pass2" id="pass2" value="<?= $passRow['password'] ?>" class="form-control"><br> 
                                                                                 
                                <label>New Password:</label>
                              <input type="password" name="password" id="password" class="form-control" ><br> 
                                <label>Confirm Password:</label>
                              <input type="password" name="password2" class="form-control" ><br> 
                                  <button class="btn btn-info pull-right" id="changepass">Change PassWord</button>    
                                        </form>
                                      </div>
                                         <div class="col-md-1"></div>
                                      </div>
                                    </div><!-- compose panel body -->
                                  </div><!-- compose panel-->
                  </div>
                </div>
              </div>
        </section>
      </body>
      <?php include 'inc/footer.php';  ?>
      </html>




