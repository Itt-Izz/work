
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
    die(header('Location: ../index.php'));
}
require_once 'connection.php';
    $staf = trim($_POST['empId2']);
    $name = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $sex = $_POST['sex'];
    $birthday =trim ($_POST['birthday']);
    $id = trim($_POST['id']);
    $phone = trim($_POST['phone']);
    $loc = trim($_POST['location']);
    $uname = trim($_POST['username']); 
    $email = trim($_POST['email']);  
$date=$birthday;

if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
if ($sex =='Female' || $sex =='Male') {
if($con->query("UPDATE staff SET fname='$name',lname='$lname',sex='$sex',birthday='$birthday',username='$uname',id_number='$id',phone_number='$phone',location='$loc',email='$email' WHERE staff_id='$staf'")){
$success=1;
}else{
    $success=2;
}
   
}else{
    $success=0;
}
    
} else {
    $success=3;
}



echo $success;
?>




