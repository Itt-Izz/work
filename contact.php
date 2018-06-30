
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
                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Employees </a>
                <a href="payment.php" id="payHist" class="list-group-item">
                  <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Payment</a>
                  <a href="register.php" id="regc2" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Register Clerk </a>
                      <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle list-group-item glyphicon glyphicon-user  main-color-bg" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Profile
                         <span class="caret"></span></button>
                         <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                          <li><a href="contact.php" class="main-color-bg"   id="con2">Contact Info</a></li>
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
        <!-- Website Overview -->
        <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Contact Information</h3>
              </div>
            <div class="panel-body">
        <ol class="breadcrumb">
               <li id="od"> </li> 
                 <div class="form-group inputStyl">
                    <label for="usr">Email</label>
                    <input type="text" class="form-control" id="">
                    <label for="usr">First Name</label>
                    <input type="text" class="form-control" id="">
                    <label for="usr">Last Name</label>
                    <input type="text" class="form-control" id="">
                    <div class="form-group">
                        <label for="sel1">Country:</label>
                        <select class="form-control" id="sel1">
                          <option>Kenya</option>
                          <option>Uganda</option>
                          <option>Tanzania</option>
                          <option>Other</option>
                        </select>
                      </div>
                    <label for="usr">City</label>
                    <input type="text" class="form-control" id="">
                    <label for="usr">Phone 1</label>
                    <input type="text" class="form-control" id="">
                    <label for="usr">Phone 2</label>
                    <input type="text" class="form-control" id="">
                    <button id="btn" class="active main-color-bg btn btn-default btnStyl">Submit</button>
                  </div>
                 
         </ol>           
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