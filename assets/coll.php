<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once '../php/connection.php';
// $dat=file_get_contents("php://input");
$dat=$_POST['collect'];
$staf=$_POST['staf'];

if(isset($dat)){
  echo "the ans: ".$dat;
  echo "this is the other".$staf;
}

?>