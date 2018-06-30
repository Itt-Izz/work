
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
                          <li><a href="contact.php"   id="con2">Contact Info</a></li>
                          <li><a href="account.php"  class="main-color-bg" id="acc2">Account Info</a></li>
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
                <h3 class="panel-title">My Account</h3>
              </div>
            <div class="panel-body">
              <div id="acc" class="form-group inputStyl breadcrumb">
                  <label for="usr">Login: <b>Izzo</b>  \</label>
                  <p>The account was created on 01/01/2018</p>
                  <label for="">Employee Info</label><br>
                  <p>the following initaial accountwas the first and should be included all the details that are 
                    best described as the most visible andf vivid description
                     maintaioned in order to ensuew thatits aok </p>
                    <div class="imgPos">
                      <?php echo "<img src='empImgs/".$row['image']."'class='img-circle' id='hdimg'>";?>
                 <button class="btn btn-success btn-xs">Upload Image</button>
                    </div>

                  <label for="usr">Username</label>
                  <input type="text" class="form-control" id="">
                  <label for="usr">Your Background</label>
                  <input type="text" class="form-control" id="">

                  <label for="usr">Subjects</label>
                    <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                  <button id="btn" class="active main-color-bg btn btn-default btnStyl">Submit</button><br>

                  <div class="form-group">
                      <label for="sel1">Location</label>
                      <select class="form-control" id="sel1">
                        <option>Nakuru</option>
                        <option>Nairobi</option>
                      </select>
                          
                  <label for="usr">Current Password</label>
                  <input type="text" class="form-control" id="">
                  <label for="usr">New Password</label>
                  <input type="text" class="form-control" id="">
                  <label for="usr">Confirm New Password
                    34label>
                  <input type="text" class="form-control" id="">
                  <button id="btn" class="active main-color-bg btn btn-default btnStyl">Submit</button>

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