
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
if ($con->query("UPDATE message SET Msg_read ='1' WHERE subject='Feedback'")) {
	echo 1;
}else{
	echo 2;
}  
  ?>