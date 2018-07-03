                   
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
               <a href="collection.php" class="list-group-item" id="col">
            <span class="glyphicon glyphicon-flag" aria-hidden="true"></span>Collections </a>
              <a href="staff.php" id="stuff2" class="list-group-item">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Employees </a>
                <a href="payment.php" id="payHist" class="list-group-item active main-color-bg">
                  <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Payment</a>
                  <a href="register.php" id="regc2" class="list-group-item">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Register Clerk </a>
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle list-group-item glyphicon glyphicon-user mainNav" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Profile
                       <span class="caret"></span></button>
                       <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a href="#"   id="con2">Contact Info</a></li>
                        <li><a href="#"  id="acc2">Account Info</a></li>
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
                        <h3 class="panel-title">Payment Information</h3>
                      </div>
                      <div class="panel-body">
                        <div id="scrolTable">
                          <div id="pay">
                          <ol class="breadcrumb">

                           <button class="btn btn-info pull-right" data-target="#var" data-toggle="modal" href="">Change Tool cost</button>   
                          </ol>
                         <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#cl" class="btn btn-default">Casual Labour </a></li>
                          <li><a data-toggle="tab" href="#tc" class="btn btn-warning">Tea Collection</a></li>
                        </ul>
                        <div class="tab-content">
                         <div id="cl" class="tab-pane fade in active">
                          <div class="row wel">
                            <div class="panel panel-default">
                              <div class="panel-heading clearfix">
                               <h3 class="panel-title"></h3>
                             </div>
                             <div class="panel-body">
<!-- -----------------------Casual labourers-------------------------------------------------------- -->
                           <button class="btn btn-default pull-right form-groups" style="margin-left: 20px;">Print</button> 
                              <table class="table table-striped table-hover">
                                <thead>
                                 <tr>
                                  <?php ?>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>RegNo</th>
                                  <th>Wage/day</th>
                                  <th>Days Present</th>  
                                  <th>Lost Tool</th>
                                  <th>Total Deduction</th>
                                  <th>Total Wage</th>

                                </tr>
                              </thead>
                              <tbody>
                               <?php if ($present->num_rows > 0) {
    // output data of each row
                                $i=1;
                                while($row = $present->fetch_assoc()) {
                                 ?>  <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $row["fname"]; ?></td>                        
                                  <td><?php echo $row["staff_id"]; ?></td>                   
                                  <td><?php echo $row["dailyWage"]; ?></td> 

                                  <td><?php
                                  $em=$row["staff_id"];
                                  $onePrey=$con->query("SELECT count(*) FROM `attendance` WHERE attendance.present='yes' AND staff_id=$em");
                                  $rw=$onePrey->fetch_assoc();
                                  $de=$con->query("SELECT sum(amt),sum(deduction),sum(bal) FROM pay RIGHT JOIN pay_staff ON pay.p_id=pay_staff.p_id WHERE pay_staff.staff_id=$em");
                                  $r=$de->fetch_assoc();
                                  echo $rw['count(*)']; ?> </td> 
                                  <td><?php echo $row['returned_tool'] ;?> </td> 
                                  <td><?php echo $r['sum(deduction)']; ?> </td> 
                                  <td><?php echo $r['sum(amt)']; ?></td>                                      
                                  </tr><?php
                                  $i++; }
                                } else {
                                  echo "0 results";
                                } 
                                $con->close();
                                ?> 
                              </tbody>
                            </table>

                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="tc" class="tab-pane fade">
                      <div class="row wel">
                        <div class="panel panel-default">
                          <div class="panel-heading clearfix">
                           <h3 class="panel-title"></h3>
                         </div>
                         <div class="panel-body">
 <!-- ------------------Daily Tea collection-------------------------------------------------- -->
                           <table class="table table-striped table-hover">
                            <thead>
                             <tr>
                              <?php ?>
                              <th>#</th>
                              <th>Name</th>
                              <th>RegNo</th>
                              <th>Collection(Kgs)</th> 
                              <th>Rate</th>
                              <th>Amount(Ksh)</th> 

                            </tr>
                          </thead>
                          <tbody>
                           <?php if ($col->num_rows > 0) {
                                // output data of each row
                            $i=1;
                            $row = $col->fetch_assoc();
                            while($row) {
                             ?>  <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row["fname"]; ?></td>                        
                              <td><?php echo $row["staff_id"]; ?></td>                   
                              <td><?php echo $row["weight"]; ?></td> 

                              <td><?php echo $row['rate']; ?> </td> 
                              <td><?php 
                              $amt=$row["weight"]*$row['rate'];
                              echo $amt;?> </td>                                                         
                              </tr><?php
                              $i++; }?>
                              <tr>
                              <td></td>
                              <td></td>                        
                              <td></td>                   
                              <td><?php 
                              $r = $sumWeight->fetch_assoc();
                              echo $r['weight'];?></td> 

                              <td> </td> 
                              <td><?php 
                             $tt=$r['weight']*$row['rate'];
                              echo $tt;?> </td>                                                         
                              </tr>
                         <?php   } else {
                              echo "0 results";
                            }
                            ?> 
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
      </div>                                                                 
    </div>
  </div>
</section>
</body>
<?php include 'inc/footer.php';  ?>
</html>