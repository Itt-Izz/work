                     
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
          <a href="home.php" class="list-group-item active main-color-bg">
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
                    <a href="settings.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Settings</a>
                    </div>

                    <div class="well">
                      <ul class="list-group">
                      <a href=""></a><span id="lg" class="glyphicon glyphicon-flag" aria-hidden="true"></span><a href="#">Change Password</a>
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
<div class="container col-md-12">
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#inb">Change collection rate</a></li>
                            <li><a data-toggle="tab" href="#unr">Increase Wage</a></li>
                                <li><a data-toggle="tab" href="#sen" >Promote to Clerk</a></li>
                                <li><a data-toggle="tab" href="#comp">Demote</a></li>
                                <li><a data-toggle="tab" href="#comp2">Change Password</a></li>
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
           <!-- Change password .............................................................................. -->
                              <div id="comp2" class="tab-pane fade">
                                <div class="row wel">
                                  <div class="panel panel-default">
                                    <div class="panel-heading clearfix">
                                    </div><!-- message head ->from -->
                                    <div class="panel-body"> 
                                        <div class="col-md-12">
                                           <div class="col-md-2"></div>
                                         <div class="col-md-8 well homePan">
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
                                         <div class="col-md-2"></div>
                                      </div>
                                    </div><!-- compose panel body -->
                                  </div><!-- compose panel-->
                                </div><!-- compose row well -->
                              </div><!-- compose tab pane -->



                            </div><!-- container -->
                          </div>


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