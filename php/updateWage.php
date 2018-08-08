<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$emp =$_POST['empWage'];
$clerk =$_POST['clerkWage'];
$date=date('Y-m-d');
if($emp>200 && $clerk>200 && $emp<2000 && $clerk<2000 ) {
$con->query("UPDATE wage SET employee='$emp', clerk='$clerk' date='$date' WHERE 1");
  $success=1;
}else {
     $success=2;
  }
 echo $success;
  ?>