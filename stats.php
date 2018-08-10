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
<!-- Latest Users -->
<div class="panel panel-default">
  <div class="panel-heading main-color-bg">
    <h3 class="panel-title">Statistics</h3>

  </div>
  <div class="panel-body">
    <div id="scrolTable">
     <img src="img/back.png"class="hd pull-left" id="showGraph">
        <div class="col-md-1"></div>
      <h3 class="col-md-10" align="center">Workers Attendance and collection Details</h3><br>
        <img src="img/next.png" class="hd"id="hideGraph">
      <?php
      $quer="SELECT t_id, name, namba, cost FROM tools ORDER BY t_id";
       $data=array();
       $rw=$con->query($quer);
       foreach ($rw as $row) {
         $data[]=$row;
       }
       //Daily employee attendance
      // $que="SELECT date_format(date, '%W') AS day, COUNT('day') as dayCount FROM attendance GROUP BY day";
      $que="SELECT date_format(pay_date, '%W') AS day, sum(amt) as dayCount FROM pay GROUP BY day";       
      $que2="SELECT date_format(pay_date, '%W') AS day, sum(amt) as Amt FROM pay WHERE att_col='1' GROUP BY day";       
      $que3="SELECT date_format(pay_date, '%W') AS day, sum(amt) as Amt FROM pay WHERE att_col='1'  GROUP BY day";       
       $dat=array();
       $r=$con->query($que);
       foreach ($r as $row) {
         // $dat[]=$row;
        array_push($dat, $row);
       }
//Daily employee collection
      $que2="SELECT date_format(col_date, '%W') AS day, sum(weight) as dayCount FROM collection GROUP BY day";
       $dat2=array();
       $rc=$con->query($que2);
       foreach ($rc as $row) {
         // $dat[]=$row;
        array_push($dat2, $row);
       }//Print in json
       // print json_encode($dat2);
        ?>
<div id="graphs">
       <div class="col-md-12">
         <div class="col-md-3" style="height: 150px; background-color: lightgrey;">
           <h4>Present Today</h4>
           <div class="col-md-3">
            <img src="img/employee.png" class="hd2 pull-left">             
           </div>
           <div class="col-md-3">
            <?php $preNo="SELECT COUNT(*) FROM attendance LEFT JOIN staff on attendance.staff_id=staff.staff_id WHERE attendance.present='yes' AND attendance.date=CURDATE() ";
               $resultPresent=$con->query($preNo);
               $row=$resultPresent->fetch_assoc();
               echo "<h1 >".$row['COUNT(*)']."</h1>";
             ?>
             
           </div>
           <div class="col-md-6">
          <p> <?php 
         $qr3 = "SELECT *, count(*) FROM attendance LEFT JOIN staff on attendance.staff_id=staff.staff_id WHERE attendance.present='yes' AND attendance.date=CURDATE() GROUP BY sex";
        $sex =  $con->query($qr3);
            while($rowsb = $sex->fetch_array()) {
                        echo $rowsb['sex'].": <b>".$rowsb['count(*)'].'</b>';
                        echo "<br><br>";
                    } ?></p>
           </div>
           
         </div>
         <div class="col-md-1"></div>
         <div class="col-md-3" style="height: 150px; background-color: lightgreen;">
            <h4>Total collection today</h4>
            <div class="col-md-3"><h1><img src="img/weight.png" class="hd2 pull-left" ></div>
           <div class="col-md-3">
            <?php $tc="SELECT COUNT(weight) as weight FROM collection WHERE col_date=CURDATE()";
                  $t=$con->query($tc);
                  $row=$t->fetch_assoc(); 
                  $rat="SELECT rate FROM collectionrate";
                  $rate=$con->query($rat);
                  $rowRate=$rate->fetch_assoc();
           ?>
             
              <?php echo "<h1 >".$row['weight']."</h1>"; ?></h1>
           </div>
           <div class="col-md-6">
          <p> <h5>Rate:</h5><h6><b><?php echo $rowRate['rate']." per Kg"; ?></b></h6></p>
           <p><h5>Amount:</h5><h6><b><?php echo "Ksh. ".$rowRate['rate']*$row['weight']; ?></b></h6></p>
           </div>
         </div>
         <div class="col-md-1"></div>
         <div class="col-md-3" style="height: 150px; background-color: #cbcbcb;">
            <h4>Tools lost</h4>
            <div class="col-md-3"><img src="img/tools.png" class="hd2" ></div>
           <div class="col-md-3">
            <?php $tl="SELECT COUNT(*)as no, sum(cost)as cost FROM `attendance` LEFT JOIN tools on attendance.t_id=tools.t_id WHERE attendance.returned_tool='No'";
                $tq=$con->query($tl);
                $toolRows=$tq->fetch_assoc();
             ?>
             <h1><?php echo $toolRows['no']; ?></h1>
           </div>
           <div class="col-md-6">
          <p> <h5>Cost</h5><h6><?php echo $toolRows['cost']; ?></h6></p>
           </div>
         </div>
         <div class="col-md-1"></div>
       </div><br><br><br><br>
       <div class="col-md-12" style="background-color: #F8F8F8; margin: 20px; padding: 10px;">
            <div class="container col-md-6">
                <canvas id="mychart"></canvas>
            </div>
            <div class="container col-md-6">
                <canvas id="mypy"></canvas>
            </div> 
       </div><br><br><br>
     </div> <!--End graphs -->
