  
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
          <a href="home.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Home </a>
            <?php if ($_SESSION['level']=='clerk') { ?>
          <a href="attendance.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Attendance</a>
            <a href="collection.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Collection</a>
           <?php }  if($_SESSION['level']!=='staff'){ ?>
              <a href="staff.php" id="stuff2" class="list-group-item">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Employees </a>
                    <?php }?>
                <a href="payment.php" id="payHist" class="list-group-item">
                  <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Payment</a>
                  <?php if($_SESSION['level']=='clerk'){  ?>
                  <a href="register.php" id="regc2" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Employee </a>
            <a href="message.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Message</a>
                    <?php } else if($_SESSION['level']=='admin'){?>
                    <a href="sms.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Send Bulk SMS</a>
                  <a href="register.php" id="regc2" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Register Clerk </a>
                    <a href="stats.php" id="st" class="list-group-item"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Reports </a>
                    <?php } if($_SESSION['level']=='admin'){  ?>
                    <a href="settings.php" class="list-group-item">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Settings</a>
                    <?php }?>

                    </div> 
                    <div class="well">
                      <ul class="list-group">
      <a class="list-group-item" href="changePassword.php"><span id="lg" class="glyphicon glyphicon-flag" aria-hidden="true"></span>Change Password </a>
                      </ul>
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