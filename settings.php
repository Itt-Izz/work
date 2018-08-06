                     
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
    <a class="fix-me button" data-target="#feed" data-toggle="modal" href="">Feedback <span class="glyphicon glyphicon-comment"></span></a>
    <div class="container">
     <div class="row">
      <div class="col-md-2">

        <div class="list-group ">
          <a href="home.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Home </a>
          <a href="attendance.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Attendance</a>
            <a href="collection.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Collection</a>
                    <?php if($_SESSION['level']!=='staff'){?>
              <a href="staff.php" id="stuff2" class="list-group-item">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Employees </a>
                    <?php }?>
                <a href="payment.php" id="payHist" class="list-group-item">
                  <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Payment</a>
                  <?php if($_SESSION['level']=='clerk'){  ?>
                  <a href="register.php" id="regc2" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Register Employee </a>
                    <?php } else if($_SESSION['level']=='admin'){?>
                  <a href="register.php" id="regc2" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Register Clerk </a>
                    <a href="stats.php" id="st" class="list-group-item"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Reports </a>
                    <?php }?>
                    <a href="settings.php" class="list-group-item main-color-bg">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Settings</a>
                    </div>

                    <div class="well">
                      <ul class="list-group">
                      <a href="changePassword.php"></a><span id="lg" class="glyphicon glyphicon-flag" aria-hidden="true"></span><a href="#">Change Password</a>
                      </ul>
                    </div>                                      
     </div>
                  <div class="col-md-10" id="pan">
                    <div class="panel panel-default">
                      <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Operations</h3>   
                      </div>
                      <div class="panel-body"> 
                      <div id="scrolTable">
                        <button id="empEdit">Edit Employee</button>
                        <?php if ($_SESSION['level'] == 'clerk') { ?>                          
                        <button>Edit Attendance</button>
                        <button>Edit Collection</button>
                        <button style="color: red">Delete Collection</button>
                        <button style="color: red">Delete Attendance</button>
                      <?php } ?>
                        <?php if ($_SESSION['level'] == 'admin') { ?>                          
                        <button>Add a new Tool</button>
                        <button>Update Tool</button>
                        <button style="color: red">Delete Employee</button>
                        <br><br> <?php } ?>
<!-- edit employee details -->
<div id="editEmp">
                            <form class="form-horizontal" method='POST'  enctype="multipart/form-data" id="uploadForm" name="uploadForm">
                              <div class=" col-md-8 well">
                                <h4 align="center">Edit Employee details</h4>
                                <div class="form-group">
                                  <div class="col-md-12">
                                  <div class="col-md-4"></div>
                                  <div class="col-md-4">
                                            <select  name="to"  class="form-control">
                                              <?php
                                                 while($row=$empA->fetch_assoc()){ ?>
                                               <option  value= "<?php echo $row['staff_id'];?>" selected> <?php   echo $row['username'];?></option>                                                  
                                                <?php } ?>
                                              <option>Select Employee</option>
                                              </select>                                    
                                  </div>
                                  <div class="col-md-4"></div>
                                  </div>
                                 </div>
                                <div class="col-md-12"> 
                                  <div class="form-group col-md-5"><input class="form-control" type="text" name="fname"  placeholder="First Name"></div> 
                                  <div class="col-md-2" ></div>
                                  <div class="form-group col-md-5"><input class="form-control" type="text" name="lname"  placeholder="Last Name" ></div> 
                                </div>
                            <div class="col-md-12">
                                    <div class="form-group col-md-5"> <input class="form-control" type="text" name="username" placeholder="Username" required></div>
                                  <div class="col-md-2" ></div>
                                  <div class="radio form-group col-sm-5">
                                    <label><input type="radio" name="gender" value="Male">Male</label>
                                    <label><input type="radio" name="gender" value="Female">Female</label>
                                  </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-5"><input class="form-control" type="number" name="id" placeholder="ID Number" minlength="6" maxlength="9"></div> 
                               <div class="col-md-1"></div>
                                  <div class="form-group col-md-5">
                                    Birthday: <input type="date" name="birthday">
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
</div> <!--edit employee end-->

