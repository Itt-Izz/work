
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$date=date("Y/m/d");
$weight =$_POST['weight'];
$staf=$_POST['stafId'];
$sql="SELECT weight FROM collection WHERE staff_id='$staf' AND col_date=CURDATE()";
$result=$con->query($sql);
$row=$result->fetch_assoc();
if ($row['weight'] == $weight) {
	$success=0;
}else{
   	$con->query("UPDATE collection SET weight='$weight' WHERE staff_id='$staf' AND  col_date=CURDATE()");
  $success=1;
   }
 echo $success;
?>