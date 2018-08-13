
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$stafId =$_POST['stafId'];
$day =date('Y-m-d');
$t=$con->query("SELECT tools.t_id, tools.namba  FROM tools right join attendance on attendance.t_id=tools.t_id WHERE  staff_id='$stafId' and `date`=CURDATE()");
$tRow=$t->fetch_assoc();
$tool=$tRow['t_id'];
$n=$tRow['namba']+1;
if ($con->query("UPDATE attendance SET returned_tool ='yes' WHERE staff_id='$stafId' AND date='$day'")) {
$con->query("UPDATE tools SET namba='$n' WHERE t_id='$tool'");
	echo 1;
}else{
	echo 2;
}  
  ?>