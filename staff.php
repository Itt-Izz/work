                     
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
        <div class="col-md-2"><!-- Open aside-->
          <div class="list-group ">
            <a href="home.php" class="list-group-item">
              <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Home </a>
               <a href="collection.php" class="list-group-item" id="col">
            <span class="glyphicon glyphicon-flag" aria-hidden="true"></span>Collections </a>
              <a href="staff.php" id="stuff2" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Employees </a>
                <a href="payment.php" id="payHist" class="list-group-item">
                  <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Payment</a>
                  <a href="register.php" id="regc2" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                           <?php 
                           if($_SESSION['level']=='admin'){
                          echo "Register Clerk";
                           }else{
                            echo "Add Employee";
                           }?></a>
                      <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle list-group-item glyphicon glyphicon-user mainNav" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Profile
                         <span class="caret"></span></button>
                         <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                          <li><a href="#"   id="con2">Contact Info</a></li>
                          <li><a href="#"  id="acc2">Account Info</a></li>
                        </ul>
                      </div>
                      <?php 
                           if($_SESSION['level']=='admin'){?>
                      <a href="stats.php" id="st" class="list-group-item"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Reports </a>
                          <?php }?>
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
                    </div> <!-- close aside-->
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
       <button class="btn btn-default pull-right form-groups" id="printEmp" style="margin: 10px;">Print All Employees</button> 
      <table class="table table-striped table-bordered table-hover" id="mytable3">
       <thead> <tr>
        <th>#</th>
        <th>Name</th>                   
        <th>age</th>                   
        <th>Gender</th>                   
        <th>Id No</th>                   
        <th>Phone No</th> 
        <th>Wage</th>
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
          <td><?php echo $row["dailyWage"]; ?></td>
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
      <div class="modal-body" id="getMsg">
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