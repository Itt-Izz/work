<?php
include('php/connection.php');
//include('sanitise.php');
session_start();
$username = $_POST['username'];
//$salt = sanitise("oimoimmoi8768756875");
//$password=sanitise($_POST['password'].$salt);
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
	
	$_SESSION['level']=$row['level'];
	header('location: home.php');
}
else
        {
			$extract2="SELECT password FROM staff WHERE username='$username'";
            $result2= $con->query($extract2);
            $row = $result2->fetch_assoc();
            $checkpass = $row['password'];

            if($password != $checkpass)
            {
			echo $_SESSION['staff_id']; 
			echo $_SESSION['username'];
			echo $_SESSION['level'];  }

			else{  echo header('Location:index.php');}
        }
?>
