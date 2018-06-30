                     
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
         </ol><br>
       <div id="view">
      <table class="table table-striped table-bordered table-hover" id="mytable3">
       <thead> <tr>
        <th>#</th>
        <th>Name</th>                   
        <th>age</th>                   
        <th>Position</th>                   
        <th>Sex</th>                   
        <th>Id No</th>                   
        <th>Phone No</th> 
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($employe->num_rows > 0) {
    // output data of each row
        $i=1;
        while($row = $employe->fetch_assoc()) {
         ?>  <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $row["fname"]; ?></td>                   
          <td><?php
            $date=date("Y");
             $age=$date-$row["year(birthday)"];
           echo $age; ?></td>                   
          <td><?php echo $row["position"]; ?></td>                   
          <td><?php echo $row["sex"]; ?></td>                   
          <td><?php echo $row["id_number"]; ?></td>                   
          <td><?php echo $row["phone_number"]; ?></td> 
          <td>
            <a href="#" class="show" name="view" data-toggle="tooltip" title="View more..!">&nbsp;&nbsp;&nbsp;&nbsp;View</a>&nbsp;&nbsp;
            <!-- <button class="btn-danger btn-xs" name="remove" data-toggle="tooltip" title="Delete this employe...!"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button> -->
          </td>                
          </tr><?php
          $i++; }
        } else {
          echo "0 results";
        }
        // $con->close();
        ?> 
      </tbody>
      
    </table>
  </div>
      <div id="more">
        <div class="col-md-4"></div>
      <h4 class="col-md-6">Information about </h4> 
      <button class="btn btn-info col-md-1 pull-right bac">Back<b style="color: black;"></b></button>       
    <table class="table">
    <thead>
      <th>Name</th>
      <th>Name</th>
      <th>Name</th>
      <th>Name</th>
      <th>Name</th>
    </thead>
    <tbody>
      <tr>
        <td>try</td>
        <td>try</td>
        <td>try</td>
        <td>try</td>
        <td>try</td>
      </tr>
      
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
     
            </body>
            <?php include 'inc/footer.php';  ?>
            </html>