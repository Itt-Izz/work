  
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
                  <a href="message.php" id="inbox" class="list-group-item main-color-bg">
                      <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Messages </a>
                    </div>

                    <div class="well">
                      <ul class="list-group">
                     <a href=""><span class="glyphicon glyphicon-flag"></span><a href="">Inquery</a><br>
                      <a href=""></a><span id="lg" class="glyphicon glyphicon-flag" aria-hidden="true"></span><a href="#">Change Password</a>
                      </ul>
                    </div>                                       
                  </div>
                  <div class="col-md-10" id="pan">
                    <div class="panel panel-default" id="pan2">
                      <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Message</h3>
                      </div> <!-- panel heading -->

                      <div class="panel-body"id="scrolTable">

                        <div class="container col-md-12">
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#inb">Inbox</a></li>
                                <li><a data-toggle="tab" href="#sen" >Sent</a></li>
                                <li><a data-toggle="tab" href="#comp">Compose </a></li>
                              </ul>
       <!-- Inbox Message     .............................................................................. -->    
                              <div class="tab-content">
                                <div id="inb" class="tab-pane fade in active">
                                  <div class="row wel">
                                    <div class="panel panel-default">
                                      <div class="panel-heading clearfix">
                                      </div><!-- message head ->from -->
                                      <div class="panel-body" id="inBody">
                                        <table class="table table-striped table-hover">

                                          <tr>
                                            <th >#</th>
                                            <th >From</th>                   
                                            <th>subject</th>                   
                                            <th>Date</th>  
                                            <th>Status</th>     
                                            <th>Delete</th>     
                                          </tr>
                                          <?php
                                          if($inbox2->num_rows > 0) {
                                            $i=1;
                                            while($row=$inbox2->fetch_assoc()){ ?>
                                             <tr class="viewMessage" > 
                                              <td><?php echo $i; ?></td>                   
                                              <td><?php echo $row["fname"]; ?></td>                   
                                              <td><?php echo $row["subject"]; ?></td> 
                                              <td><?php echo $row["sent_date"]; ?> </td>                   
                                              <td><?php if ($row["Msg_read"]>0) {
                                                       echo "Read";
                                                     }else{
                                                      echo "<b> Unread </b>";
                                                     } ?> </td> 
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
                                        </table>
                                      </div>
                                      <div class="panel-body" id="mes">
                                              <div class="col-md-12">
                                                   <div class="col-sm-2">
                                                <button class="btn btn-info pull-left bac">Back</button></div>
                                               <div class="col-sm-8 form-group">
                                                     <label>Subject:</label>
                                                     <input class="form-control" id="sub1" type="" value="" disabled>
                                                     <label>Message:</label>
                                          <textarea class="form-control" rows="5" id="mes1" value="" disabled></textarea>
                                                      <label>From:</label>
                                            <input class="form-control" id="name1" type="" value="" disabled>
                                              <label>Date:</label>
                                            <input class="form-control" id="date1" type="" value="" disabled><br>
                                                          
                                                          <a href="#" id="rep">Reply</a>
                                                          <button class="btn btn-danger pull-right">Delete</button><br>
                                                   </div>
                                                   <div class="col-sm-2"></div>                          
                                                            </div>
                                       
                                      </div>
                                      <div class="panel-body" id="repMes">
                                      <form method='POST' class="form-horizontal" name="smsForm"> 
                                      <button class="btn bac">back</button>                               
                                       <div class="form-group"> 
                                          <label class="control-label">Reply this message</label>
                                          <label class="control-label col-sm-1">To</label>
                                          <div  class="col-sm-4"><input type="text" id="to" name="to" value="" class="form-control"  placeholder="subject" disabled></div>
                                     </div>
                                     <div class="form-group">
                                        <label class="col-sm-1" for="inputSubject">Subject</label>
                                        <div class="col-sm-7"><input type="text" name="subject" class="form-control"  placeholder="subject" required></div>
                                     </div>
                                      <div class="form-group">
                                          <div class="col-sm-8">
                                        <label for="inputBody">Message</label>
                                          <textarea class="form-control"
                                          id="inputBody" rows="8" data-gramm="true" data-gramm_editor="true"placeholder="Type your message here ................................." name="message" required></textarea><br>
                           <button  name="submit" class="btn btn-info pull-right" id="sendOne">Send Message</button>
                         </div>
                                          <div class="col-sm-4"></div>
                                        </div>
                                   </form>
                                        
                                      </div>
                                    </div>
                                  </div>
                                </div>


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
                                          <th>Remove</th>     
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
                                              <td><button><img src="img/delete.png" class='hd del'> </button></td>           
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
                              </div>
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
                                      
                                      <form method='POST' class="form-horizontal" name="smsForm">
                                        
                                       <div class="form-group">
                                        <label class="col-sm-1" for="inputSubject">Subject</label>
                                        <div class="col-sm-7"><input type="text" name="subject" class="form-control" id="inputSubject" placeholder="subject" required></div>
                                        <div class="col-sm-4"></div>
                                      </div><!-- form group -->
                                      <div class="form-group">
                                        <label class="col-sm-1" for="inputBody">Message</label>
                                        <div class="col-sm-7">
                                          <textarea class="form-control"
                                          id="inputBody" rows="8" data-gramm="true" data-gramm_editor="true"placeholder="Type your message here ................................." name="message" required></textarea> </div>
                                          <div class="col-sm-4"></div>         
                                        </div><!-- form group -->
                                        <div class="form-group">
                                          <label class="col-sm-7"> </label>
                                         
                                          <div class="col-sm-4"></div>
                                        </div><!-- form group -->
                                   <div class="form-group"> 
                                          <label class="control-label col-sm-1">To</label>
                                          <div  class="col-sm-4">
                                            <select  name="to"  class="form-control">
                                              <?php
                                              if($_SESSION['level']='admin') {
                                                  do{?>
                                               <option  value= "<?php echo $row['staff_id'];?>" selected> <?php   echo $row['username'];?></option> <?php } while($row=$empB->fetch_assoc());
                                               }
                                                else{
                                                echo "Manager";
                                             } ?></select>
                                       </div><!-- form group --> 
                           <button type="submit" name="submit" class="btn btn-info" id="sendOne">Send Message</button>
                        <?php if ($_SESSION['level'] == 'admin') { ?>              
                                 <a href="#" > <input type="" name=""id="sendMore" value="Send to all Employees"class="btn"> </a>
                               <?php } ?>
                                         </div>
                                   </form>
                                    </div>
                                  </div>
                                </div>
                              </div>



                            </div><!-- container -->
                          </div>
                        </div><!-- end scrol table ------------------------------------------------------------------------------->



                      </div>    <!-- pan -->                                             
                    </div>
                  </div>
                </section>
              </body>
              <?php include 'inc/footer.php';  ?>
              </html>