<!-- this week, last week, this month, last month -->
<div id="reports">
<div class="container col-md-12">
  <h3>Dynamic Reports</h3>
  <ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#home">Attendance</a></li>
    <li><a data-toggle="pill" href="#menu1">Collection</a></li>
    <li><a data-toggle="pill" href="#menu2">Payments</a></li>
  </ul>
  
  <div class="tab-content">
    <!-- Attendance reports ,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,, -->
    <div id="home" class="tab-pane fade in active">
      <h4 align="center">Attendance Report:</h4>
<div class="col-md-12">
  <ul class="nav nav-tabs" role="tablist">
    <li class="active"><a data-toggle="tab" href="#t">Today</a></li>
    <li><a data-toggle="tab" href="#y">Yesterday</a></li>
    <li><a data-toggle="tab" href="#w">This Week</a></li>
    <li><a data-toggle="tab" href="#lw">Last week</a></li>
    <li><a data-toggle="tab" href="#m">This Month</a></li>
    <li><a data-toggle="tab" href="#lm">Last Month</a></li>
  </ul>
  <div class="tab-content">
   <div id="t" class="tab-pane fade in active">
    <!-- Today Attend--------------------------------------------- -->
    <table class="table">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Tool</th>
                              <th>Tool-State</th>
                              <th>Served By</th> 
                            </thead>
                            <tbody>
                          <?php if($emponPre->num_rows > 0){
                            $i=1;
                           while($rows=$emponPre->fetch_assoc()){ ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $rows['staff_id']; ?></td>
                                  <td><?php echo $rows['fname']; ?></td>
                                  <td><?php echo $rows['username']; ?></td>
                                  <td><?php echo $rows['sex']; ?></td>
                        <input type="hidden" class="stafT" value="<?= $rows['staff_id'];?>">                             

                                  <td><?php 
                                  if ($rows['t_id']=='') {
                                    echo 'None';
                                  } ?>
                                <em style="color: blue"> <?php echo $rows['name']; ?></em></td>
                                  <td>
                          <?php // check whether tool is returned
                                  if ($rows['returned_tool']=='') {
                                    echo '---';
                                  } else if ($rows['returned_tool']=='yes') { ?>
                                <em style="color: green"> <?php echo 'Returned'; ?></em>
                                <?php  }else{ ?>
                                <em style="color: red"> <?php 
                                   echo 'Pending'; ?></em>
                                <?php } ?></td>                                                             
                              <?php   $clerkId=$rows['ur_clerk'];
                               $sq="SELECT fname FROM staff where staff_id='$clerkId'";
                               $cl=$con->query($sq);
                               $row=$cl->fetch_assoc();
                                ?>
                               <td><?php echo $row['fname']; ?> </td>  
                          
                              </tr>
                            <?php   $i++; } 
                          } else {
                              echo "No record Found";
                            } ?>
                          </tbody>
                        </table>

     </div>
    <div id="y" class="tab-pane fade">
      <!-- Yesterday------------------------------------------------------ -->
    <table class="table">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Tool</th>
                              <th>Tool-State</th>
                              <th>Served By</th> 
                            </thead>
                            <tbody>
                          <?php if($emponPre2->num_rows > 0){
                            $i=1;
                           while($rows=$emponPre2->fetch_assoc()){ ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $rows['staff_id']; ?></td>
                                  <td><?php echo $rows['fname']; ?></td>
                                  <td><?php echo $rows['username']; ?></td>
                                  <td><?php echo $rows['sex']; ?></td>
                        <input type="hidden" class="stafT" value="<?= $rows['staff_id']?>">                             

                                  <td><?php 
                                  if ($rows['t_id']=='') {
                                    echo 'None';
                                  } ?>
                                <em style="color: blue"> <?php echo $rows['name']; ?></em></td>
                                  <td>
                          <?php // check whether tool is returned
                                  if ($rows['returned_tool']=='') {
                                    echo '---';
                                  }else if ($rows['returned_tool']=='yes') { ?>
                                <em style="color: green"> <?php echo 'Returned'; ?></em>
                                <?php  }else{ ?>
                                <em style="color: red"> <?php 
                                   echo 'Pending'; ?></em>
                                <?php } ?></td>                                                             
                              <?php    $clerkId=$rows['ur_clerk'];
                               $sq="SELECT fname FROM staff where staff_id='$clerkId'";
                               $cl=$con->query($sq);
                               $row=$cl->fetch_assoc();
                                ?>
                               <td><?php echo $row['fname']; ?> </td>  
                          
                              </tr>
                            <?php   $i++; }
                             } else {
                              echo "No record found"; 
                            } ?>
                          </tbody>
                        </table>
    </div>


    <!-- This week ------------------------------------------------- -->
    <div id="w" class="tab-pane fade">
    <table class="table">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Tool</th>
                              <th>Tool-State</th>
                              <th>Date (Day)</th>
                              <th>Served By</th> 
                            </thead>
                            <tbody>
                             <?php  if($wkA->num_rows > 0){
                                   $i=1;
                                   while ($wkRow=$wkA->fetch_assoc()) { ?>
                                    <tr>
                                      <td><?php echo $i; ?></td>
                                      <td><?php echo $wkRow['staff_id']; ?></td>
                                      <td><?php echo $wkRow['fname']; ?></td>
                                      <td><?php echo $wkRow['username']; ?></td>
                                      <td><?php echo $wkRow['sex']; ?></td>
                                      <td><?php 
                                  if ($wkRow['t_id']=='') {
                                    echo 'None';
                                  } else { echo $wkRow['name']; } ?></td>
                                   <td><?php if ($wkRow['returned_tool']=='') {
                                    echo '---';
                                  }else if ($wkRow['returned_tool']=='yes') { ?>
                                <em style="color: green"> <?php echo 'Returned'; ?></em>
                                <?php  }else{ ?>
                                <em style="color: red"> <?php 
                                   echo 'Pending'; ?></em>
                                </td><?php }
                                 $day=$wkRow['date'];
                                 $d=date("D", strtotime($day)); 
                                $clerkId=$wkRow['ur_clerk'];
                               $sq="SELECT fname FROM staff where staff_id='$clerkId'";
                               $cl=$con->query($sq);
                               $row=$cl->fetch_assoc();
                                ?>                               
                                 <td><?= $day." (".$d.")"; ?></td>
                               <td><?php echo $row['fname']; ?> </td>
                                    </tr>
                                   <?php $i++; }
                                    } else{
                                      echo "No Record found";
                                    } ?>

                          </tbody>
                        </table>
    </div>
    <!-- Last week---------------------------------------------------- -->
    <div id="lw" class="tab-pane fade">
    <table class="table">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Tool</th>
                              <th>Tool-State</th>
                              <th>Date (Day)</th>
                              <th>Served By</th>  
                            </thead>
                            <tbody>
                          
                             <?php  if($wkB->num_rows > 0){
                                   $i=1;
                                   while ($wkRow=$wkB->fetch_assoc()) { ?>
                                    <tr>
                                      <td><?php echo $i; ?></td>
                                      <td><?php echo $wkRow['staff_id']; ?></td>
                                      <td><?php echo $wkRow['fname']; ?></td>
                                      <td><?php echo $wkRow['username']; ?></td>
                                      <td><?php echo $wkRow['sex']; ?></td>
                                      <td><?php 
                                  if ($wkRow['t_id']=='') {
                                    echo 'None';
                                  } else { echo $wkRow['name']; } ?></td>
                                   <td><?php if ($wkRow['returned_tool']=='') {
                                    echo '---';
                                  }else if ($wkRow['returned_tool']=='yes') { ?>
                                <em style="color: green"> <?php echo 'Returned'; ?></em>
                                <?php  }else{ ?>
                                <em style="color: red"> <?php 
                                   echo 'Pending'; ?></em>
                                <?php }
                                 $day=$wkRow['date'];
                                 $d=date("D", strtotime($day)); 
                                  $clerkId=$wkRow['ur_clerk'];
                               $sq="SELECT fname FROM staff where staff_id='$clerkId'";
                               $cl=$con->query($sq);
                               $row=$cl->fetch_assoc();
                                ?></td>
                                
                                 <td><?= $day." (".$d.")"; ?></td>
                               <td><?php echo $row['fname']; ?> </td>
                                    </tr>
                                   <?php $i++; }
                                    } else{
                                      echo "No Record found";
                                    } ?>

                          </tbody>
                        </table>
    </div>

    <!-- This month------------------------------------------ -->
    <div id="m" class="tab-pane fade">
    <table class="table">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Tool</th>
                              <th>Tool-State</th>
                              <th>Date (Day)</th>
                              <th>Served By</th> 
                            </thead>
                            <tbody>

                             <?php  if($mtA->num_rows > 0){
                                   $i=1;
                                   while ($wkRow=$mtA->fetch_assoc()) { ?>
                                    <tr>
                                      <td><?php echo $i; ?></td>
                                      <td><?php echo $wkRow['staff_id']; ?></td>
                                      <td><?php echo $wkRow['fname']; ?></td>
                                      <td><?php echo $wkRow['username']; ?></td>
                                      <td><?php echo $wkRow['sex']; ?></td>
                                      <td><?php 
                                  if ($wkRow['t_id']=='') {
                                    echo 'None';
                                  } else { echo $wkRow['name']; } ?></td>
                                   <td><?php if ($wkRow['returned_tool']=='') {
                                    echo '---';
                                  }else if ($wkRow['returned_tool']=='yes') { ?>
                                <em style="color: green"> <?php echo 'Returned'; ?></em>
                                <?php  }else{ ?>
                                <em style="color: red"> <?php 
                                   echo 'Pending'; ?></em>
                                <?php }
                                 $day=$wkRow['date'];
                                 $d=date("D", strtotime($day)); 
                                  $clerkId=$wkRow['ur_clerk'];
                               $sq="SELECT fname FROM staff where staff_id='$clerkId'";
                               $cl=$con->query($sq);
                               $row=$cl->fetch_assoc();
                                ?></td>
                                
                                 <td><?= $day." (".$d.")"; ?></td>
                               <td><?php echo $row['fname']; ?> </td>
                                    </tr>
                                   <?php $i++; }
                                    } else{
                                      echo "No Record found";
                                    } ?>

                         
                          </tbody>
                        </table>    </div>


                        <!-- Last Month------------------------------ -->
    <div id="lm" class="tab-pane fade">
    <table class="table">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Tool</th>
                              <th>Tool-State</th>
                              <th>Date (Day)</th>
                              <th>Served By</th> 
                            </thead>
                            <tbody>
                         
                             <?php  if($mtB->num_rows > 0){
                                   $i=1;
                                   while ($wkRow=$mtB->fetch_assoc()) { ?>
                                    <tr>
                                      <td><?php echo $i; ?></td>
                                      <td><?php echo $wkRow['staff_id']; ?></td>
                                      <td><?php echo $wkRow['fname']; ?></td>
                                      <td><?php echo $wkRow['username']; ?></td>
                                      <td><?php echo $wkRow['sex']; ?></td>
                                      <td><?php 
                                  if ($wkRow['t_id']=='') {
                                    echo 'None';
                                  } else { echo $wkRow['name']; } ?></td>
                                   <td><?php if ($wkRow['returned_tool']=='') {
                                    echo '---';
                                  }else if ($wkRow['returned_tool']=='yes') { ?>
                                <em style="color: green"> <?php echo 'Returned'; ?></em>
                                <?php  }else{ ?>
                                <em style="color: red"> <?php 
                                   echo 'Pending'; ?></em>
                                <?php }
                                 $day=$wkRow['date'];
                                 $d=date("D", strtotime($day)); 
                                  $clerkId=$wkRow['ur_clerk'];
                               $sq="SELECT fname FROM staff where staff_id='$clerkId'";
                               $cl=$con->query($sq);
                               $row=$cl->fetch_assoc();
                                ?></td>
                                
                                 <td><?= $day." (".$d.")"; ?></td>
                               <td><?php echo $row['fname']; ?> </td>
                                    </tr>
                                   <?php $i++; }
                                    } else{
                                      echo "No Record found";
                                    } ?>

                          </tbody>
                        </table>
      
    </div>
  </div>
