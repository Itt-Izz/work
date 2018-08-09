
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$name =$_POST['tname'];
$cost =$_POST['tool'];
if($cost>50 && $cost < 2000) {
$con->query("UPDATE tools SET cost='$cost' WHERE name='$name'");
  $success=1;
}else {
     $success=2;
  }
 echo $success;
  ?>