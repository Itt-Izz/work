                     
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
                     <a href=""><span class="glyphicon glyphicon-flag"></span><a href="">Inquery</a><br>
                      <a href=""></a><span id="lg" class="glyphicon glyphicon-flag" aria-hidden="true"></span><a href="#">Change Password</a>
                      </ul>
                    </div>                                      
              </div>
                  <div class="col-md-10" id="pan">
                    <div class="panel panel-default">
                      <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Lasit Tea</h3>   
                      </div>
                      <div class="panel-body"> 
                      <div id="scrolTable" style="background-color: #F8F8F8  ">
               <?php  
               $i='0710662656';
               $j=substr($i, 1, 9);
               // echo $j.'<br>';
               $t='+254'.$j;
               // echo $t;
                ?><div class="col-md-12">
                      <div class="col-md-6" id="homePan">
                     <div class="panel panel-default">
                      <div class="panel-heading color-bg">
                        <h3 class="panel-title">Personal details</h3>   
                      </div>
                      <div class="panel-body"> 
                        <table class="table table-bordered">
                          <tbody>
                           <tr>
                            <td>First Name</td>
                            <td>Isaac</td>                              
                            </tr>
                            <tr>
                            <td>Second Name</td>
                            <td>Thuo</td>                              
                            </tr>
                            <tr>
                            <td>DOB</td>
                            <td>5/6/2000</td>                              
                            </tr>
                           <tr>
                            <td>Phone Number</td>
                            <td>0710662656</td>                              
                            </tr>
                            <tr>
                            <td>Date</td>
                            <td>2/7/18</td>                              
                            </tr>
                            <tr>
                            <td>Location</td>
                            <td>Nakuru</td>                              
                            </tr>
                          </tbody>                          
                        </table>
                      </div>
                    </div>
                  </div>
                      <div class="col-md-6">
                     <div class="panel panel-default">
                      <div class="panel-heading color-bg">
                        <h3 class="panel-title">Payment details</h3>   
                      </div>
                      <div class="panel-body"> 
                        <table class="table table-bordered">
                          <tbody>
                           <tr>
                            <td>Last payment Id</td>
                            <td>5</td>                              
                            </tr>
                            <tr>
                            <td>Date</td>
                            <td>2/7/18</td>                              
                            </tr>
                            <tr>
                            <td>Amount</td>
                            <td>5000</td>                              
                            </tr>
                           <tr>
                            <td>By</td>
                            <td>Josy</td>                              
                            </tr>
                          </tbody>                          
                        </table>
                      </div>                        
                      </div>
                    </div>              
                </div>
                <div class="col-md-12">
                  <div class="col-md-4"></div>
                      <div class="col-md-4">
                     <div class="panel panel-default">
                      <div class="panel-heading color-bg">
                        <h3 class="panel-title">Totals</h3>   
                      </div>
                      <div class="panel-body"> 
                        <table class="table table-bordered">
                           <tbody>
                            <tr>
                            <td>Total Paid</td>
                            <td>22,000</td>                              
                            </tr>
                            <tr>
                            <td>Total Balance</td>
                            <td>2,050</td>                              
                            </tr>
                            <tr>
                            <td>Last day present</td>
                            <td>3 out of 7</td>                              
                            </tr>
                          </tbody>                          
                        </table>
                      </div>                        
                      </div>
                      <div class="col-md-4"></div>
                </div>
                      </div> 
                  </div>
                </div>
              </div>                                   
            </div> 
        </section>
        <!-- Modal -->
  <div class="modal fade" id="preCheck" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div id="showMess"></div>
        </div>
      </div>
    </div>
  </div> 
      </body>
      <?php include 'inc/footer.php';  ?>
      </html>