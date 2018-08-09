
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$emp =$_POST['emp'];
$pass =$_POST['pass'];
if($con->query("UPDATE staff SET password='$pass' WHERE staff_id='$emp'")) {
  $success=1;
}else {
     $success=2;
  }
 echo $success;
  ?>