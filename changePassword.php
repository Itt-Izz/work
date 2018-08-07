                     
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
          <a href="home.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Home </a>
            <?php if ($_SESSION['level']=='clerk') { ?>
          <a href="attendance.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Attendance</a>
            <a href="collection.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Collection</a>
           <?php }  if($_SESSION['level']!=='staff'){ ?>
              <a href="staff.php" id="stuff2" class="list-group-item">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Employees </a>
                    <?php }?>
                <a href="payment.php" id="payHist" class="list-group-item">
                  <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Payment</a>
                  <?php if($_SESSION['level']=='clerk'){  ?>
                  <a href="register.php" id="regc2" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Employee </a>
            <a href="message.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Message</a>
                    <?php } else if($_SESSION['level']=='admin'){?>
                    <a href="sms.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Send Bulk SMS</a>
                  <a href="register.php" id="regc2" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Register Clerk </a>
                    <a href="stats.php" id="st" class="list-group-item"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Reports </a>
                    <?php } if($_SESSION['level']=='admin'){  ?>
                    <a href="settings.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Settings</a>
                    <?php }?>

                    </div> 
                    <div class="well">
                      <ul class="list-group">
      <a class="list-group-item main-color-bg" href="changePassword.php"><span id="lg" class="glyphicon glyphicon-flag" aria-hidden="true"></span>Change Password </a>
                      </ul>
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
                                        <form class="form-group homePan" method="POST" name="updatePassword">
                                          <label><b>Current Password:</b></label>
                                           <?php $staf=$_SESSION['staff_id'];
                                            $pass="SELECT password FROM staff where staff_id='$staf'";
                                                 $pw=$con->query($pass);
                                                $passRow=$pw->fetch_assoc(); ?>
                              <input type="password" name="" value="<?= $passRow['password']; ?>" class="form-control" disabled><br> 
                                                                                 
                                <label>New Password:</label>
                              <input type="password" name="password" id="password" class="form-control" ><br> 
                                <label>Confirm Password:</label>
                              <input type="password" name="password2" class="form-control" ><br> 
                                  <button class="btn btn-info pull-right" id="promote">Change PassWord</button>    
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




