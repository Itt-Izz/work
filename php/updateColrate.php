
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$rate =$_POST['rate'];
$date=date('Y-m-d');
if($rate>0 && $rate<100) {
$con->query("UPDATE collectionrate SET rate='$rate', date='$date' WHERE 1");
  $success=1;
}else {
     $success=2;
  }
 echo $success;
  ?>