<!-- make changes and operations------------------------------------------------------------------------ -->
                        <?php if ($_SESSION['level'] == 'admin') { ?>                          
               <div class="container col-md-12">
                <br><br>
                <h3><b>Make changes:</b></h3>
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#inb">Change collection rate</a></li>
                            <li><a data-toggle="tab" href="#unr">Increase Wage</a></li>
                                <li><a data-toggle="tab" href="#sen" >Promote to Clerk</a></li>
                                <li><a data-toggle="tab" href="#comp">Demote</a></li>
                              </ul>
          <!-- Change correction rate   .............................................................................. -->    
                              <div class="tab-content">
                                <div id="inb" class="tab-pane fade in active">
                                  <div class="row wel">
                                    <div class="panel panel-default">
                                      <div class="panel-heading clearfix">
                                      </div><!-- message head ->from -->
                                      <div class="panel-body">
                                        <div class="col-md-12">
                                           <div class="col-md-2"></div>
                                         <div class="col-md-8 well homePan">
                                        <form class="form-group homePan" method="POST" name="colForm">
                                          <?php $rat="SELECT * FROM collectionrate";
                                                 $rate=$con->query($rat);
                                                 $row=$rate->fetch_assoc(); ?>
                                          <label>Current rate:</label>
                                          <input type="" name="" value="<?= $row['rate']; ?>" class="form-control" disabled>
                                          <label>Date Set:</label>
                                          <input type="" name="" value="<?= $row['date']; ?>" class="form-control" disabled>
                                          <label>New rate:</label>
                                          <input type="number" name="rate" class="form-control" maxlength="2" id="rate" required><br>
                                          <button class="btn btn-info pull-right">Submit</button>
                                        </form>
                                      </div>
                                         <div class="col-md-2"></div>
                                        </div>
                                      </div><!-- inbox panel body -->
                                    </div><!-- inbox panel-->
                                  </div><!-- inbox row well -->
                                </div><!-- inbox tab pane -->

      <!-- Increase employee wage     .............................................................................. -->
                                <div id="unr" class="tab-pane fade">
                                  <div class="row wel">
                                    <div class="panel panel-default">
                                      <div class="panel-heading clearfix">
                                       <h3 class="panel-title"></h3>
                                     </div><!-- message head ->from -->
                                     <div class="panel-body">
                                        <div class="panel-body">
                                        <div class="col-md-12">
                                           <div class="col-md-2"></div>
                                         <div class="col-md-8 well homePan">
                                        <form class="form-group homePan" method="POST" name="updateWage">
                                          <?php $wag="SELECT * FROM wage";
                                                 $wage=$con->query($wag);
                                                 $rw=$wage->fetch_assoc(); ?>
                                          <label> Current Clerk Wage:</label>
                                          <input type="" name="" value="<?= $rw['clerk']; ?>" class="form-control" disabled>
                                          <label>Current Casuals' Wage:</label>
                                          <input type="" name="" value="<?= $rw['employee']; ?>" class="form-control" disabled>
                                          <label>Last update:</label>
                                          <input type="" name="" value="<?= $rw['date']; ?>" class="form-control" disabled>

                                            <div style="border:white">
                                          <label> New Clerk Wage:</label>
                                          <input type="Number" name="clerkWage"  class="form-control" required>
                                          <label>New Casuals' Wage:</label>
                                          <input type="Number" name="empWage" class="form-control" required><br>
                                          <button class="btn btn-info pull-right">Submit</button>
                                               </div>
                                        </form>
                                      </div>
                                         <div class="col-md-2"></div>
                                        </div>
                                      </div>
                                    </div><!-- unread panel body -->
                                  </div><!-- unread panel-->
                                </div><!-- unread row well -->
                              </div><!-- unread tab pane -->

  <!-- Promote Employee to clerk ------------------------------------------------------------------------------->
                              <div id="sen" class="tab-pane fade">
                                <div class="row wel">
                                  <div class="panel panel-default">
                                    <div class="panel-heading clearfix">
                                      <h3 class="panel-title"></h3>
                                    </div><!-- message head ->from -->
                                    <div class="panel-body"> 
                                        <div class="col-md-12">
                                           <div class="col-md-2"></div>
                                         <div class="col-md-8 well homePan">
                                        <form class="form-group homePan" method="POST" name="updatePromotion">
                                          <label><b>All clerks:</b></label>
                                           <?php $clerks="SELECT * FROM staff where level='clerk'";
                                                 $clerk=$con->query($clerks);
                                                while ($clerkRow=$clerk->fetch_assoc() ){ ?>
                                     <input type="" name="" value="<?= $clerkRow['username']; ?>" class="form-control" disabled><br> 
                                               <?php  } ?>                                          
                                          <label>Sellect employee you want to be a clerk:</label>
                                            <select  name="emp"  class="form-control" id="emp">
                                              <?php
                                                  do{?>
                                          <option  value= "<?php echo $row['staff_id'];?>" selected> <?php   echo $row['username'];?></option> <?php } while($row=$employ->fetch_assoc());
                                                ?>
                                              <option value="" selected>Select Employee.....</option></select><br>
                                          <button class="btn btn-info pull-right" id="promote">Promote</button>
                                               
                                        </form>
                                      </div>
                                         <div class="col-md-2"></div>
                                      </div>
                                        </div>
                                  </div><!-- sent panel-->
                                </div><!-- sent row well -->
                              </div><!-- sent tab pane -->
 <!--  demote clerk .............................................................................. -->
                              <div id="comp" class="tab-pane fade">
                                <div class="row wel">
                                  <div class="panel panel-default">
                                    <div class="panel-heading clearfix">
                                    </div><!-- message head ->from -->
                                    <div class="panel-body"> 
                                        <div class="col-md-12">
                                           <div class="col-md-2"></div>
                                         <div class="col-md-8 well homePan">
                                        <form class="form-group homePan" method="POST" name="updateDemotion">
                                          <label><b>All clerks:</b></label>
                                           <?php $clerks="SELECT * FROM staff where level='clerk'";
                                                 $clerk=$con->query($clerks);
                                                while ($clerkRow=$clerk->fetch_assoc() ){ ?>
                                     <input type="" name="" value="<?= $clerkRow['username']; ?>" class="form-control" disabled><br> 
                                               <?php  } ?>                                          
                                          <label>Sellect employee you want to be a clerk:</label>
                                            <select  name="emp"  class="form-control" id="emp">
                                              <?php
                                                  do{?>
                                          <option  value= "<?php echo $row['staff_id'];?>" selected> <?php   echo $row['username'];?></option> <?php } while($row=$employ->fetch_assoc());
                                                ?>
                                              <option value="" selected>Select Employee.....</option></select><br>
                                          <button class="btn btn-info pull-right" id="promote">Demote</button>
                                               
                                        </form>
                                      </div>
                                         <div class="col-md-2"></div>
                                      </div>
                                    </div>
                                  </div><!--  panel-->
                                </div><!--  row well -->
                              </div><!-- tab pane -->
                            </div><!-- container -->
                          </div>
                       <?php } ?>
                      </div> 
                  </div>
                </div>
              </div>                                   
            </div>                                                                 
          </div>
        </section>
      </body>
      <?php include 'inc/footer.php';  ?>
      </html>