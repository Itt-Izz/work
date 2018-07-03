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
                                <h4 align="center">Enter Employee details</h4>
                                <div class="col-md-12"> 
                                  <div class="form-group col-md-5"><input class="form-control" type="text" name="fname"  placeholder="First Name"></div> 
                                  <div class="col-md-2" ></div>
                                  <div class="form-group col-md-5"><input class="form-control" type="text" name="lname"  placeholder="Last Name" ></div> 
                                </div>
                            <div class="col-md-12">
                                  <div class="form-group col-md-5"><input class="form-control" type="text" name="uname"  placeholder="Username"></div>
                                  <div class="col-md-2" ></div>
                                  <div class="form-group col-md-5">
                                  <div class="radio">
                                    <label><input type="radio" name="gender" value="male">Male</label>
                                    <label><input type="radio" name="gender" value="female">Female</label>
                                  </div>
                                  </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-5"><input class="form-control" type="text" name="id" placeholder="ID Number"></div> 
                                  <div class="col-md-5"> 
                                  <label class="form-group control-label col-md-3">Birthday:</label>
                               <div class="col-md-3"></div> 
                                  <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyy">
                                    <input class="form-control col-md-6" type="text" name="birthday">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> </div>
                                  </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-sm-5"><input class="form-control" type="text" name="phone" id="phoneNo" placeholder="Phone Number" required></div> 
                                  <div class="form-group col-md-2" ></div>
                                <div  class="col-sm-5">
                                  <select name="department" class="form-control" id="department">
                                    <option value="" selected>Select Department</option>
                                    <option value="Mason" >Mason</option>
                                    <option value="Operator" >Operator</option>
                                    <option value="Electrician">Electrician</option>
                                    <option value="Others">Others</option>
                                  </select>  </div>  
                             </div>
                           <div class="col-md-12">
                                  <div  class="form-group col-sm-5">
                                    <select name="position"  class="form-control" id="position">
                                      <option value="selected">Select Position</option>
                                      <option value="Foreman">Foreman</option>
                                      <option value="As. Foreman">As. Foreman</option>
                                      <option value="Manager">Manager</option>
                                      <option value="Head">Head</option>
                                      <option value="Ass. Head">Ass. Head</option>
                                      <option value="Clerk">Clerk</option>
                                    </select> </div>  
                               <div class="col-md-2"></div> 
                                    <div class="form-group col-sm-5"><input class="form-control" type="text" name="grade" placeholder="Grade" required></div> 
                            </div>
                           <div class="col-md-12">
                                    <div class="form-group col-sm-5"> <input class="form-control" type="text" name="username" placeholder="Username" required></div>
                               <div class="col-md-2"></div> 
                              <?php if($_SESSION['level']=='admin'){?>
                                    <div class="form-group radio form col-sm-5">
                                      <label><input type="radio" name="type" value="clerk">Clerk</label>
                                      <label><input type="radio" name="type" value="employee">Employee</label>
                                    </div>
                         <?php  }?>
                            </div>
                           <div class="col-md-12">
                               <div class="form-group col-sm-5"><input class="form-control" type="password" name="password" id="password" placeholder="Password" required></div> 
                               <div class="col-md-2"></div> 
                               <div class="form-group col-sm-5"><input class="form-control" type="password" name="password2"  placeholder="Confirm Password" required></div> 
                           </div>
                           <div class="col-md-12">
                                    <div class="col-md-4"></div>
                                    <div class="col-sm-4"><button type="submit" name="submit" class="btn btn-success form-control">Register</button></div>
                                    <div class="col-md-4">
                                      <div class="pull-right" id="code">
                                    </b><h4 style="color: #FF00FF;">Sent Code:</h4><label><b>&nbsp;GT-<?php echo rand(4,7959); ?></label> 
                                    </div> </div>
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

                                  <div class="col-md-4">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10" style="background-color: #8FBC8F;">
                              <h4>Confirm this Number</h4>
                              <div class="form-group">
                              <div class="col-md-2"></div>
                              <div class=" col-md-8"><input id="inp" class="form-control" type="text" name="number" value="0710665656"></div>
                              <div class="col-md-2"></div>
                              </div>
                               <div class="form-group">
                              <div class="col-md-2"></div>
                              <div class="col-md-8"><a href="#" class="btn btn-info" id="sendCode">Send Code</a></div>
                              <div class="col-md-2"></div>
                              </div>
                              
                              </div>
                                    <div class="col-md-1"></div>
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

