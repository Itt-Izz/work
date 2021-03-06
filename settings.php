                     
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
    <?php if ($_SESSION['level']!=='admin') { ?>
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
                    <a href="settings.php" class="list-group-item main-color-bg"><img src="img/settings.png" class="hd3"> Settings</a>
                    <?php }?>
                   <a href="changePassword.php" class="list-group-item"><img src="img/pass.png" class="hd3" align="center"> Password</a>
                    </div>                                      
      </div>
                  <div class="col-md-10" id="pan">
                    <div class="panel panel-default">
                      <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Operations</h3>   
                      </div>
                      <div class="panel-body"> 
<div id="scrolTable">
                        <div class="col-md-12">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                        <?php if ($_SESSION['level'] == 'admin') { ?> 
                        <button class="btn btn-default" id="editMore">Actions</button> 
                      <?php } ?>
                        <!-- <button class="btn btn-default" id="empEdit">Edit Employee</button> -->                        
                        <?php if ($_SESSION['level'] == 'admin') { ?>                         
                        <button class="btn btn-default" id="addTool">Add a new Tool</button>
                        <button class="btn btn-default" id="updateTool">Update Tool cost</button>
                        <br> <?php } ?>
                        </div>
                        <div class="col-md-2"></div>
                        </div><!-- make changes and operations------------------------------------------------------------------------ -->
                        <?php if ($_SESSION['level'] =='admin') { ?>                          
               <div class="container col-md-12" id="moreEdit">
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#inb">Change collection rate</a></li>
                            <li><a data-toggle="tab" href="#unr">Increase Wage</a></li>
                                <li><a data-toggle="tab" href="#sen" >Promote to Clerk</a></li>
                                <li><a data-toggle="tab" href="#comp">Demote</a></li>

                              </ul>
          <!-- Change collection rate   .............................................................................. -->    
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
                                                 $rw=$wage->fetch_assoc(); echo $frm; ?>
                                          <label> Current Clerk Wage:</label>
                                          <input type="" name="" value="<?= $rw['clerk']; ?>" class="form-control" disabled>
                                          <label>Current Casuals' Wage:</label>
                                          <input type="" name="" value="<?= $rw['employee']; ?>" class="form-control" disabled>
                                          <label>Last update:</label>
                                          <input type="" name="" value="<?= $rw['date']; ?>" class="form-control" disabled>

                                            <div style="border:white">
                                          <label> New Clerk Wage:</label>
                                          <input type="Number" name="clerkWage" class="form-control" id="wag1" required>
                                          <label>New Casuals' Wage:</label>
                                          <input type="Number" name="empWage" class="form-control" id="wag2" required><br>
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
                                            <select  name="emp" class="form-control">
                                              <?php while($r=$employ->fetch_assoc()){ ?>
                                             <option value= "<?php echo $r['staff_id'];?>" selected> <?php   echo $r['username'];?></option> ?>
                                         <?php } ?>
                                              <option value="" selected>Select Employee.....</option>
                                            </select><br>
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
                                          <label>Sellect clerk you want to demote:</label>
                                            <select  name="emp"  class="form-control">
                                              <?php while($r2=$employ2->fetch_assoc()){ ?>
                                   <option value= "<?php echo $r2['staff_id'];?>" selected> <?php   echo $r2['username']; ?></option> 
                                         <?php } ?>
                                              <option value="" selected>Select Employee.....</option>
                                            </select><br>
                                          <button class="btn btn-info pull-right" id="demote">Demote</button>
                                               
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
<!-- Add tools -->
  <div id="toolAdd" class="col-md-12">
  <div class="col-md-1" ></div>
  <div class="col-md-8 well">
    <form method="POST">
      <div class="form-group">
        <label>Name:</label>
        <input type="text" name="" class="form-control" id="nam3" placeholder="Tool name" required>
      </div>
      <div class="form-group">
        <label>Cost:</label>
        <input type="number" name="" class="form-control" id="cost" required>
      </div>
      <div class="form-group">
        <label>Number:</label>
        <input type="number" name="" class="form-control" id="namba" required>
      </div>
     <button class="btn btn-success pull-right" id="addT">Add</button>
    </form>
  </div>
  <div class="col-md-3"></div>
  </div>
<!-- update tools -->
  <div id="toolUpdate" class="col-md-12">
  <div class="col-md-1"></div>
  <div class="col-md-8 well">
    <table class="table">  
    <tr>
      <td align="center"><b>Tool</b></td>
      <td align="center"><b>Cost</b></td>
      <td align="center"><b>No</b></td>
      <td align="center"><b>New Cost</b></td>
      <td align="center"><b>Change</b></td>
    </tr>    
        <?php $too="SELECT * FROM tools";
               $tool=$con->query($too);
                while($toolRow=$tool->fetch_assoc()) { ?>
          <tr>
       <td  align="center"><?= $toolRow['name'].':'; ?></td>
       <td  align="center"><?= $toolRow['cost'].':'; ?></td>
       <td  align="center"><?= $toolRow['namba'].':'; ?></td>
       <td><input type="number" name="tul" class="form-control tool" minlength="2" maxlength="5" required></td>
       <input type="hidden" name="" value="<?= $toolRow['name'];?>" class="tname">
       <td align="center"><button class="btn btn-info updateCost"" >Update</button></td>
            </tr>   
             <?php } ?>
      
   </table>
  </div>
  <div class="col-md-3"></div>
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