<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
	die(header('Location: ../index.php'));
}
require_once 'connection.php';
require_once('AfricasTalkingGateway.php');
if ($mess=$_POST['msg']) {
	$date=date('Y-m-d');
$sql="SELECT phone_number FROM staff where phone_number='0710662656'";
$result=$con->query($sql);
while ($row=$result->fetch_assoc()) {
	$i=$row['phone_number'];
	$j=substr($i, 1, 9);
	$t='+254'.$j;
	$username   = "employees";
	$apikey     = "220f4868d095452b9c0d930cd20f68abce855dff5f13fe00b948f36db942a0da";
	$recipients = "$t";
	$message    = "$mess";
	$gateway    = new AfricasTalkingGateway($username, $apikey);
	try 
	{
		$results = $gateway->sendMessage($recipients, $message);
	}
	catch ( AfricasTalkingGatewayException $e ) 
	{
  echo "Something went wrong1";
	}
}
$con->query("INSERT INTO sms(s_id, msg, date) VALUES ('', '$mess', '$date')");
  echo 1;
}else{
  echo 2;
}