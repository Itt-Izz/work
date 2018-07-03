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
                <a href="payment.php" id="payHist" class="list-group-item">
                  <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Payment</a>
                  <a href="register.php" id="regc2" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Register Clerk </a>
                      <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle list-group-item glyphicon glyphicon-user" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Profile
                         <span class="caret"></span></button>
                         <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                          <li><a href="contact.php"  id="con2">Contact Info</a></li>
                          <li><a href="account.php"  id="acc2">Account Info</a></li>
                        </ul>
                      </div>
                      <a href="stats.php" id="st" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Reports </a>
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
    <h3 class="panel-title">Statistics</h3>

  </div>
  <div class="panel-body">
    <div id="scrolTable">
      <?php
      $quer=sprintf("SELECT t_id, name, namba, cost FROM tools ORDER BY t_id");
       $data=array();
       $rw=$con->query($quer);
       foreach ($rw as $row) {
         $data[]=$row;
       }
//Print in json
       print json_encode($data); ?>

       <div class="col-md-12">
         <div class="col-md-3" style="height: 150px; background-color: lightgrey;">
           <h4>Present Today</h4>
           <div class="col-md-4">
             <h1>203</h1>
           </div>
           <div class="col-md-8">
          <p> <h5>Male:</h5><h6>153</h6></p>
           <p><h5>Female</h5><h6>50</h6></p>
           </div>
           
         </div>
         <div class="col-md-1""></div>
         <div class="col-md-3" style="height: 150px; background-color: lightgreen;">
            <h4>Total Salary this Month</h4>
           <div class="col-md-5">
             <h1>200k</h1>
           </div>
           <div class="col-md-7">
          <p> <h5>Tea collection:</h5><h6>150k</h6></p>
           <p><h5>Other:</h5><h6>50k</h6></p>
           </div>
         </div>
         <div class="col-md-1"></div>
         <div class="col-md-3" style="height: 150px; background-color: #cbcbcb;">
            <h4>No of tools lost</h4>
           <div class="col-md-4">
             <h1>2</h1>
           </div>
           <div class="col-md-8">
          <p> <h5>Cost</h5><h6>650</h6></p>
           </div>
         </div>
         <div class="col-md-1"></div>
       </div>
       <div class="col-md-12">
            <div class="container col-md-6">
                <canvas id="mychart"></canvas>
                <h6 align="center">Total daily employee attendance </h6>
            </div>
            <div class="container col-md-6">
                <canvas id="mypie"></canvas>
                <h6 align="center">Total monthly payments</h6>
            </div> 
         
       </div>
            <div class="col-md-12">
                <canvas id="chartMy"></canvas>
                <h6 align="center">Total monthly payments</h6>
            </div> 

       <div class="col-md-12">
         <h3 align="center" class="breadcrumb">Employee Attendance</h3>
    <table class="table table-striped table-bordered table-hover" id="mytable4">
       <thead> <tr>
        <th>#</th>
        <th>Name</th>                       
        <th>Sex</th>                         
        <th>Wage/Day</th>                  
        <th>RegNo</th>                   
        <th>Days Present</th>                   
        <th>Amount</th> 
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
          <td><?php echo $row["sex"]; ?></td>                        
          <td><?php echo $row["dailyWage"]; ?></td>                   
          <td><?php echo $row["staff_id"]; ?></td>                      
          <td><?php
   $em=$row["staff_id"];
 $onePresenty="SELECT count(*) FROM `attendance` LEFT JOIN staff on staff.staff_id=attendance.staff_id WHERE attendance.present='yes' AND staff.staff_id=$em";
         $onePrey=$con->query($onePresenty);
           $rw=$onePrey->fetch_assoc();
           echo $rw['count(*)']; ?>
            </td> 
          <td>
            <?php $am=$row["dailyWage"]*$rw["count(*)"];
                     echo $am;
            ?>                
          </tr><?php
          $i++; }
        } else {
          echo "0 results";
        }
        $con->close();
        ?> 

<!--
 SELECT staff.fname, staff.staff_id , staff.sex, attendance.date tools.name FROM staff LEFT JOIN attendance ON attendance.staff_id=staff.staff_id INNER JOIN tools ON attendance.t_id =tools.t_id
         -->



<!-- Payment Computation per ID with total amount, deduction and balance
  SELECT pay.p_id, pay.pay_date, SUM(amt) as Total, SUM(deduction) as Deduction, SUM(bal) AS Balance FROM pay_staff INNER JOIN pay WHERE pay.p_id=pay_staff.p_id -->

      </tbody>            
    </table>
         
       </div>
   
    </div>
               </div>                                                 
            </div>
        </div>
    </section>
</body>
<?php include 'inc/footer.php';  ?>
</html>