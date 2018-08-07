
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$name =$_POST['tname'];
$cost =$_POST['cost'];
$name =$_POST['tname'];
$namba =$_POST['namba'];
if($cost>50 $$ $cost < 2000 && $namba>0 && $namba < 500) {
$con->query("INSERT INTO tools(t_id, name, cost, namba) VALUES ('','$name','$cost','$namba')");
  $success=1;
}else {
     $success=2;
  }
 echo $success;
  ?>