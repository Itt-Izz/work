<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$stafId =$_POST['stafId'];
$amt=$_POST['amt'];
$deduct=$_POST['deduct'];
$day =date('Y-m-d');

if ($con->query("UPDATE attendance SET status=1 WHERE staff_id='$stafId'")) {
	
$con->query("INSERT INTO pay(p_id,pay_date,amt,deduction) 
	VALUES('','$day','$amt','$deduct')");
$success=1;
}else{
$success=2;
}
 echo $success;
  ?>