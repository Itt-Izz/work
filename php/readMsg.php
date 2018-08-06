
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$mesId =$_POST['m_id'];
if ($con->query("UPDATE message SET Msg_read ='1' WHERE m_id='$mesId'")) {
	echo 1;
}else{
	echo 2;
}  
  ?>