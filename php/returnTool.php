
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$stafId =$_POST['stafId'];
$day =date('Y-m-d');
if ($con->query("UPDATE attendance SET returned_tool ='yes' WHERE staff_id='$stafId' AND date='$day'")) {
	echo 1;
}else{
	echo 2;
}  
  ?>