
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
die(header('Location: ../index.php'));
}
require_once 'connection.php';
	$from = $_SESSION['staff_id'];
	$to=trim($_POST['to']);
    $sub =trim ($_POST['subject']);
	$mes = trim($_POST['message']);
	$date = date("Y-m-d h:i");
if($con->query("INSERT INTO message(m_id, subject, msg, sent_date, staff_id, dest_id, Msg_read) 
VALUES('','$sub','$mes','$date','$from','$to','0')"))	{
echo 1;
		}
		else
		{
echo 2;
		}	

?>