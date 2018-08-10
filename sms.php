  
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
                    <a href="sms.php" class="list-group-item main-color-bg"><img src="img/nit.png" class="hd3">Send SMS</a>
                  <a href="register.php" id="regc2" class="list-group-item "><img src="img/pple2.png" class="hd3"> Register Clerk </a>
                    <a href="stats.php" id="st" class="list-group-item"><img src="img/reports.png" class="hd3"> Reports </a>
                    <?php } if($_SESSION['level']=='admin'){  ?>
                    <a href="settings.php" class="list-group-item"><img src="img/settings.png" class="hd3"> Settings</a>
                    <?php }?>
                   <a href="changePassword.php" class="list-group-item"><img src="img/pass.png" class="hd3" align="center"> Password</a>
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
                                          <div class="col-md-4">
                                   <label>To : </label>  
                                    <select  name="emp" id="emplo">
                                              <?php while($r=$employ->fetch_assoc()){ ?>
                                             <option value= "<?php echo $r['staff_id'];?>" selected> <?php   echo $r['username'];?></option> ?>
                                         <?php } ?>
                                              <option value="" selected>Select Employee.....</option>
                                            </select>
                                          </div>
                                   <div class="form-group col-md-4">                                  
                                 <button id="sendOne" class="btn btn-info">Send</button>
                                         </div>
                                          <div class="col-md-4">
                                 <button id="sendMore" class="btn btn-default pull-right form-control">Send SMS to All Employees</button>
                               </div>
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