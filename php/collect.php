
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$date=date("Y/m/d");
$rate=10;
$staf=$_POST['staff'];
$clerk=$_SESSION['staff_id'];
$dat=$_POST['collect'];
$d=$con->query("SELECT col_date, count(*) FROM collection WHERE col_date='$date' AND staff_id='$staf'");
$r=$d->fetch_assoc();
if($r["count(*)"]<1){
  if($dat > 5 && $dat < 700) { 
  $con->query("INSERT INTO collection(`id`, `col_date`, `weight`, `rate`, `staff_id`, `ur_clerk`) VALUES ('','$date','$dat','$rate','$staf','$clerk')");
     $success=1;

}else{
     $success=2;  
}

}else {
     $success=3;
 } 

 echo $success;
 ?>

