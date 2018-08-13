
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$date=date("Y/m/d");
$tool =$_POST['tool'];
$staf=$_POST['stafId'];
$pre=$_POST['present'];
if($pre>0) {
	$con->query("DELETE FROM attendance WHERE staff_id='$staf' AND CURDATE()");
  $success=3;
}else {
	$con->query("UPDATE attendance SET t_id='$tool' WHERE staff_id='$staf' AND  `date`=CURDATE()");
     $success=1;
}
 echo $success;
?>