</div>

    </div>
    <!-- Collection reports ,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,, -->
    <div id="menu1" class="tab-pane fade">
      <h4 align="center" >Collection Report:</h4>
<div class="col-md-12">
  <ul class="nav nav-tabs" role="tablist">
    <li class="active"><a data-toggle="tab" href="#t2">Today</a></li>
    <li><a data-toggle="tab" href="#y2">Yesterday</a></li>
    <li><a data-toggle="tab" href="#w2">This Week</a></li>
    <li><a data-toggle="tab" href="#lw2">Last week</a></li>
    <li><a data-toggle="tab" href="#m2">This Month</a></li>
    <li><a data-toggle="tab" href="#lm2">Last Month</a></li>
  </ul>
  <div class="tab-content">
   <div id="t2" class="tab-pane fade in active">
    <!-- Today Attend--------------------------------------------- -->
    <table class="table">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Weight(Kg)</th>
                              <th>Status</th>
                              <th>Served By</th> 
                            </thead>
                            <tbody>
                          <?php if($emponPreC->num_rows > 0){
                            $i=1;
                           while($rows=$emponPreC->fetch_assoc()){ ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $rows['staff_id']; ?></td>
                                  <td><?php echo $rows['fname']; ?></td>
                                  <td><?php echo $rows['username']; ?></td>
                                  <td><?php echo $rows['sex']; ?></td>
                        <input type="hidden" class="stafT" value="<?= $rows['staff_id'];?>">                             

                                  <td><?php echo $rows['weight']; ?></td>
                                  <td>
                          <?php
                                  if ($rows['status']=='1') {
                                    echo 'Paid';
                                  } else{ ?>
                                <em style="color: red"> <?php 
                                   echo 'Pending'; ?></em>
                                <?php } ?></td>                                                             
                              <?php   $clerkId=$rows['ur_clerk'];
                               $sq="SELECT fname FROM staff where staff_id='$clerkId'";
                               $cl=$con->query($sq);
                               $row=$cl->fetch_assoc();
                                ?>
                               <td><?php echo $row['fname']; ?> </td>  
                          
                              </tr>
                            <?php   $i++; } 
                          } else {
                              echo "No record Found";
                            } ?>
                          </tbody>
                        </table>

     </div>
    <div id="y2" class="tab-pane fade">
      <!-- Yesterday------------------------------------------------------ -->
    <table class="table">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Tool</th>
                              <th>Tool-State</th>
                              <th>Served By</th> 
                            </thead>
                            <tbody>
                          <?php if($emponPre2C->num_rows > 0){
                            $i=1;
                           while($rows=$emponPre2C->fetch_assoc()){ ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $rows['staff_id']; ?></td>
                                  <td><?php echo $rows['fname']; ?></td>
                                  <td><?php echo $rows['username']; ?></td>
                                  <td><?php echo $rows['sex']; ?></td>
                        <input type="hidden" class="stafT" value="<?= $rows['staff_id'];?>">                             

                                  <td><?php echo $rows['weight']; ?></td>
                                  <td>
                          <?php
                                  if ($rows['status']=='1') {
                                    echo 'Paid';
                                  } else{ ?>
                                <em style="color: red"> <?php 
                                   echo 'Pending'; ?></em>
                                <?php } ?></td>                                                             
                              <?php   $clerkId=$rows['ur_clerk'];
                               $sq="SELECT fname FROM staff where staff_id='$clerkId'";
                               $cl=$con->query($sq);
                               $row=$cl->fetch_assoc();
                                ?>
                               <td><?php echo $row['fname']; ?> </td>  
                          
                              </tr>
                            <?php   $i++; }
                             } else {
                              echo "No record found"; 
                            } ?>
                          </tbody>
                        </table>
    </div>


    <!-- This week ------------------------------------------------- -->
    <div id="w2" class="tab-pane fade">
    <table class="table">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Weight(Kgs)</th>
                              <th>Status</th>
                              <th>Date (Day)</th>
                              <th>Served By</th> 
                            </thead>
                            <tbody>
                             <?php  if($wkAC->num_rows > 0){
                                   $i=1;
                                   while ($wkRow=$wkAC->fetch_assoc()) { ?>
                                    <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $wkRow['staff_id']; ?></td>
                                  <td><?php echo $wkRow['fname']; ?></td>
                                  <td><?php echo $wkRow['username']; ?></td>
                                  <td><?php echo $wkRow['sex']; ?></td>
                        <input type="hidden" class="stafT" value="<?= $wkRow['staff_id'];?>">                             

                                  <td><?php echo $wkRow['weight']; ?></td>
                                  <td>
                          <?php
                                  if ($wkRow['status']=='1') {
                                    echo 'Paid';
                                  } else{ ?>
                                <em style="color: red"> <?php 
                                   echo 'Pending'; ?></em>
                                <?php } ?></td>  
                                <td><?php 
                                 $day=$wkRow['col_date'];
                                 $d=date("D", strtotime($day));
                                 echo $day." (".$d.")"; ?></td>                                                           
                              <?php   $clerkId=$wkRow['ur_clerk'];
                               $sq="SELECT fname FROM staff where staff_id='$clerkId'";
                               $cl=$con->query($sq);
                               $row=$cl->fetch_assoc();
                                ?>
                               <td><?php echo $row['fname']; ?> </td>  
                          
                              </tr>
                                   <?php $i++; }
                                    } else{
                                      echo "No Record found";
                                    } ?>

                          </tbody>
                        </table>
    </div>
    <!-- Last week---------------------------------------------------- -->
    <div id="lw2" class="tab-pane fade">
    <table class="table">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Tool</th>
                              <th>Tool-State</th>
                              <th>Date (Day)</th>
                              <th>Served By</th>  
                            </thead>
                            <tbody>
                          
                             <?php  if($wkBC->num_rows > 0){
                                   $i=1;
                                   while ($wkRow=$wkBC->fetch_assoc()) { ?>
                                     <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $wkRow['staff_id']; ?></td>
                                  <td><?php echo $wkRow['fname']; ?></td>
                                  <td><?php echo $wkRow['username']; ?></td>
                                  <td><?php echo $wkRow['sex']; ?></td>
                        <input type="hidden" class="stafT" value="<?= $wkRow['staff_id'];?>">                             

                                  <td><?php echo $wkRow['weight']; ?></td>
                                  <td>
                          <?php
                                  if ($rows['status']=='1') {
                                    echo 'Paid';
                                  } else{ ?>
                                <em style="color: red"> <?php 
                                   echo 'Pending'; ?></em>
                                <?php } ?></td>  
                                <td><?php 
                                 $day=$wkRow['col_date'];
                                 $d=date("D", strtotime($day));
                                 echo $day." (".$d.")"; ?></td>                                                           
                              <?php   $clerkId=$wkRow['ur_clerk'];
                               $sq="SELECT fname FROM staff where staff_id='$clerkId'";
                               $cl=$con->query($sq);
                               $row=$cl->fetch_assoc();
                                ?>
                               <td><?php echo $row['fname']; ?> </td>  
                          
                                   <?php $i++; }
                                    } else{
                                      echo "No Record found";
                                    } ?>

                          </tbody>
                        </table>
    </div>

    <!-- This month------------------------------------------ -->
    <div id="m2" class="tab-pane fade">
    <table class="table">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Tool</th>
                              <th>Tool-State</th>
                              <th>Date (Day)</th>
                              <th>Served By</th> 
                            </thead>
                            <tbody>

                             <?php  if($mtAC->num_rows > 0){
                                   $i=1;
                                   while ($wkRow=$mtAC->fetch_assoc()) { ?>
                                     <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $wkRow['staff_id']; ?></td>
                                  <td><?php echo $wkRow['fname']; ?></td>
                                  <td><?php echo $wkRow['username']; ?></td>
                                  <td><?php echo $wkRow['sex']; ?></td>
                        <input type="hidden" class="stafT" value="<?= $wkRow['staff_id'];?>">                             

                                  <td><?php echo $wkRow['weight']; ?></td>
                                  <td>
                          <?php
                                  if ($wkRow['status']=='1') {
                                    echo 'Paid';
                                  } else{ ?>
                                <em style="color: red"> <?php 
                                   echo 'Pending'; ?></em>
                                <?php } ?></td>  
                                <td><?php 
                                 $day=$wkRow['col_date'];
                                 $d=date("D", strtotime($day));
                                 echo $day." (".$d.")"; ?></td>                                                           
                              <?php   $clerkId=$wkRow['ur_clerk'];
                               $sq="SELECT fname FROM staff where staff_id='$clerkId'";
                               $cl=$con->query($sq);
                               $row=$cl->fetch_assoc();
                                ?>
                               <td><?php echo $row['fname']; ?> </td>  
                          
                                   <?php $i++; }
                                    } else{
                                      echo "No Record found";
                                    } ?>

                         
                          </tbody>
                        </table>    </div>


                        <!-- Last Month------------------------------ -->
    <div id="lm2" class="tab-pane fade">
    <table class="table">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Tool</th>
                              <th>Tool-State</th>
                              <th>Date (Day)</th>
                              <th>Served By</th> 
                            </thead>
                            <tbody>
                         
                             <?php  if($mtBC->num_rows > 0){
                                   $i=1;
                                   while ($wkRow=$mtBC->fetch_assoc()) { ?>
                                     <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $wkRow['staff_id']; ?></td>
                                  <td><?php echo $wkRow['fname']; ?></td>
                                  <td><?php echo $wkRow['username']; ?></td>
                                  <td><?php echo $wkRow['sex']; ?></td>
                        <input type="hidden" class="stafT" value="<?= $wkRow['staff_id'];?>">                             

                                  <td><?php echo $wkRow['weight']; ?></td>
                                  <td>
                          <?php
                                  if ($wkRow['status']=='1') {
                                    echo 'Paid';
                                  } else{ ?>
                                <em style="color: red"> <?php 
                                   echo 'Pending'; ?></em>
                                <?php } ?></td>  
                                <td><?php 
                                 $day=$wkRow['col_date'];
                                 $d=date("D", strtotime($day));
                                 echo $day." (".$d.")"; ?></td>                                                           
                              <?php   $clerkId=$wkRow['ur_clerk'];
                               $sq="SELECT fname FROM staff where staff_id='$clerkId'";
                               $cl=$con->query($sq);
                               $row=$cl->fetch_assoc();
                                ?>
                               <td><?php echo $row['fname']; ?> </td>  
                          
                                   <?php $i++; }
                                    } else{
                                      echo "No Record found";
                                    } ?>

                          </tbody>
                        </table>
      
    </div>
  </div>
