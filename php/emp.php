 <?php
 session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$emplId=$_POST['empId'];
$emp=$con->query("SELECT * FROM staff where staff_id='$emplId'");
if($row=$emp->fetch_assoc()){ 
	$array = array(
                'staff_id' => $row["staff_id"],
                'fname' => $row["fname"],
                'sex' => $row["sex"],
                'birthday' => $row["birthday"],
                'username' => $row["username"],
                'date_registered' => $row["date_registered"],
                'id_number' => $row["id_number"],
                'phone_number' => $row["phone_number"],
                'level' => $row["level"],
                'dailyWage' => $row["location"],
                'image' => $row["image"]
                );
 echo json_encode($array);
}else{
     $success=2;  
   }

?> 
