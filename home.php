                     
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
          <a href="home.php" class="list-group-item active main-color-bg">
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
                    <div class="panel panel-default">
                      <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Attendace Sheet</h3>   
                      </div>
                      <div class="panel-body">
                        <div id="scrolTable">
                          <div id="attTable">
                          <ol class="breadcrumb">
                            <div class="col-md-3"><a href="#" style="color: blue;" class="show">Present Today</a> </div>
                            <div class="col-md-6"> 
                              <h4 align="center" class="two">Attendance Register &nbsp;&nbsp;&nbsp;</h4> &nbsp;&nbsp;&nbsp;
                            </div>
                            <h5 align="right"> <em style="color: black;">Date: </em><b><?php echo " ".$date=date("D d, F Y");?></b></h5>
                            <div class="col-md-3">  </div>
                          </ol>
                           <table class="table" id="mytable2">
                            <thead>
                              <th>RegNo</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Gender</th>
                              <th>Present</th>
                              <th>Tool</th>
                              <th>Approve</th>
                            </thead>
                            <tbody>

                              <?php 
                              while($row=$employ->fetch_array()){
                                // $staff=$row['staff_id']; ?>
                                <tr>
                          <form method="POST" action="php/attendance.php" id="<?php echo 'form-'. $row['staff_id'];?>">
                                  <td><?php echo $row['staff_id']; ?></td>
                                  <td><?php echo $row['fname']; ?></td>
                                  <td><?php echo $row['username']; ?></td>
                                  <td><?php echo $row['sex']; ?></td>
                                  <td>
                                    <div class="checkbox">
                                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="Yes" style="height: 25px;width: 25px;" name="pre"></label>
                                    </div>
                                       <input type="hidden" name="staf" value="<?= $row['staff_id']?>">
                                       <input type="hidden" name="nam" value="<?= $row['fname']?>">
                                  </td>
                                  <td>
                                    <select  name="tool"  class="form-control">
                                      <option value=" ">Select tool</option>
                                     <?php  for($i=0;$i<=count($rw[0]);$i++) { ?>
                                      <option  value="<?php   echo $rw[$i][0]; ?>"> <?php   echo $rw[$i][1]; ?></option>
                                    <?php } ?>
                                  </select>
                                </td>
                                <td><button type="submit" clas="btn" name="submit" value="save" style="color: green;">Save</button></td>
                               </form>
                              </tr>
                            <?php    }  ?>
                          </tbody>
                        </table>
                      <div class="col-md-5"></div>
                      <button class="btn btn-success col-md-2" id="button-a">Save All</button>

                    </div>
              <div id="preTable">
      <button id="back3" class="btn btn-info col-md-1 pull-right bac">Back<b style="color: black;">-></b></button>
                <table class="table">
                  <thead>
                    <th>Name</th>
                    <th>Name</th>
                    <th>Name</th>
                    <th>Name</th>
                    <th>Name</th>
                  </thead>
                    <tr>
                      <td>present</td>
                      <td>present</td>
                      <td>present</td>
                      <td>present</td>
                      <td>present</td>
                    </tr>
                </table>
              </div>
                      <div class="col-md-5"></div>
                    </div>
                  </div>
                </div>
              </div>                                   
            </div>                                                                 
          </div>
        </section>
        <?php 

        ?>
      </body>
      <?php include 'inc/footer.php';  ?>
      </html>