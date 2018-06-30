  
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
                      <button class="btn btn-default dropdown-toggle list-group-item glyphicon glyphicon-user mainNav" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Profile
                       <span class="caret"></span></button>
                       <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a href="contact.php"   id="con2">Contact Info</a></li>
                        <li><a href="account.php"  id="acc2">Account Info</a></li>
                      </ul>
                    </div>
                    <a href="stats.php" id="st" class="list-group-item"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Reports </a>
                    <a href="message.php" id="inbox" class="list-group-item main-color-bg">
                      <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Messages </a>
                    </div>

                    <div class="well">
                      <ul class="list-group">
                         <br> <span id="lg" class="glyphicon glyphicon-flag"></span> <a href="#">Trush</a><br><br>
                        <span class="glyphicon glyphicon-flag"></span><a href="">Specialization</a><br><br>
                        <span class="glyphicon glyphicon-flag"></span> <a href="">Managing Your Acc</a><br><br>
                        <span class="glyphicon glyphicon-flag"></span> <a href="">FAQ</a><br><br>
                        <span class="glyphicon glyphicon-flag"></span> <a href="">How to Earn more </a><br><br>
                        <span id="lg" class="glyphicon glyphicon-flag" aria-hidden="true"></span><a href="#">Change Password</a>
                      </ul>
                    </div>                                      
                  </div>
                  <div class="col-md-10" id="pan">
                    <div class="panel panel-default" id="pan2">
                      <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Messages at <?php echo date("Y-m-d h:i"); ?></h3>
                      </div> <!-- panel heading -->

                      <div class="panel-body"id="scrolTable">
                        <div class="container col-md-12">
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#inb" class="btn btn-default">Inbox <span class="badge"> 10</span></a></li>
                            <li><a data-toggle="tab" href="#unr" class="btn btn-warning">Unread 
                              <?php              
                              if($row = $mesNo->fetch_array()) {
                                if($row['count(*)']>0){ ?>
                                  <span class="badge">
                                    <?php echo $row['count(*)']; ?></span>
                                  <?php }else echo "0"; } ?>

                                </a></li>
                                <li><a data-toggle="tab" href="#sen" class="btn btn-success">Sent  <span class="badge"> 5</span></a></li>
                                <li><a data-toggle="tab" href="#comp" class="btn btn-danger">Compose </a></li>
                              </ul>
                              <!-- Inbox Message     .............................................................................. -->    
                              <div class="tab-content">
                                <div id="inb" class="tab-pane fade in active">
                                  <div class="row wel">
                                    <div class="panel panel-default">
                                      <div class="panel-heading clearfix">
                                        <h3 class="panel-title">All messages</h3>
                                      </div><!-- message head ->from -->
                                      <div class="panel-body">
                                        <table class="table table-striped table-hover">

                                          <tr>
                                            <th >#</th>
                                            <th >From</th>                   
                                            <th>subject</th>                   
                                            <th>Date</th>                   
                                            <th>Message</th> 
                                            <th>Status</th>
                                            <th>Details</th>     
                                          </tr>
                                          <?php
                                          if($inbox->num_rows > 0) {
                                            $i=1;
                                            while($row=$inbox->fetch_assoc()){ ?>
                                             <tr> 
                                              <td><?php echo $i; ?></td>                   
                                              <td><?php echo $row["dest_id"]; ?></td>                   
                                              <td><?php echo $row["subject"]; ?></td>                   
                                              <td><?php echo $row["sent_date"]; ?> </td>                   
                                              <td><?php echo $row["msg"]; ?></td>                   
                                              <td><b><?php if($row["Msg_read"]==1){
                                                echo "Unread";
                                              }else echo "Read"; ?></b></td>  
                                              <td><button class="btn btn-success">view</button>
                                                <button class="btn-danger">Remove</button>
                                              </td>             

                                            </tr>
                                            <?php
                                            $i++; }
                                          }else{
                                            echo "No Messages found";
                                          } ?> 
                                        </table><!-- data table -->
                                      </div><!-- inbox panel body -->
                                    </div><!-- inbox panel-->
                                  </div><!-- inbox row well -->

                                </div><!-- inbox tab pane -->

                                <!-- Unread Message     .............................................................................. -->
                                <div id="unr" class="tab-pane fade">
                                  <div class="row wel">
                                    <div class="panel panel-default">
                                      <div class="panel-heading clearfix">
                                       <h3 class="panel-title"></h3>
                                     </div><!-- message head ->from -->
                                     <div class="panel-body">
                                      <table class="table table-striped table-hover">

                                        <tr>
                                          <th >#</th>
                                          <th >From</th>                   
                                          <th>subject</th>                   
                                          <th>Date</th>                   
                                          <th>Message</th> 
                                          <th>Details</th>     
                                        </tr>
                                        <?php
                                        if($unRead->num_rows > 0) {
                                          $i=1;
                                          while($row=$unRead->fetch_assoc()){ ?>
                                           <tr> 
                                            <td><?php echo $i; ?></td>                   
                                            <td><?php echo $row["dest_id"]; ?></td>                   
                                            <td><?php echo $row["subject"]; ?></td>                   
                                            <td><?php echo $row["sent_date"]; ?> </td>                   
                                            <td><?php echo $row["msg"]; ?></td>                   
                                            <td><button class="btn btn-success">view</button>
                                              <button class="btn-danger">Remove</button>
                                            </td>             
                                          </tr>
                                          <?php
                                          $i++; }
                                        }else{
                                          echo "No Messages found";
                                        } ?> 
                                      </table><!-- data table --> 
                                    </div><!-- unread panel body -->
                                  </div><!-- unread panel-->
                                </div><!-- unread row well -->
                              </div><!-- unread tab pane -->

                              <!-- Sent Messages ------------------------------------------------------------------------------->
                              <div id="sen" class="tab-pane fade">
                                <div class="row wel">
                                  <div class="panel panel-default">
                                    <div class="panel-heading clearfix">
                                      <h3 class="panel-title"></h3>
                                    </div><!-- message head ->from -->
                                    <div class="panel-body"> 
                                      <table class="table table-striped table-hover">

                                        <tr>
                                          <th >#</th>
                                          <th >To</th>                   
                                          <th>subject</th>                   
                                          <th>Date</th>                   
                                          <th>Message</th> 
                                          <th>Details</th>     
                                        </tr>
                                        <?php
                                        if($outbox->num_rows > 0) {
                                          $i=1;
                                          while($row=$outbox->fetch_assoc()){ ?>
                                           <tr> 
                                            <td><?php echo $i; ?></td>                   
                                            <td><?php echo $row["fname"]; ?></td>                   
                                            <td><?php echo $row["subject"]; ?></td>                   
                                            <td><?php echo $row["sent_date"]; ?> </td>                   
                                            <td><?php echo $row["msg"]; ?></td>                   
                                            <td><button class="btn btn-success">view</button>
                                              <button class="btn-danger">Remove</button>
                                            </td>             
                                          </tr>
                                          <?php
                                          $i++; }
                                        }else{
                                          echo "No Messages found";
                                        } ?> 
                                      </table><!-- data table --> 
                                    </div><!-- sent panel body -->
                                  </div><!-- sent panel-->
                                </div><!-- sent row well -->
                              </div><!-- sent tab pane -->
                              <!-- Compossing Message     .............................................................................. -->
                              <div id="comp" class="tab-pane fade">
                                <div class="row wel">
                                  <div class="panel panel-default">
                                    <div class="panel-heading clearfix">
                                      <h3 class="panel-title">
                                        <div class="form-group">
                                          <label class="col-sm-1"">From</label>
                                          <div class="col-sm-4 "><label  data-toggle="tooltip" title="You want to send a message..!" style="color: Orange;"> <?php echo $_SESSION['username'];?> </label></div>
                                          <div class="col-sm-7"></div>
                                        </div>
                                      </h3>
                                    </div><!-- message head ->from -->
                                    <div class="panel-body">
                                      <form action="php/sendMessage.php" method='POST' class="form-horizontal">
                                        <div class="form-group"> 
                                          <label class="control-label col-sm-1">To</label>
                                          <div  class="col-sm-4">
                                            <select  name="to"  class="form-control">
                                              <?php do{?>
                                               <option  value= "<?php   echo $row['staff_id'];?>" selected> <?php   echo $row['username'];?></option><?php
                                             } while($row=$empA->fetch_assoc()); ?>
                                           </select> 
                                         </div>
                                         <div class="col-sm-4"></div>

                                       </div><!-- form group -->
                                       <div class="form-group">
                                        <label class="col-sm-1" for="inputSubject">Subject</label>
                                        <div class="col-sm-7"><input type="text" name="subject" class="form-control" id="inputSubject" placeholder="subject"></div>
                                        <div class="col-sm-4"></div>
                                      </div><!-- form group -->
                                      <div class="form-group">
                                        <label class="col-sm-1" for="inputBody">Message</label>
                                        <div class="col-sm-7">
                                          <textarea class="form-control"
                                          id="inputBody" rows="8" data-gramm="true" data-gramm_editor="true"placeholder="Type your message here ................................." name="message"></textarea> </div>
                                          <div class="col-sm-4"></div>         
                                        </div><!-- form group -->
                                        <div class="form-group">
                                          <label class="col-sm-7"> </label>
                                          <div class="col-sm-1"><button type="submit" name="submit" class="btn btn-info">Send Message</button></div>
                                          <div class="col-sm-4"></div>
                                        </div><!-- form group -->
                                      </form><!-- compose form -->
                                    </div><!-- compose panel body -->
                                  </div><!-- compose panel-->
                                </div><!-- compose row well -->
                              </div><!-- compose tab pane -->



                            </div><!-- container -->
                          </div>
                        </div><!-- scrol table -->


                      </div>    <!-- pan -->                                             
                    </div>
                  </div>
                </section>
              </body>
              <?php include 'inc/footer.php';  ?>
              </html>