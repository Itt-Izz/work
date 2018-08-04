
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$date=date("Y/m/d");
$tool =$_POST['tool'];
$staf=$_POST['staff'];
$present="yes";
$clerk=$_SESSION['staff_id'];
$d=$con->query("SELECT date FROM attendance WHERE date='$date' AND staff_id='$staf'");
$r=$d->fetch_assoc();
if($r<1) {
	if ($tool=='') {
$con->query("INSERT INTO `attendance`(`id`, `date`, `staff_id`, `present`, `t_id`, `returned_tool`,`w_id`,`status`, `ur_clerk`) VALUES ('','$date','$staf','$present','','',1,0,'$clerk')");
	}else{
$con->query("INSERT INTO `attendance`(`id`, `date`, `staff_id`, `present`, `t_id`, `returned_tool`,`w_id`,`status`,`ur_clerk`) VALUES ('','$date','$staf','$present','$tool','no',1,0,'$clerk')");
}
     $success=1;
}else {
     $success=2;
  }
 echo $success;
  ?>