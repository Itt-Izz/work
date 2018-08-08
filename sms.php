  
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
    <?php if($_SESSION['level']!=='admin'){?>                                                          
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
                  <a href="register.php" id="regc2" class="list-group-item  main-color-bg">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Employee </a>
                    <?php } else if($_SESSION['level']=='admin'){?>
                    <a href="sms.php" class="list-group-item main-color-bg">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Send Bulk SMS</a>
                  <a href="register.php" id="regc2" class="list-group-item ">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Register Clerk </a>
                    <a href="stats.php" id="st" class="list-group-item"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Reports </a>
                    <a href="settings.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Settings</a>
                    <?php }?>

                    </div> 
                    <div class="well">
                      <ul class="list-group">
      <a class="list-group-item" href="changePassword.php"><span id="lg" class="glyphicon glyphicon-flag" aria-hidden="true"></span>Change Password </a>
                      </ul>
                    </div>                                     
              </div>
                  <div class="col-md-10" id="pan">
                    <div class="panel panel-default" id="pan2">
                      <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Message</h3>
                      </div> <!-- panel heading -->

                      <div class="panel-body"id="scrolTable">
          <!-- Compossing Message     .............................................................................. -->
          <div class="col-md-12">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                                <div class="row wel">
                                  <div class="panel panel-default">
                                    <div class="panel-heading clearfix">
                                    </div>
                                    <div class="panel-body" style="padding: 30px;">                                      
                                      <form method='POST' class="form-horizontal""> 
                                      <div class="form-group">
                                        <label class="col-sm-1" for="inputBody" disabled>Message: </label></div>
                                        <div class="col-sm-7">
                                          <textarea class="form-control"
                                          id="inputBody" rows="8" data-gramm="true" data-gramm_editor="true"placeholder="Type your message here ................................." name="message" ></textarea><br> </div>
                                        <div class="col-md-12">
                                          <div class="col-md-4"></div>
                                   <div class="form-group col-md-4"> 
                                 <button id="sendMore" class="btn btn-info pull-right">Send SMS to all Employees</button>
                                         </div>
                                          <div class="col-md-4"></div>
                                        </div>
                                          <div class="col-sm-4"></div> 
                                   </form>        
                                        </div>



                                    </div>
                            </div>
                          </div>
            </div>
            <div class="col-md-1"></div>
          </div>
                        </div><!-- scrol table -->


                      </div>    <!-- pan -->                                             
                    </div>
                  </div>
                </section>
              </body>
              <?php include 'inc/footer.php';  ?>
              </html>