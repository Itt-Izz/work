<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
require_once('AfricasTalkingGateway.php');
$mess=$_POST['message'];
if ($mess) {

$sql="SELECT phone_number FROM staff where phone_number='0710662656'";
$result=$con->query($sql);
while ($row=$result->fetch_assoc()) {
	$i=$row['phone_number'];
	$j=substr($i, 1, 9);
	// echo $j.'<br>';
	$t='+254'.$j;
	echo "<br<br><br>";
	print_r($t);
	echo "<br>";
	print_r($row);
	print($message);
	die();
$username   = "employees";
$apikey     = "220f4868d095452b9c0d930cd20f68abce855dff5f13fe00b948f36db942a0da";
$recipients = "$t";
$message    = "$message";
$gateway    = new AfricasTalkingGateway($username, $apikey);
try 
{
  $results = $gateway->sendMessage($recipients, $message);
}
catch ( AfricasTalkingGatewayException $e ) 
{
  echo "Encountered an error while sending: Please check your Internet connection";
}
}
echo 1;
}else{
	echo 2;
}