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
    <a class="fix-me" data-target="#feed" data-toggle="modal" href="">Feedback <span class="glyphicon glyphicon-comment"></span></a>
    <div class="container">
      <div class="row">
        <div class="col-md-2">

          <div class="list-group ">
            <a href="home.php" class="list-group-item">
              <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Home </a>
               <a href="collection.php" class="list-group-item" id="col">
            <span class="glyphicon glyphicon-flag" aria-hidden="true"></span>Collections </a>
              <a href="staff.php" id="stuff2" class="list-group-item">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Employees </a>
                <a href="payment.php" id="payHist" class="list-group-item">
                  <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Payment</a>
                  <a href="register.php" id="regc2" class="list-group-item active main-color-bg">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Register Clerk </a>
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle list-group-item glyphicon glyphicon-user mainNav" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Profile
                       <span class="caret"></span></button>
                       <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a href="contact.php"   id="con2">Contact Info</a></li>
                        <li><a href="account.php"  id="acc2">Account Info</a></li>
                      </ul>
                    </div>
                    <a href="stats.php" id="st" class="list-group-item"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Reports </a>
                    <a href="message.php" id="inbox" class="list-group-item">
                      <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Messages </a>
                    </div>

                    <div class="well">
                      <ul class="list-group">
                        <br> <span class="glyphicon glyphicon-flag"></span> <a href="stats.php">System Update</a><br><br>
                        <span class="glyphicon glyphicon-flag"></span><a href="">Specialization</a><br><br>
                        <span class="glyphicon glyphicon-flag"></span> <a href="">Managing Your Acc</a><br><br>
                        <span class="glyphicon glyphicon-flag"></span> <a href="">FAQ</a><br><br>
                        <span class="glyphicon glyphicon-flag"></span> <a href="">How to Earn more </a><br><br>
                        <span id="lg" class="glyphicon glyphicon-flag" aria-hidden="true"></span><a href="#">Change Password</a>
                      </ul>
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

                            <form class="form-horizontal" method='POST' action='php/registerStaff.php' enctype="multipart/form-data" id="uploadForm">
                          <div class=" col-md-8 well">
                              <div class="form-group"> 
                                <label class="control-label col-sm-2">Full Name:</label>
                                <div class="col-sm-4"><input class="form-control" type="text" name="fname"  placeholder="Full Name" required></div>  
                                <label class="control-label col-sm-1">Sex:</label>
                                <div class="radio col-sm-5">
                                  <label><input type="radio" name="gender" value="male">Male</label>
                                  <label><input type="radio" name="gender" value="female">Female</label>
                                  <!-- <label><input type="radio" name="gender" value="semenya" disabled>Semenya</label> -->
                                </div>  
                              </div>
                              <div class="form-group"> 
                                <label class="control-label col-sm-2">Birthday:</label>
                                <div id="datepicker" class="col-sm-4 input-group date" data-date-format="yyy-mm-dd"><input class="form-control" type="text" name="birthday" placeholder="Birthday" required>
                                 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar" ></i></span>
                                </div>  
                                <label class="control-label col-sm-2">ID No:</label>
                                <div class="col-sm-4"><input class="form-control" type="text" name="id" placeholder="ID Number" required></div>  
                              </div>
                              <div class="form-group"> 
                                <label class="control-label col-sm-2">Phone No:</label>
                                <div class="col-sm-4"><input class="form-control" type="text" name="phone"  placeholder="Phone Number" required></div> 
                                <label class="control-label col-sm-2">Department</label>
                                <div  class="col-sm-4">
                                  <select name="department" class="form-control" id="department">
                                    <option value="" selected>Select Department</option>
                                    <option value="Mason" >Mason</option>
                                    <option value="Operator" >Operator</option>
                                    <option value="Welding">Welding</option>
                                    <option value="Carpenter">Carpenter</option>
                                    <option value="Mechanic">Mechanic</option>
                                    <option value="Electrician">Electrician</option>
                                    <option value="Others">Others</option>
                                  </select>  </div>  
                                </div>
                                <div class="form-group"> 
                                  <label class="control-label col-sm-2">Position</label>
                                  <div  class="col-sm-4">
                                    <select name="position"  class="form-control" id="position">
                                      <option value="selected">Select Position</option>
                                      <option value="Foreman">Foreman</option>
                                      <option value="As. Foreman">As. Foreman</option>
                                      <option value="Manager">Manager</option>
                                      <option value="Regular Worker">Regular Worker</option>
                                      <option value="Supervisor">Supervisor</option>
                                      <option value="Head">Head</option>
                                      <option value="Ass. Head">Ass. Head</option>
                                      <option value="Clerk">Clerk</option>
                                    </select> </div>   
                                    <label class="control-label col-sm-2">Level:</label>
                                    <div class="col-sm-4"><input class="form-control" type="text" name="grade" placeholder="Grade" required></div>  
                                  </div>

                                  <div class="form-group"> 
                                    <label class="control-label col-sm-2">Username:</label>
                                    <div class="col-sm-4"> <input class="form-control" type="text" name="username" placeholder="Username" required></div>
                                    <label class="control-label col-sm-2">User Type:</label>
                                    <div class="radio form col-sm-4">
                                      <label><input type="radio" name="type" value="clerk">Clerk</label>
                                      <label><input type="radio" name="type" value="employee">Employee</label>
                                    </div>
                                  </div>
                                  <div class="form-group"> 
                                    <label class="control-label col-sm-2">Password:</label>
                                    <div class="col-sm-4"><input class="form-control" type="password" name="password" id="password" placeholder="Password" required></div>  
                                    <label class="control-label col-sm-2">Retype:</label>
                                    <div class="col-sm-4"><input class="form-control" type="password" name="password2"  placeholder="Confirm Password" required></div>  
                                  </div>
                                  <div class="form-group"> 
                                    <label class="control-label col-sm-3"></label>
                                    <div class="col-sm-9"><button type="submit" name="submit" class="btn btn-success form-control">Register</button></div>  
                                  </div>
                              </div>
                              <div class="col-md-4 well" id="content">
                                <div id='img_div'>
                                  <?php; ?>
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

