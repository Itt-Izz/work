
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
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        echo "<script> alert('File not ana image!'); </script>";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
        // echo "<script>alert('Sorry, your file already exists!') </script>";
     echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image"]["size"] > 1000000) {
        // echo "<script>alert('Sorry, your file is too large!') </script>";
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
        // echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed!') </script>";
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
        // echo "<script>alert('Sorry, File not aploaded!') </script>";
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image=$_FILES["image"]["name"];
        echo "<script>alert('File uploaded Successfully!') </script>";
        header('Location: registerStaff.php');
        // echo "The file". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        // echo "<script>alert('Sorry, there was an error while uploading your file!') </script>";
         echo "Sorry, there was an error uploading your file.";
    }
}	$name = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
	$sex = $_POST['gender'];
	$birthday =trim ($_POST['birthday']);
	$id = trim($_POST['id']);
	$phone = trim($_POST['phone']);
    $depart = trim($_POST['department']);
    $position = trim($_POST['position']);
    $grade = trim($_POST['grade']);//-----------------------
    //$years = trim($_POST['years']);//----------------------
    $uname = trim($_POST['username']);    
    $typ = trim($_POST['type']);
    $depart = trim($_POST['department']);
	$upass = trim($_POST['password']);
	$cpass = trim($_POST['password2']);//---------------------
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
        
if($con->query("INSERT INTO staff(fname, lname, sex, birthday, username, password, date_registered, id_number, phone_number, level, image) 
VALUES('$name','$lname','$sex','$birthday','$uname','$upass','$date','$id','$phone','$level','$image')"))	{
$username   = "employees";
$apikey     = "220f4868d095452b9c0d930cd20f68abce855dff5f13fe00b948f36db942a0da";
$recipients = $phone;
$message    = "Welcome To Lasit. Username: $uname. Password: $upass";
$gateway    = new AfricasTalkingGateway($username, $apikey);
try 
{  
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
  echo "Encountered an error while sending: Please Check Your internet Connection..".$e->getMessage();
}

			?>
			<script>alert('Successfully registered ');</script>
			<?php
		}
		else
		{
			?>
			<script>alert('Error while registering you...');</script>
			<?php
		}		
	}
	else{
			?>
			<script>alert('Sorry Username already taken ...');</script>
			<?php
	}
		
    }	

?>