</div>

    </div>
    <!-- Payments reports ,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,, -->
    <div id="menu2" class="tab-pane fade">
      <h4 align="center">Payment Report:</h4>
<div class="col-md-12">
  <ul class="nav nav-tabs" role="tablist">
    <li class="active"><a data-toggle="tab" href="#t3">Today</a></li>
    <li><a data-toggle="tab" href="#y3">Yesterday</a></li>
    <li><a data-toggle="tab" href="#w3">This Week</a></li>
    <li><a data-toggle="tab" href="#lw3">Last week</a></li>
    <li><a data-toggle="tab" href="#m3">This Month</a></li>
    <li><a data-toggle="tab" href="#lm3">Last Month</a></li>
  </ul>
  <div class="tab-content">
   <div id="t3" class="tab-pane fade in active">
    <!-- Today Attend--------------------------------------------- -->
    <table class="table">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Amount</th> 
                              <th>Deduction</th> 
                              <th>Type</th> 

                            </thead>
                            <tbody>
                          <?php if($p2d->num_rows > 0){
                            $i=1;
                           while($rows=$p2d->fetch_assoc()){ ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $rows['staff_id']; ?></td>
                                  <td><?php echo $rows['fname']; ?></td>
                                  <td><?php echo $rows['username']; ?></td>
                                  <td><?php echo $rows['sex']; ?></td>
                                  <td><?php echo $rows['amt']; ?></td>                             
                                  <td><?php echo $rows['deduction']; ?></td>                             
                                  <td><?php $day=$rows['pay_date']; ?></td>                           
                                  <td><?php if($rows['att_col']=='1') {
                                    echo "Attendance";
                                  }else{
                                    echo "Collection";
                                  } ?></td>                             
                              </tr>
                            <?php   $i++; } 
                          } else {
                              echo "No record Found";
                            } ?>
                          </tbody>
                        </table>

     </div>
    <div id="y3" class="tab-pane fade">
      <!-- Yesterday------------------------------------------------------ -->
    <table class="table">
                            <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Amount</th> 
                              <th>Deduction</th> 
                              <th>Type</th> 

                            </thead>
                            <tbody>
                          <?php if($p2dy->num_rows > 0){
                            $i=1;
                           while($rows=$p2dy->fetch_assoc()){ ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $rows['staff_id']; ?></td>
                                  <td><?php echo $rows['fname']; ?></td>
                                  <td><?php echo $rows['username']; ?></td>
                                  <td><?php echo $rows['sex']; ?></td>
                                  <td><?php echo $rows['amt']; ?></td>                             
                                  <td><?php echo $rows['deduction']; ?></td>                                                        
                                  <td><?php if($rows['att_col']=='1') {
                                    echo "Attendance";
                                  }else{
                                    echo "Collection";
                                  } ?></td>                             
                              </tr>
                            <?php   $i++; } 
                          } else {
                              echo "No record Found";
                            } ?>
                          </tbody>
                        </table>
    </div>


    <!-- This week ------------------------------------------------- -->
    <div id="w3" class="tab-pane fade">
    <table class="table">
                           <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Amount</th> 
                              <th>Deduction</th> 
                              <th>Date (Day)</th> 
                              <th>Type</th> 

                            </thead>
                            <tbody>
                          <?php if($pyW->num_rows > 0){
                            $i=1;
                           while($rows=$pyW->fetch_assoc()){ ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $rows['staff_id']; ?></td>
                                  <td><?php echo $rows['fname']; ?></td>
                                  <td><?php echo $rows['username']; ?></td>
                                  <td><?php echo $rows['sex']; ?></td>
                                  <td><?php echo $rows['amt']; ?></td>                             
                                  <td><?php echo $rows['deduction']; ?></td>                             
                                  <td><?php $day=$rows['pay_date'];
                                           $d=date("D", strtotime($day));
                                            echo $day." (".$d.")";  ?></td>                             
                                  <td><?php if($rows['att_col']=='1') {
                                    echo "Attendance";
                                  }else{
                                    echo "Collection";
                                  } ?></td>                             
                              </tr>
                            <?php   $i++; } 
                          } else {
                              echo "No record Found";
                            } ?>
                          </tbody>
                        </table>
    </div>
    <!-- Last week---------------------------------------------------- -->
    <div id="lw3" class="tab-pane fade">
    <table class="table">
                           <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Amount</th> 
                              <th>Deduction</th> 
                              <th>Date (Day)</th> 
                              <th>Type</th> 

                            </thead>
                            <tbody>
                          <?php if($lpy->num_rows > 0){
                            $i=1;
                           while($rows=$lpy->fetch_assoc()){ ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $rows['staff_id']; ?></td>
                                  <td><?php echo $rows['fname']; ?></td>
                                  <td><?php echo $rows['username']; ?></td>
                                  <td><?php echo $rows['sex']; ?></td>
                                  <td><?php echo $rows['amt']; ?></td>                             
                                  <td><?php echo $rows['deduction']; ?></td>                             
                                  <td><?php $day=$rows['pay_date'];
                                           $d=date("D", strtotime($day));
                                            echo $day." (".$d.")";  ?></td>                             
                                  <td><?php if($rows['att_col']=='1') {
                                    echo "Attendance";
                                  }else{
                                    echo "Collection";
                                  } ?></td>                             
                              </tr>
                            <?php   $i++; } 
                          } else {
                              echo "No record Found";
                            } ?>
                          </tbody>
                        </table>
    </div>

    <!-- This month------------------------------------------ -->
    <div id="m3" class="tab-pane fade">
    <table class="table">
                           <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Amount</th> 
                              <th>Deduction</th> 
                              <th>Date (Day)</th> 
                              <th>Type</th> 

                            </thead>
                            <tbody>
                          <?php if($mpy->num_rows > 0){
                            $i=1;
                           while($rows=$mpy->fetch_assoc()){ ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $rows['staff_id']; ?></td>
                                  <td><?php echo $rows['fname']; ?></td>
                                  <td><?php echo $rows['username']; ?></td>
                                  <td><?php echo $rows['sex']; ?></td>
                                  <td><?php echo $rows['amt']; ?></td>                             
                                  <td><?php echo $rows['deduction']; ?></td>                             
                                  <td><?php $day=$rows['pay_date'];
                                           $d=date("D", strtotime($day));
                                            echo $day." (".$d.")";  ?></td>                             
                                  <td><?php if($rows['att_col']=='1') {
                                    echo "Attendance";
                                  }else{
                                    echo "Collection";
                                  } ?></td>                             
                              </tr>
                            <?php   $i++; } 
                          } else {
                              echo "No record Found";
                            } ?>
                          </tbody>
                        </table>    </div>


                        <!-- Last Month------------------------------ -->
    <div id="lm3" class="tab-pane fade">
    <table class="table">
                           <thead>
                              <th>#</th>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Amount</th> 
                              <th>Deduction</th> 
                              <th>Date (Day)</th> 
                              <th>Type</th> 

                            </thead>
                            <tbody>
                          <?php if($mpyB->num_rows > 0){
                            $i=1;
                           while($rows=$mpyB->fetch_assoc()){ ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $rows['staff_id']; ?></td>
                                  <td><?php echo $rows['fname']; ?></td>
                                  <td><?php echo $rows['username']; ?></td>
                                  <td><?php echo $rows['sex']; ?></td>
                                  <td><?php echo $rows['amt']; ?></td>                             
                                  <td><?php echo $rows['deduction']; ?></td>                             
                                  <td><?php $day=$rows['pay_date'];
                                           $d=date("D", strtotime($day));
                                            echo $day." (".$d.")";  ?></td>                             
                                  <td><?php if($rows['att_col']=='1') {
                                    echo "Attendance";
                                  }else{
                                    echo "Collection";
                                  } ?></td>                             
                              </tr>
                            <?php   $i++; } 
                          } else {
                              echo "No record Found";
                            } ?>
                          </tbody>
                        </table>
      
    </div>
  </div>
