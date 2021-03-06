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
                  <a href="register.php" id="regc2" class="list-group-item main-color-bg"><img src="img/addP.png" class="hd3">  Add Employee </a>
                    <?php } else if($_SESSION['level']=='admin'){?>
                    <a href="sms.php" class="list-group-item"><img src="img/nit.png" class="hd3">Send SMS</a>
                  <a href="register.php" id="regc2" class="list-group-item  main-color-bg"><img src="img/pple2.png" class="hd3"> Register Clerk </a>
                    <a href="stats.php" id="st" class="list-group-item"><img src="img/reports.png" class="hd3"> Reports </a>
                    <?php } if($_SESSION['level']=='admin'){  ?>
                    <a href="settings.php" class="list-group-item"><img src="img/settings.png" class="hd3"> Settings</a>
                    <?php }?>
                   <a href="changePassword.php" class="list-group-item"><img src="img/pass.png" class="hd3" align="center"> Password</a>
                    </div>                                      
      </div>
                    <div class="col-md-10" id="pan">              
                      <!-- Latest Users -->
                      <div class="panel panel-default">
                        <div class="panel-heading main-color-bg">
                          <h3 class="panel-title">Register Clients</h3>
                        </div>
                        <div class="panel-body">
                          <div id="scrolTable">
                            <form class="form-horizontal" method='POST'  enctype="multipart/form-data" id="uploadForm" name="uploadForm">
                              <div class=" col-md-8 well">
                                <h4 align="center">Enter Employee details</h4>
                                <div class="col-md-12"> 
                                  <div class="form-group col-md-5"><input class="form-control fname" type="text" name="fname"  placeholder="First Name"></div> 
                                  <div class="col-md-2" ></div>
                                  <div class="form-group col-md-5"><input class="form-control lname" type="text" name="lname"  placeholder="Last Name" ></div> 
                                </div>
                            <div class="col-md-12">
                                    <div class="form-group col-md-5"> <input class="form-control username" type="text" name="username" placeholder="Username" required></div>
                                  <div class="col-md-2" ></div>
                                  <div class="radio form-group col-sm-5">
                                    <label><input type="radio" name="gender" value="Male">Male</label>
                                    <label><input type="radio" name="gender" value="Female">Female</label>
                                  </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-5"><input class="form-control id" type="number" name="id" placeholder="ID Number" minlength="6" maxlength="9"></div> 
                               <div class="col-md-1"></div>
                                  <div class="form-group col-md-5">
                                    Birthday: <input type="date" name="birthday" class="datepicker" data-date-format="yyyy-mm-dd" min="1960-01-02" max="2001-12-31">
                                  </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-sm-5"><input class="form-control" type="text" name="phone" id="phoneNo" placeholder="Phone Number" required></div> 
                                  <div class="form-group col-md-2" ></div>
                                <div  class="form-group col-sm-5">
                                  <input class="form-control" type="text" name="email" placeholder="Email">
                                  </div>  
                             </div>
                           <div class="col-md-12"> 
                                    <div class="form-group col-sm-5"><input class="form-control" type="text" name="location" placeholder="Location"></div> 
                               <div class="col-md-2"></div>  
                              <?php if($_SESSION['level']=='admin'){?>
                                    <div class="form-group radio form col-sm-5">
                                      <label><input type="radio" name="type" value="clerk">Clerk</label>
                                      <label><input type="radio" name="type" value="employee">Employee</label>
                                    </div>
                         <?php  }else{ ?>
                                    <div class="form-group radio form col-sm-5">
                                      <label><input type="radio" name="type" value="employee">Employee</label>
                                      <label><input type="radio" name="type" value="clerk" disabled>Other</label>
                                    </div>
                          <?php } ?>
                            </div>
                           <div class="col-md-12">
                               <div class="col-md-2"></div>
                            </div>
                           <div class="col-md-12">
                               <div class="form-group col-sm-5"><input class="form-control" type="password" name="password" id="password" placeholder="Password" required></div> 
                               <div class="col-md-2"></div> 
                               <div class="form-group col-sm-5"><input class="form-control" type="password" name="password2"  placeholder="Confirm Password" required></div> 
                           </div>
                           <div class="col-md-12">
                                    <div class="col-md-4"></div>
                                    <div class="col-sm-4"><button type="submit" name="codeS" class="btn btn-success form-control">Register</button></div>
                                    <div class="col-md-4">
                                      <div class="pull-right" id="code">
                     <!-- <h4 style="color: #FF00FF;">Sent Code:</h4><label><b>&nbsp;GT-
                      <?php 
                      //echo rand(4,7959);
                       ?>
                    </label>  -->
                                    </div> 

                                  </div>
                           </div>
                         </div>
                                <div class="col-md-4 well" id="content">
                                  <div class="col-md-12">
                                  <div id='img_div'>
                                  </div>
                                  <input type="hidden" name="size" value="1000000">
                                  <h5> Select image:</h5>
                                  <div><input class="btn" type="file" name="image" id="file"> </div>
                                  </div>
                                 </div>
                                
                            </form>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </body>
              <?php include 'inc/footer.php';  ?>
              </html>

