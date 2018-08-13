
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$staf =$_POST['stafId'];
 if ($con->query("DELETE FROM staff WHERE staff_id='$staf'")) {
  $success=1;
}else {
     $success=2;
  }
 echo $success;
  ?>