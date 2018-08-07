                     
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
            <a href="collection.php" class="list-group-item main-color-bg">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Collection</a>
           <?php }  if($_SESSION['level']!=='staff'){ ?>
              <a href="staff.php" id="stuff2" class="list-group-item">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Employees </a>
                    <?php }?>
                <a href="payment.php" id="payHist" class="list-group-item">
                  <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Payment</a>
                  <?php if($_SESSION['level']=='clerk'){  ?>
                  <a href="register.php" id="regc2" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Employee </a>
            <a href="message.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Message</a>
                    <?php } else if($_SESSION['level']=='admin'){?>
                    <a href="sms.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Send Bulk SMS</a>
                  <a href="register.php" id="regc2" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Register Clerk </a>
                    <a href="stats.php" id="st" class="list-group-item"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Reports </a>
                    <?php } if($_SESSION['level']=='admin'){  ?>
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
                    <div class="panel panel-default">
                      <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Collection</h3>
                      </div>
                      <div class="panel-body">
                        <div id="scrolTable">
                          <ol class="breadcrumb">
                            <div class="col-md-3">
                             Today's Rate:<label style="color: blue;"><h4>&nbsp;<b><?php 
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
                              $dates=date("Y-m-d", strtotime("-$y day"));       ?>
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