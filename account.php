
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
                <a href="payment.php" id="payHist" class="list-group-item">
                  <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Payment</a>
                  <?php if($_SESSION['level']=='clerk'){  ?>
                  <a href="register.php" id="regc2" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Employee </a>
                    <a href="account.php" class="list-group-item main-color-bg">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Profile</a>
            <a href="message.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Message</a>
                    <?php } else if($_SESSION['level']=='admin'){?>
                    <a href="sms.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Send Bulk SMS</a>
                  <a href="register.php" id="regc2" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Register Clerk </a>
                    <a href="stats.php" id="st" class="list-group-item"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Reports </a>
                    <?php }?>
                    <a href="settings.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Settings</a>
                    </div>                                     
                </div>
                <div class="col-md-10" id="pan">
        <!-- Website Overview -->
        <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">My Account</h3>
              </div>
            <div class="panel-body inputStyl breadcrumb">
              <div class="form-group">
                  <label for="usr">Login: <b><?= $_SESSION['username']; ?></b></label>
                  <p>The account was created on <?= $allEmpRow['date_registered']; ?></p>
                    <div class="imgPos">
                      <?php if ($row['image'] == 0) { ?>
                          <img src="img/ava.png" class="img-circle hdimg">
                     <?php }else{ echo "<img src='empImgs/".$row['image']."'class='img-circle' id='hdimg'>"; }  ?>
                   </div>
                 <button class="btn btn-success btn-xs">Upload Image</button><br>
                      <div class="col-md-6 homePan">
                     <div class="panel panel-default">
                      <div class="panel-heading color-bg">
                        <h3 class="panel-title">Personal details</h3>   
                      </div>
                      <div class="panel-body"> 
                        <table class="table table-bordered">
                          <tbody>
                           <tr>
                            <?php
                            $staff=$_SESSION['staff_id'];
                             $stfInfo="SELECT *FROM staff where staff_id='$staff'";
                                    $stf=$con->query($stfInfo);
                                    $stfRow=$stf->fetch_assoc();
                            ?>
                            <td>First Name</td>
                            <td><?php echo $stfRow['fname']; ?></td>                              
                            </tr>
                            <tr>
                            <td>Second Name</td>
                            <td><?php echo $stfRow['lname']; ?></td>                              
                            </tr>
                            <tr>
                            <td>Username</td>
                            <td><?php echo $stfRow['username']; ?></td>                              
                            </tr>
                            <tr>
                            <td>DOB</td>
                            <td><?php echo $stfRow['birthday']; ?></td>                              
                            </tr>
                           <tr>
                            <td>Phone Number</td>
                            <td><?php echo $stfRow['phone_number']; ?></td>                              
                            </tr>
                            <tr>
                            <td>Date</td>
                            <td><?php echo $stfRow['date_registered']; ?></td>                              
                            </tr>
                            <tr>
                            <td>Location</td>
                            <td><?php echo $stfRow['location']; ?></td>                              
                            </tr>
                            <tr>
                            <td>Email</td>
                            <td><?php echo $stfRow['email']; ?></td>                              
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
               </div>   
  

               </div>                                                 
            </div>
        </div>
    </section>
</body>
<?php include 'inc/footer.php';  ?>
</html>