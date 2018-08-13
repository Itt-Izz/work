                     
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
          <a href="attendance.php" class="list-group-item main-color-bg"><img src="img/employee.png" class="hd3"> Attendance</a>
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
                    <a href="stats.php" id="st" class="list-group-item main-color-bg"><img src="img/reports.png" class="hd3"> Reports </a>
                    <?php } if($_SESSION['level']=='admin'){  ?>
                    <a href="settings.php" class="list-group-item"><img src="img/settings.png" class="hd3"> Settings</a>
                    <?php }?>
                   <a href="changePassword.php" class="list-group-item"><img src="img/pass.png" class="hd3" align="center"> Password</a>
                    </div>                                      
      </div>       
                  <div class="col-md-10" id="pan">
                    <div class="panel panel-default">
                      <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Attendace Sheet <?php echo date('D') ?></h3>   
                      </div>
                      <div class="panel-body">
                        <div id="scrolTable">
                          <div id="attTable">
                          <ol class="breadcrumb">
                          <?php if($_SESSION['level']=='clerk' || $_SESSION['level']=='admin'){?>
                            <div class="col-md-3"><a href="#" style="color: blue;" class="show">Present Today</a> </div>
                          <?php } ?>
                            <div class="col-md-6"> 
                              <h4 align="center" class="two">Attendance Register &nbsp;&nbsp;&nbsp;</h4> &nbsp;&nbsp;&nbsp;
                            </div>
                            <h5 align="right"> <em style="color: black;">Date: </em><b><?php echo " ".$date=date("D d, F Y");?></b></h5>
                            <div class="col-md-3">  </div>
                          </ol>
                          <?php if($_SESSION['level']=='clerk' || $_SESSION['level']=='admin'){?>
                           <table class="table" id="mytable2">
                            <thead>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Present</th>
                              <th>Tool</th>
                              <th>Approve</th>
                            </thead>
                            <tbody>

                          <?php while($row=$employ->fetch_array()){ ?>
                                <tr>
                          <form method="POST">
                                  <td><?php echo $row['staff_id']; $staf=$row['staff_id']; ?></td>
                                  <td><?php echo $row['fname']; ?></td>
                                  <td><?php echo $row['username']; ?></td>
                                  <td><?php echo $row['sex']; ?></td>
                                 <?php
                                 $preCheck="SELECT * FROM attendance WHERE staff_id='$staf' and date=CURDATE() AND present='yes'";
                                 $pr=$con->query($preCheck);
                                 $t="SELECT tools.name FROM tools left join attendance on tools.t_id=attendance.t_id where attendance.staff_id='$staf' and date=CURDATE()";
                                 $too=$con->query($t);
                                 $tool=$too->fetch_assoc();
                                 if($pr->num_rows>0) { ?>
                                  <td style="color: green">Checked</td>
                                  <td><?php if ($tool['name']=='') {
                                   echo '*** No tool ***';
                                  } echo $tool['name'];?></td>
                                  <td style="color: blue">Yes</td>
                                <?php } else { ?> <td>
                                    <div class="checkbox"><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="check" value="yes" style="height: 25px;width: 25px;"></label>
                                    </div> </td>
                                  <td>
                                    <select  name="tool"  class="form-control tool">
                                      <option value="">Select tool</option>
                                     <?php 
                                     //$rw=$tool->fetch_all();
                                     for($i=0;$i<=count($rw[0]);$i++) { ?>
                                      <option value="<?php echo $rw[$i][0]; ?>"> <?php   echo $rw[$i][1]; ?></option>
                                    <?php } ?>
                                  </select>
                                </td>
                                <td><input type="button" class="btnS" value="Save" style="color: green;"></td>
                               <?php  } ?>
                                       <input type="hidden" class="staff" value="<?= $row['staff_id']?>">

                               </form>
                              </tr>
                            <?php    }?>
                          </tbody>
                        </table>
                           <?php  } else{ ?>
                            <table class="table">
                              <th>#</th>
                              <th>Day</th>
                              <th>Date</th>
                              <th>Present</th>
                              <th>Work Done</th>
                              <th>Amount</th>
                              <th>Status</th>
                                <?php $k=1;
                                while ($roow=$employeeCounted->fetch_assoc()){ 
                              $y=$k-1;
                              $dayy=date("D", strtotime("-$y day"));
                              $dates=date("Y-m-d", strtotime("-$y day"));   
                                  ?>
                              <tr>
                          <form method="POST">
                                  <td><?php echo $k; ?></td>
                                  <td><?php echo $dayy; ?></td>
                                  <td><?php echo $dates; ?></td>
                                  <td><?php echo 'yes'; ?></td>
                                  <td><?php echo $r2['count(*)']; ?></td>
                                  <td><?php echo $roow['employee'];?></td>
                                  <?php if($dayy=='Tue'){ ?>
                                  <td><h4 style="color: green">Paid</h4></td>
                               <?php }else { ?>
                                  <td><h4 style="color: blue">Pending</h4></td>
                              <?php } ?>
                                  <td>   <?php   date('Y-m-d', strtotime(' +1 day')) ?> </td>
                               </form>
                              </tr>
                            <?php $k++; } ?>
                            </table>
                            <?php } ?>
                    </div>
                      <div class="col-md-5"></div>
                    <div id="PresentToday">
                          <ol class="breadcrumb">
                            <div class="col-md-3"><a href="#" style="color: blue;" class="bac"><img src="img/back.png" class="hd"> </a>
                            <a href="#" style="color: blue;" class="bac2"><img src="img/back.png" class="hd"> </a>
                             </div>
                            <div class="col-md-6"> 
                              <h4 align="center" class="two">Employees Present today &nbsp;&nbsp;&nbsp;</h4> &nbsp;&nbsp;&nbsp;
                            </div>
                            <h5 align="right"> <em style="color: black;">Date: </em><b><?php echo " ".$date=date("D d, F Y");?></b></h5>
                            <div class="col-md-3">  </div>
                          </ol>
                           <table class="table" id="presentTable">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Tool</th>
                              <th>Status</th>
                              <th>Check</th>
                              <th>Served By</th> 
                              <th>Changes</th> 
                              <th>Remove</th> 
                            </thead>
                            <tbody>
                          <?php if ($emponPre->num_rows > 0) {
                            $i=1;
                           while($rows=$emponPre->fetch_assoc()){ ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $rows['staff_id']; ?></td>
                                  <td><?php echo $rows['fname']; ?></td>
                                  <td><?php echo $rows['username']; ?></td>
                                  <td><?php echo $rows['sex']; ?></td>
                        <input type="hidden" class="stafT" value="<?= $rows['staff_id']?>">                             
                        <input type="hidden" class="stafN" value="<?= $rows['fname']?>">                             

                                  <td><?php 
                                  if ($rows['t_id']=='') {
                                    echo 'None';
                                  } ?>
                                <em style="color: blue"> <?php echo $rows['name']; ?></em></td>
                                  <td>
                          <?php // check whether tool is returned
                                  if ($rows['returned_tool']=='') {
                                    echo '___';
                                  }else if ($rows['returned_tool']=='yes') { ?>
                                <em style="color: green"> <?php echo 'Returned'; ?></em>
                                <?php  }else{ ?>
                                <em style="color: red"> <?php 
                                   echo 'Pending'; ?></em>
                                <?php } ?></td>
                                  <td>
                         <?php if ($rows['returned_tool']=='') {
                                    echo '0';
                                  }else if ($rows['returned_tool']=='yes') { ?>
                                <em style="color: green"> <?php echo 'Done'; ?></em>
                                <?php  }else{ ?>
                                  <button class="btn btn-warning retanT">Return</button>
                                <?php } ?>
                           </td>
                           
                              <?php 
                                $clerkId=$rows['ur_clerk'];
                               $sq="SELECT fname FROM staff where staff_id='$clerkId'";
                               $cl=$con->query($sq);
                               $row=$cl->fetch_assoc();
                                ?>
                               <td><?php echo $row['fname']; ?> </td> 
                               <td><button class="btn btn-warning btn-sml editAtt">Edit</button> </td> 
                               <td><button class="btn btn-danger btn-sml delAtt">Delete</button> </td> 
                          
                              </tr>
                            <?php    } 
                          }else{
                         echo "No record found";
                          } ?>
                          </tbody>
                        </table> 
                        <table class="table" id="editThis">
                            <thead>
                              <th>Name</th>
                              <th>Present</th>
                              <th>Tool</th>
                              <th>Save</th>  
                            </thead>
                            <tbody>   
                              <tr> <input type="hidden" id="eStaf" value="">
                               <td><input type="" class="form-control st" value="" disabled> </td> 
                               <td><select  name="pre"  class="form-control" id="pre">
                                      <option value="1">Present</option>
                                      <option value="0">Absent</option>
                                  </select></td> <td>
                                    <select  name="tool"  class="form-control" id="t">
                                      <option value="">Select tool</option>
                                     <?php 
                                     //$rw=$tool->fetch_all();
                                     for($i=0;$i<=count($rw[0]);$i++) { ?>
                                      <option value="<?php echo $rw[$i][0]; ?>"> <?php   echo $rw[$i][1]; ?></option>
                                    <?php } ?>
                                  </select>
                                </td> 
                               <td><button class="btn btn-warning btn-sml saveE">Save</button> </td>  
                          
                              </tr>
                          </tbody>
                        </table>
                      
                    </div>
                      <div class="col-md-5"></div>
                    </div>
                  </div>
                </div>
              </div>                                   
            </div>                                                                 
          </div>
        </section>
        <!-- Modal -->
  <div class="modal fade" id="preCheck" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div id="showMess"></div>
        </div>
      </div>
    </div>
  </div> 
      </body>
      <?php include 'inc/footer.php';  ?>
      </html>