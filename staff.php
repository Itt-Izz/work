                     
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
              <a href="staff.php" id="stuff2" class="list-group-item main-color-bg"><img src="img/worker.png" class="hd3">  Employees </a>
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
      </div><!-- close aside-->
                    <div class="col-md-10" id="pan">
                      <div class="panel panel-default">
  <div class="panel-heading main-color-bg">
    <h3 class="panel-title">List of Employees</h3>
  </div>
  <div class="panel-body">
    <div id="scrolTable">
      <ol class="breadcrumb">
                <h5 align="left" class="two">TOTAL EMPLOYEES: &nbsp;&nbsp;&nbsp;
                    <?php while ($rows = $run2->fetch_array()) {
                        echo $rows['count(*)'];
                        echo '&nbsp;&nbsp;';
                        echo '||';
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    }
                    while($rowsb = $run3->fetch_array()) {
                        echo $rowsb['sex'];
                        echo ':';
                        echo '&nbsp;&nbsp;';
                      ?><button class="btn btn-success"><?php  echo $rowsb['count(*)'];?></button><?php
                        echo '&nbsp;&nbsp;';
                        echo '||'; 
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    }    ?>
                </h5>
                <a href="register.php">Add New</a>
         </ol><br>
       <div id="view">
        <?php if ($_SESSION['level']=='admin') { ?>
       <button class="btn btn-default pull-right form-groups" id="printEmp" style="margin: 10px;">Print All Employees</button>
       <?php } ?> 
      <table class="table table-striped table-bordered table-hover" id="mytable3">
       <thead> <tr>
        <th>#</th>
        <th>Name</th>                   
        <th>age</th>                   
        <th>Gender</th>                   
        <th>Id No</th>                   
        <th>Phone No</th> 
        <th>Location</th>
        <th>Date Registered</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($employe->num_rows > 0) {
    // output data of each row
        $i=1;
        while($row = $employe->fetch_assoc()) {?>
          
          <tr class="employeeDetails">
            <form method="POST" action="staff.php">
          <td><?php echo $i; ?></td>
          <td><?php echo $row["fname"]; ?></td> 
          <td><?php
            $date=date("Y");
             $age=$date-$row["year(birthday)"];
           echo $age; ?></td>                   
          <td><?php echo $row["sex"]; ?></td>                
          <td><?php echo $row["id_number"]; ?></td>                   
          <td><?php echo $row["phone_number"]; ?></td> 
          <td><?php echo $row["location"]; ?></td> 
          <td><?php echo $row["date_registered"]; ?></td>
           </form> 
              <input type="hidden" class="fname" value="<?= $row['fname']?>">                                
              <input type="hidden" class="staff_id" value="<?= $row['staff_id']?>" >                               
          </tr><?php
          $i++; }
        } else {
          echo "0 results";
        }  ?>
      </tbody>
    </table>
  </div>
  </div>
</div>
</div>                                     
                    </div>
                  </div>
                </div>
              </section>
<!-- Modal -->
<div class="modal fade" id="emp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div id="getMsg">
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
 </body>
            <?php include 'inc/footer.php'; ?>
        </html>