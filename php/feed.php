
<?php
include('../php/connection.php');
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
$msg =$_POST['msgfeed'];
$frm=$_SESSION['staff_id'];
$date=date("Y-m-d");
$con->query("INSERT INTO message(`m_id`, `subject`, `msg`, `sent_date`, `staff_id`, `dest_id`, `Msg_read`)
                 VALUES('','Feedback','$msg','$date','$frm',1,0)");
header('Location: ../home.php');
  ?>