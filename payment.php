                   
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
                 <a href="payment.php" id="payHist" class="list-group-item main-color-bg">
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
                    <!-- Latest Users -->
                    <div class="panel panel-default">
                      <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Payment Information</h3>
                      </div>
                      <div class="panel-body">
                        <div id="scrolTable"> 
                          <div id="singlePay">
                        <ol class="breadcrumb"> 
                        <button class="btn btn-default" id="allC">All Collections</button>                 
                          <h4><?php  echo "Days worked from: <em>".$threeDaysBY.'</em> to <em>'.$today.'</em><br>'; ?></h4>
                        </ol>                
                              <table class="table table-striped table-hover pay" >
                                <thead>
                                 <tr>
                                  <?php ?>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>RegNo</th>
                                  <th>Wage/day</th>
                                  <th>Days Present</th>  
                                  <th>Tool</th>
                                  <th>Total Deduction</th>
                                  <th>Total Wage</th>
                                  <th>Status</th>
                                  <th>Pay</th>
                                </tr>
                              </thead>
                              <tbody><br>
                               <?php 
                               if ($empPayThisweek->num_rows > 0) {
    // output data of each row
                                $i=1;
                                while($row = $empPayThisweek->fetch_assoc()) {
                                   $r="SELECT count(attendance.staff_id) as days FROM attendance where staff_id=".$row['staff_id']." AND  date BETWEEN '$frm' AND '$todate'";
                                   $day=$con->query($r);
                                   $days=$day->fetch_assoc();
                                   $pay="SELECT employee from wage left join attendance on attendance.w_id=wage.w_id";
                                   $py=$con->query($pay);
                                   $rw=$py->fetch_assoc();
                                   if ($days['days']>0) {
                                 ?>  <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $row["fname"]; ?></td>                        
                                  <td><?php echo $row["staff_id"]; ?></td>                   
                                  <td><?php echo $rw["employee"]; ?></td> 
                                  <input type="hidden" class="staf" value="<?= $row['staff_id']?>">
                                  <td><?php                                
                                  echo $days['days'];?> </td> 
                                  <td><?php if ($row["name"]=='') {
                                    echo 'None';
                                  } echo $row["name"] ;?> </td> 
                                  <td><?php if ($row["name"]=='') {
                                    echo 0;
                                  }
                                   echo $row['cost']; ?> </td> 
                                  <input type="hidden" class="ded" value="<?= $row['cost']?>">
                                  <td><?php
                                    $tt=$rw["employee"]*$days['days']-$row['cost'];
                                   echo $tt; ?></td> 
                                  <input type="hidden" class="total" value="<?= $tt?>">
                                   <td>
                                   <?php 
                                   if ($row['status']==0) { ?>
                                     <label style="color: #660000;">Pending</label>
                                  <?php } else { ?>
                                     <label style="color: green;">Paid</label>
                                 <?php } ?>
                                   </td>                      
                                   <?php if ($row['status']==0) { ?>
                                 <td><button class="btn btn-success payWage">Pay</button></td> 
                                  <?php } else { ?>
                                     <td><label style="color: green;">Done</label></td>
                                 <?php } ?>                     
                                  </tr><?php
}
                                  $i++; }
                                } else {
                                  echo "0 results";
                                } 
                                ?> 
                              </tbody>
                            </table>

                        <ol class="breadcrumb">                  
                          <h4><?php  echo "Collections Taken from: <em>".$dayBf.'</em> to <em>'.$today.'</em><br>'; echo $frm; ?></h4>
                        </ol>                
                              <table class="table table-striped table-hover pay" >
                                <thead>
                                 <tr>
                                  <th>RegNo</th>
                                  <th>Name</th>
                                  <th>Total</th>
                                  <th>Amount</th>
                                  <th>Status</th>
                                  <th>Pay</th>
                                </tr>
                              </thead>
                              <tbody>
                               <?php 
                             while($row=$colWk->fetch_assoc()){ 
                              $c=$row['col_date'];
                             $day=date('D',strtotime($c));
                              ?>
                              <tr>
                                  <td><?php echo $row['staff_id']; ?></td>
                                  <td><?php echo $row['fname']; ?></td>  
                                  <td><?php echo $row['total']; ?></td> 
                                  <input type="hidden" class="staff" value="<?= $row['staff_id']?>">
                                  <td><?php
                                  $amt= $row['total']*10; 
                                    echo $amt;
                                  ?></td> 
                                  <input type="hidden" class="amount" value="<?= $amt?>">
                                  <td>
                                   <?php 
                                   if ($row['status']==0) { ?>
                                     <label style="color: #660000;">Pending</label>
                                  <?php } else { ?>
                                     <label style="color: green;">Paid</label>
                                 <?php } ?>
                                   </td>                      
                                   <?php if ($row['status']==0) { ?>
                                 <td><button class="btn btn-success payCol">Pay</button></td> 
                                  <?php } else { ?>
                                     <td><label style="color: green;">Done</label></td>
                                 <?php } ?>                       
                                  </tr>
                            <?php    }  ?>
                              </tbody>
                            </table>
                            </div>
                          <div id="pay">
                          <?php if($_SESSION['level']=='clerk' || $_SESSION['level']=='admin'){?>
                          <ol class="breadcrumb">
                        <button class="btn btn-default" id="allS">Back</button>                 
                         <h4><label>Farm Labour </label> </h4>
                           <button class="btn btn-default pull-right form-groups" id="printPay" style="margin: 10px;">Print</button> 
                          <!--  <button class="btn btn-info pull-right" data-target="#var" data-toggle="modal" href="">Change Tool cost</button> -->
                          </ol>                       
<!-- -----------------------Casual labourers-------------------------------------------------------- -->

                              <table class="table table-striped table-hover pay" id='print_content' >
                                <thead>
                                 <tr>
                                  <?php ?>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>RegNo</th>
                                  <th>Wage/day</th>
                                  <th>Days Present</th>  
                                  <th>Tool</th>
                                  <th>Total Deduction</th>
                                  <th>Total Wage</th>
                                </tr>
                              </thead>
                              <tbody>
                               <?php if ($pay->num_rows > 0) {
    // output data of each row
                                $i=1;
                                while($row = $pay->fetch_assoc()) {
                                   $r="SELECT count(attendance.staff_id) as days FROM attendance where staff_id=".$row['staff_id']."";
                                   $day=$con->query($r);
                                   $days=$day->fetch_assoc();
                                   if ($days['days']>0) {
                                 ?>  <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $row["fname"]; ?></td>                        
                                  <td><?php echo $row["staff_id"]; ?></td>                   
                                  <td><?php echo $row["dailyWage"]; ?></td> 
                                  
                                  <td><?php                                
                                  echo $days['days'];?> </td> 
                                  <td><?php if ($row["name"]=='') {
                                    echo 'None';
                                  } echo $row["name"] ;?> </td> 
                                  <td><?php if ($row["name"]=='') {
                                    echo 0;
                                  }
                                   echo $row['cost']; ?> </td> 
                                  <td><?php
                                    $tt=$row["dailyWage"]*$days['days']-$row['cost'];
                                   echo $tt; ?></td>                       
                                  </tr><?php
}
                                  $i++; }
                                } else {
                                  echo "0 results";
                                } 
                                ?> 
                              </tbody>
                            </table>
                            <?php    }  ?>
                            <br><br>

                          <?php if($_SESSION['level']=='clerk' || $_SESSION['level']=='admin'){?>
 <!-- ------------------Daily Tea collection-------------------------------------------------- -->
                        <ol class="breadcrumb">
                         <h3> <label align="center" >Tea Collection per Labourer</label></h3>
                           <button class="btn btn-default pull-right form-groups" id="printCol" style="margin-left: 20px;">Print</button> 
                          </ol> 
                           <table class="table table-striped table-hover" id="print_collection">
                            <thead>
                             <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>RegNo</th>
                              <th>Collection(Kgs)</th> 
                              <th>Rate</th>
                              <th>Amount(Ksh)</th> 
                              <th>Date </th> 

                            </tr>
                          </thead>
                          <tbody>
                           <?php if ($col->num_rows > 0) {
                                // output data of each row
                            $i=1;
                            $r=0;
                            $j=0;
                            while($rows= $col->fetch_assoc()) {
                             ?>  <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $rows["fname"]; ?></td>                        
                              <td><?php echo $rows["staff_id"]; ?></td>                   
                              <td><?php echo $rows["weight"]; ?></td> 
                              <td><?php echo $rows['rate']; ?> </td> 
                              <td><?php 
                              $amt=$rows["weight"]*$rows['rate'];
                              echo $amt;?> </td> 
                              <td><?php echo $rows['col_date']; ?> </td>                                                         
                              </tr><?php
                              $i++;
                              $r=$r+$rows["weight"];
                              $j=$j+$amt;
                               }?>
                         <?php   } else {
                              echo "0 results";
                            }
                            ?> 
                            <tr>
                              <td><b>Total</b></td>
                              <td></td>
                              <td></td>
                              <td><b><?php echo $r; ?></b></td>
                              <td></td>
                              <td><b><?php echo $j; ?></b></td>
                              <td></td>
                            </tr>
                          </tbody>
                        </table>
                            <?php    }  ?>

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

<?php include 'inc/footer.php';  ?>

</html>