<?php
require_once('AfricasTalkingGateway.php');
$message=$POST['message'];
$sql="SELECT phone-no FROM staff"
while () {
  $phoneNo="+254";
$username   = "employees";
$apikey     = "220f4868d095452b9c0d930cd20f68abce855dff5f13fe00b948f36db942a0da";
$recipients = "$phoneNo";
$message    = "$message";
$gateway    = new AfricasTalkingGateway($username, $apikey);
try 
{ . 
  $results = $gateway->sendMessage($recipients, $message);
            
  foreach($results as $result) {
    // status is either "Success" or "error message"
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    echo " StatusCode: " .$result->statusCode;
    echo " MessageId: " .$result->messageId;
    echo " Cost: "   .$result->cost."\n";
  }
}
catch ( AfricasTalkingGatewayException $e ) 
{
  echo "Encountered an error while sending: ".$e->getMessage();
}
}