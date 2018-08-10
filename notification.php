  
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
                    <a href="stats.php" id="st" class="list-group-item"><img src="img/reports.png" class="hd3"> Reports </a>
                    <?php } if($_SESSION['level']=='admin'){  ?>
                    <a href="settings.php" class="list-group-item"><img src="img/settings.png" class="hd3"> Settings</a>
                    <?php }?>
                   <a href="notification.php" class="list-group-item main-color-bg"><img src="img/notification.png" class="hd3" align="center"> Notification</a>
                   <a href="changePassword.php" class="list-group-item"><img src="img/pass.png" class="hd3" align="center"> Password</a>
                    </div>                                      
      </div>
                  <div class="col-md-10" id="pan">
                    <div class="panel panel-default" id="pan2">
                      <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Feedback</h3>
                      </div> <!-- panel heading -->

                      <div class="panel-body"id="scrolTable">
       <!-- Notification     .............................................................................. -->    
                                  <table class="table table-striped table-hover">
                                          <tr>
                                            <th >#</th>
                                            <th >From</th>                   
                                            <th>subject</th>                   
                                            <th>Date</th>      
                                            <th>Delete</th>     
                                          </tr>
                                          <?php
                                          if($inbox->num_rows > 0) {
                                            $i=1;
                                            while($row=$inbox->fetch_assoc()){ ?>
                                             <tr> 
                                              <td><?php echo $i; ?></td>                   
                                              <td><?php echo $row["fname"]; ?></td>                   
                                              <td><?php echo $row["subject"]; ?></td> 
                                              <td><?php echo $row["sent_date"]; ?> </td> 
                                              <td><button><img src="img/delete.png" class='hd del'> </button></td>                
                                      <input type="hidden" class="m_id" value="<?= $row['m_id']?>" >                          
                                      <input type="hidden" class="name" value="<?= $row['fname']?>" >                          
                                      <input type="hidden" class="subject" value="<?= $row['subject']?>" >                        
                                      <input type="hidden" class="date" value="<?= $row['sent_date']?>" >                      
                                      <input type="hidden" class="message" value="<?= $row['msg']?>" >                             
                                            </tr>
                                            <?php
                                            $i++; }
                                          }else{
                                            echo "No Messages found";
                                          } ?> 
                                        </table>   <!-- pan -->                                             
                    </div>
                  </div>
                </div>
              </div>

                </section>
              </body>
              <?php include 'inc/footer.php';  ?>
              </html>