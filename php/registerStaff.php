
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
die(header('Location: ../index.php'));
}
require_once 'connection.php';
 $target_dir = "../empImgs/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image=$_FILES["image"]["name"];
        // echo "The file". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


	$name = trim($_POST['fname']);
	$sex = $_POST['gender'];
	$birthday =trim ($_POST['birthday']);
	$id = trim($_POST['id']);
	$phone = trim($_POST['phone']);
    $depart = trim($_POST['department']);
    $position = trim($_POST['position']);
    $grade = trim($_POST['grade']);//-----------------------
    $years = trim($_POST['years']);//----------------------
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
        
if($con->query("INSERT INTO staff(fname, sex,birthday, department, position, 
username, password, date_registered, id_number, phone_number, level,image) 
VALUES('$name','$sex','$birthday','$depart','$position','$uname','$upass','$date','$id','$phone','$level','$image')"))	{
			?>
			<script>alert('Successfully registered ');</script>
			<?php
			header('Location: ../home.php');
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