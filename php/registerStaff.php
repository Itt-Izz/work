
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
    die(header('Location: ../index.php'));
}
require_once 'connection.php';
require_once('AfricasTalkingGateway.php');
$target_dir = "../empImgs/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
    $image=$_FILES["image"]["name"];
   // echo "<script>alert('File uploaded Successfully!') </script>";
   // header('Location: registerStaff.php');

    $name = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $sex = $_POST['gender'];
    $birthday =trim ($_POST['birthday']);
    $id = trim($_POST['id']);
    $phone = trim($_POST['phone']);
    $grade = trim($_POST['grade']);
    $uname = trim($_POST['username']);    
    $typ = trim($_POST['type']);
    $depart = trim($_POST['department']);
    $upass = trim($_POST['password']);
    $cpass = trim($_POST['password2']);
    $date= date("Y/m/d");
    if($typ=="clerk"){
        $level="clerk";
    }
    $level="staff";
	// username exist or not
    $query = "SELECT * FROM staff WHERE username='$uname'";
    $result = $con->query($query);
    // if username not found then register
    if ($upass != $cpass) {
     header('Location: ../register.php?error');
 } else{  
     //then register
     if( $result->num_rows== 0){

        $con->query("INSERT INTO staff(fname, lname, sex, birthday, username, password, date_registered, id_number, phone_number, level, image) 
            VALUES('$name','$lname','$sex','$birthday','$uname','$upass','$date','$id','$phone','$level','$image')");
        $username   = "employees";
        $apikey     = "220f4868d095452b9c0d930cd20f68abce855dff5f13fe00b948f36db942a0da";
        $recipients = $phone;
        $message    = "Welcome To Lasit. Username: $uname. Password: $upass";
        $gateway    = new AfricasTalkingGateway($username, $apikey);
        try 
        {  
          $results = $gateway->sendMessage($recipients, $message);
          // message sent successfully
      }catch ( AfricasTalkingGatewayException $e ) {
        echo "An error occured while sending message, please check your internet connection";
    }
    echo 1;
}else{
    echo 2;
}	
}
}

?>