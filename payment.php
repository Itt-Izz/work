                   
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
                <a href="payment.php" id="payHist" class="list-group-item active main-color-bg">
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
                        <br> <span class="glyphicon glyphicon-flag"></span> <a href="stats.php">System Update</a><br><br>
                        <span class="glyphicon glyphicon-flag"></span><a href="">Specialization</a><br><br>
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
                          <?php if($_SESSION['level']=='clerk' || $_SESSION['level']=='admin'){?>
                          <ol class="breadcrumb">
                          <label>Farm Casual Labour </label> 
                           <button class="btn btn-info pull-right" data-target="#var" data-toggle="modal" href="">Change Tool cost</button>
                          </ol>                       
<!-- -----------------------Casual labourers-------------------------------------------------------- -->
                           <button class="btn btn-default pull-right form-groups" id="printPay" style="margin: 10px;">Print</button> 

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
                            <br><br><br><br><br>



                          <?php if($_SESSION['level']=='clerk' || $_SESSION['level']=='admin'){?>
 <!-- ------------------Daily Tea collection-------------------------------------------------- -->
                        <ol class="breadcrumb">
                          <label>Tea Collection per Labourer</label> <br>
                          <label>Cost per unit is: 200</label> 

                          </ol> 
                           <button class="btn btn-default pull-right form-groups" id="printCol" style="margin-left: 20px;">Print</button> 
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