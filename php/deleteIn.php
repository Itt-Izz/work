
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$del =$_POST['del'];
 if ($con->query("DELETE FROM message WHERE m_id='$del'")) {
  $success=1;
}else {
     $success=2;
  }
 echo $success;
  ?>