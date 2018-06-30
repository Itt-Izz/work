<?php
session_start(); 
require_once("connection.php");

$name=$_POST['name'];
$pass=$_POST['password'];

//$result = $con -> query("select * from register_staff WHERE uname= '$username' and password='$password'");
$sql ="SELECT * FROM register_staff WHERE username = '$username' AND password = '$password'";
//  $row = $result->fetch_assoc();
$result= mysql_query($sql);
$row=mysql_fetch_assoc($result); 

echo $username;
echo "Sasa hhhhhhhhhhhhhhhhgitii iutuurituujjitit  uyui9tyiuuit tuitiu tuutiiuti";   
 if($row > 0) { 
    $_SESSION['name'] = $row['uname'];
	$_SESSION['id'] = $row['w_id'];
    header("Location: ../home.php");        
        }else{
     echo "Invalid username or password";
     header('Location: ../login.php?error');
     mysqli_close($con); 
}?>
