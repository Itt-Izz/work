<?php
include('php/connection.php');
//include('sanitise.php');
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$sql ="SELECT * FROM staff WHERE username = '$username' AND password = '$password'";
$result= $con->query($sql);
if($result->num_rows>0)
{
	$row=$result->fetch_assoc();
	$_SESSION['staff_id']=$row['staff_id'];
	$_SESSION['username'] =$row['username'];
	$_SESSION['name'] =$row['fname'];
	$_SESSION['level'] =$row['level'];
	header('location: home.php');
} else
        { 
        	echo "Incorrect username or password!";
        }
        	echo $fails;
?>
