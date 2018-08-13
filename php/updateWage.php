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
if($con->query("UPDATE wage SET employee='$emp', clerk='$clerk', `date`='$date' where w_id=1") ) {
  $success=1;
}else {
     $success=2;
  }
 echo $success;
  ?>