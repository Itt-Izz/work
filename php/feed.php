
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$msg =$_POST['msg'];
$frm=$_POST['staff'];
$date=date("Y-m-d");
if($con->query("INSERT INTO message(`m_id`, `subject`, `msg`, `sent_date`, `staff_id`, `dest_id`, `Msg_read`) VALUES('','Feedback','$msg','$date','$frm',1,0))") {
  $success=1;
}else {
     $success=2;
  }
 echo $success;
  ?>