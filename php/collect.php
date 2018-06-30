
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$date=date("Y/m/d");
$col =trim($_POST['collect']);
$rate=10;
$staf=trim($_POST['staf']);
$clerk=$_SESSION['staff_id'];
   // echo "collect   ".$col."-------staff    ".$staf."-------clerk".$clerk."---------date: ".$date;
   // die();
$d=$con->query("SELECT col_date, count(*) FROM collection WHERE col_date='$date' AND staff_id='$staf'");
$r=$d->fetch_assoc();
if ($r["count(*)"]<1) {
  if($con->query("INSERT INTO collection(`id`, `col_date`, `weight`, `rate`, `staff_id`, `ur_clerk`) VALUES ('','$date','$col','$rate','$staf','$clerk')")) { ?>
  <div class="alert alert-success" style="color: green; margin-top: 250px;" align="center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <h3><strong>Hurray!</strong><br>  Values are recorded successfully</h3>
  </div>
  <button class="btn btn-danger">try</button>
  <?php
}else{
  ?>
  <script>alert('Error while registering you...');</script>
  <?php
}
}else{?>
  <div class="container">
    <div class="alert alert-warning" align="center" style="margin-top: 300px; color: red; ">
     <h3> <strong>Ooops!!</strong> Employee Collection already taken</h3>
   </div>
 </div>
 <?php


}


?>