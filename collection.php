                     
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
            <a href="collection.php" class="list-group-item main-color-bg"><img src="img/weight.png" class="hd3"> Collection</a>
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
                    <a href="settings.php" class="list-group-item"><img src="img/settings.png" class="hd3"> Settings</a>
                    <?php }?>
                   <a href="changePassword.php" class="list-group-item"><img src="img/pass.png" class="hd3" align="center"> Password</a>
                    </div>                                      
      </div>
                  <div class="col-md-10" id="pan">
                    <div class="panel panel-default">
                      <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Collection</h3>
                      </div>
                      <div class="panel-body">
                        <div id="scrolTable">
                          <ol class="breadcrumb">
                            <div class="col-md-3">
                              <button class="btn" id="tCol">Todays</button>
                              <button class="btn" id="colT">Back</button>
                              Rate:<label style="color: blue;"><h4>&nbsp;<b><?php 
                                         $r="SELECT * FROM collectionrate";
                                         $rate=$con->query($r);
                                         $rrow=$rate->fetch_assoc();
                                        echo $rrow['rate'];
                             ?><b></h4></label> </div>
                              <div class="col-md-6"> 
                                <h4 align="center" class="two">Daily Tea Collection &nbsp;&nbsp;&nbsp;</h4> &nbsp;&nbsp;&nbsp;
                              </div>
                              <h5 align="right"> <em style="color: black;">Date: </em><b><?php echo " ".$date=date("D d, F Y");?></b></h5>
                              <div class="col-md-3">  
                            </div>
                          </ol>
                          <?php if($_SESSION['level']=='clerk' || $_SESSION['level']=='admin'){?>
                            <div id="col5">
                          <table class="table" id="mytable4">
                            <thead>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th><?=$fiveDaysBY;?></th>
                              <th><?=$fourDaysBY;?></th>
                              <th><?=$threeDaysBY;?></th>
                              <th><?=$twoDaysBY;?></th>
                              <th><?=$dayBY;?></th>
                              <th>Yesterday</th>
                              <th>Today</th>
                              <th>Approve</th>
                            </thead>
                            <tbody>
                              <?php  
                              $yesterday=date("Y-m-d", strtotime("yesterday"));
                              $dayBeforeYesterday=date("Y-m-d", strtotime("-2 day"));
                              $twoDaysBefore=date("Y-m-d", strtotime("-3 day"));
                              $threeDaysBYesterday=date("Y-m-d", strtotime("-4 day"));
                              $fourDaysBYesterday=date("Y-m-d", strtotime("-5 day"));
                              $fiveDaysBYesterday=date("Y-m-d", strtotime("-6 day"));
                              while($row=$employ->fetch_array()){ ?>
                                <tr>
                                  <td><?php echo $row['staff_id']; ?></td>
                                  <td><?php echo $row['fname']; ?></td>
                                  <?php
                                  $staf=$row['staff_id'];
                                   $qeu="SELECT weight FROM `collection` WHERE col_date='$yesterday' AND staff_id='$staf'";
                                  $q=$con->query($qeu);
                                  if($q->num_rows > 0){
                                  $row=$q->fetch_assoc();
                                  $yWeight=$row['weight'];
                                  }else{
                                  $yWeight=0;
                                  }
                                   $qeu2="SELECT weight FROM `collection` WHERE col_date='$dayBeforeYesterday' AND staff_id='$staf'";
                                  $q2=$con->query($qeu2);
                                  if($q2->num_rows > 0){
                                  $row=$q2->fetch_assoc();
                                  $y2Weight=$row['weight'];
                                  }else{
                                  $y2Weight=0;
                                  }
                                  $qeu3="SELECT weight FROM `collection` WHERE col_date='$twoDaysBefore' AND staff_id='$staf'";
                                  $q3=$con->query($qeu3);
                                  if($q3->num_rows > 0){
                                  $row=$q3->fetch_assoc();
                                  $y3Weight=$row['weight'];
                                  }else{
                                  $y3Weight=0;
                                  }
                                   $qeu4="SELECT weight FROM `collection` WHERE col_date='$threeDaysBYesterday' AND staff_id='$staf'";
                                  $q4=$con->query($qeu4);
                                  if($q4->num_rows > 0){
                                  $row=$q4->fetch_assoc();
                                  $y4Weight=$row['weight'];
                                  }else{
                                  $y4Weight=0;
                                  }
                                   $qeu5="SELECT weight FROM `collection` WHERE col_date='$fourDaysBYesterday' AND staff_id='$staf'";
                                  $q5=$con->query($qeu5);
                                  if($q5->num_rows > 0){
                                  $row=$q5->fetch_assoc();
                                  $y5Weight=$row['weight'];
                                  }else{
                                  $y5Weight=0;
                                  }
                                   $qeu6="SELECT weight FROM `collection` WHERE col_date='$fiveDaysBYesterday' AND staff_id='$staf'";
                                  $q6=$con->query($qeu6);
                                  if($q6->num_rows > 0){
                                  $row=$q6->fetch_assoc();
                                  $y6Weight=$row['weight'];
                                  }else{
                                  $y6Weight=0;
                                  } ?>
                                  <td><input type="" name=""class="form-control" placeholder="<?= $y6Weight; ?>" disabled></td>
                                  <td><input type="" name=""class="form-control" placeholder="<?= $y5Weight; ?>" disabled></td>
                                  <input type="hidden" class="staf" value="<?= $staf;?>">
                                  <td><input type="" name=""class="form-control" placeholder="<?= $y4Weight; ?>" disabled></td>
                                  <td><input type="" name=""class="form-control" placeholder="<?= $y3Weight; ?>" disabled></td>
                                  <td><input type="" name="" class="form-control" placeholder="<?= $y2Weight; ?>" disabled></td>
                                  <td><input type="" name=""class="form-control" placeholder="<?= $yWeight; ?>" disabled></td>
                                  <?php $colt="SELECT weight FROM collection WHERE staff_id='$staf' AND col_date=CURDATE()";
                                         $col=$con->query($colt);
                                         if($col->num_rows > 0) { 
                                         $colRow=$col->fetch_assoc();
                                         echo "<td align='center'>";
                                         echo $colRow['weight'];
                                         echo "</td>";
                                         echo "<td style='color: green;'>";
                                         echo "Taken";
                                         echo "</td>"; } else{ ?>
                                  <td><input class="form-control tea_collect" placeholder="12.5" maxlength="5" type="number" required></td>
                                  <td>
                                    <input type="button" name="collectT"class="form-control col_save" value="Save">
                                  </td>
                                        <?php  } ?>
                              </tr>
                            <?php    }  ?>
                          </tbody>
                        </table>
                      </div>
                      <div id="colTable">
                        <table class="table">
                          <thead>
                            <th>#</th>
                            <th>Reg-Id</th>
                            <th>Name</th>
                            <th>Collection</th>
                            <th>Change</th>
                            <th>Remove</th>
                          </thead>
                          <tbody>
                            <?php if ($emponPreC->num_rows>0) {
                              $i=1;
                              while ($row=$emponPreC->fetch_assoc()) {  
                               $staf=$row['staff_id']; ?>
                               <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['staff_id']; ?></td>
                                  <input type="hidden" class="staf" value="<?= $staf;?>">
                              <td><?php echo $row['fname']; ?></td>
                              <td><input type="number" name="" class="form-control col-xs-2 weight" value="<?= $row['weight'];?>" required></td>
                              <td><button class="btn btn-warning editCol">Edit</button></td>
                              <td><button class="btn btn-danger delCol">Delete</button></td>
                            </tr>
                             <?php $i++; }
                            } else { echo "No Record Found"; } ?>
                           </tbody>
                        </table>
                      </div>
                           <?php  } ?>
                        <div class="col-md-5"></div>
                        <div class="col-md-5"></div>
                      </div>
                    </div>
                  </div>
                </div>                                   
              </div>                                                                 
            </div>
          </div>
        </section>
 <!-- Modal -->
  <div class="modal fade" id="showMod" role="dialog">
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