</div>

    </div>
  </div>
</div>
</div>                                                
            </div>
        </div>
    </section>
</body>

     <script src="assets/jquery-3.2.1.min.js"></script>
     <script src="assets/jquery.validate.min.js"></script>
     <script src="assets/additional-methods.min.js"></script>
     <script src="assets/sweetalert.min.js"></script>
     <script src="assets/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap.js"></script>
    <script src="assets/js/dataTables.responsive.js"></script>   
    <script class="reload" src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/Chart.min.js"></script>
    <script src="assets/chartScript.js"></script>
  <script src="assets/validation.js"></script>

    <script type="text/javascript">
       // Attendance implementation --------------------------------------------------------------------------------
  
     var dat=<?php echo json_encode($dat)?>;
      var day={
        attendance:[]
      };

      var leng=dat.length;

      for (var i=0; i<leng; i++){
              day.attendance.push(dat[i].dayCount);
      }
  var mychart = document.getElementById('mychart').getContext('2d');
  var  data = {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        datasets:[{
            label: 'Daily Employee Attendance',
            data: day.attendance,
            backgroundColor: "green",
            borderColor: "lightgreen",
            fill: false,
            pointRadius:5,
            backgroundColor: 'lightgreen'
        }]
     };
      var options = {
        title:{
            display : true,
            position: "top",
            text : "Daily Collections",
            fontSize: 18, 
            fontColor: "#333"
        },
        legend:{
            display: true,
            position: "bottom"
        }
      };
      var option2 = {
        title:{
            display : true,
            position: "top",
            text : "Daily Employee Attendance",
            fontSize: 18, 
            fontColor: "#333"
        },
        legend:{
            display: true,
            position: "bottom"
        }
      };
      // console.log(data);
      var chart=new Chart(mychart, {
        type:"line",
        data:data,
        options: option2
      });


       // Collection implementation --------------------------------------------------------------------------------
     var dat2=<?php echo json_encode($dat2)?>;
      var day={
        collection:[]
      };
      var leng=dat.length;

      for (var i=0; i<leng; i++){
        // console.log(data[i]);
              day.collection.push(dat[i].dayCount);
      }
  var mypy = document.getElementById('mypy').getContext('2d');
  var  data2 = {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday'],
        datasets:[{
            label: 'Daily Collections',
            data: day.collection,
            fill: false,
            pointRadius:5,
            backgroundColor: [
            'rgba(255,99,132,0.6)',
            'rgba(255,162,235,0.6)',
            'rgba(255,206,86,0.6)',
            'rgba(75,192,192,0.6)',
            'rgba(153,102,255,0.6)',
            'rgba(255,159,64,0.6)',
            'rgba(255,99,132,0.6)'
            ]
        }]
     };
      var chart=new Chart(mypy, {
        type:"pie",
        data:data2,
        options: options
      });


    </script>
<footer id="footer">
    <p>Copyright &copy; www.lasittea.com 2018</p>
</footer>

    
</html>