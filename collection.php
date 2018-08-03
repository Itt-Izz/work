                     
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
            <a href="collection.php" class="list-group-item active main-color-bg">
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
                     <a href=""><span class="glyphicon glyphicon-flag"></span><a href="">Inquery</a><br>
                      <a href=""></a><span id="lg" class="glyphicon glyphicon-flag" aria-hidden="true"></span><a href="#">Change Password</a>
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
                             Today's Rate:<label style="color: blue;"><h4>&nbsp;<b>10<b></h4></label> </div>
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
                              $twoDaysBeforeYesterday=date("Y-m-d", strtotime("-3 day"));
                              $threeDaysBYesterday=date("Y-m-d", strtotime("-4 day"));
                              $fourDaysBYesterday=date("Y-m-d", strtotime("-5 day"));
                              $fiveDaysBYesterday=date("Y-m-d", strtotime("-6 day"));
                              while($row=$employ->fetch_array()){ ?>
                                <tr>
                                  <td><?php echo $row['staff_id']; ?></td>
                                  <td><?php echo $row['fname']; ?></td>
                                  <?php
                                  $staf=$row['staff_id'];
                                   $da="SELECT staff.fname, date_format(col_date, '%W') as day, collection.col_date, collection.weight FROM `collection` LEFT JOIN staff ON collection.staff_id=staff.staff_id WHERE col_date BETWEEN '2018-07-24' AND CURRENT_DATE() and collection.staff_id='$staf'";
                                  $dayz=$con->query($da);
                                   $rwz=$dayz->fetch_assoc();
                                   ?>
                                  <td><input type="" name=""class="form-control" placeholder="20" disabled></td>
                                  <td><input type="" name=""class="form-control" placeholder="20" disabled></td>
                                  <input type="hidden" class="staf" value="<?= $row['staff_id']?>">
                                  <td><input type="" name=""class="form-control" placeholder="20" disabled></td>
                                  <td><input type="" name=""class="form-control" placeholder="40" disabled></td>
                                  <td><input type="" name="" class="form-control" placeholder="80" disabled></td>
                                  <td><input type="" name=""class="form-control" placeholder="<?= $rwz['weight']; ?>" disabled></td>
                                  <td><input class="form-control tea_collect" placeholder="12.5" type="number" required></td>
                                  <td>
                                    <input type="button" name="collectT"class="form-control col_save" value="Save">
                                  </td>
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
                                  <td><?php echo $roow['dailyWage'];?></td>
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