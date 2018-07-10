
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$date=date("Y/m/d");
$rate=10;
$staf=$_POST['staff'];
$clerk=$_SESSION['staff_id'];
$dat=$_POST['collect'];
echo $staf;
$response=array();
$d=$con->query("SELECT col_date, count(*) FROM collection WHERE col_date='$date' AND staff_id='$staf'");
$r=$d->fetch_assoc();
if($r["count(*)"]<1){
  if($con->query("INSERT INTO collection(`id`, `col_date`, `weight`, `rate`, `staff_id`, `ur_clerk`) VALUES ('','$date','$dat','$rate','$staf','$clerk')")) { 
    $response['status']='success';
    $response['message']='Collection taken successfully!';
    ?>
  <!-- <div class="alert alert-success" style="color: green; margin-top: 250px;" align="center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <h3><strong>Hurray!</strong><br>  Values are recorded successfully</h3>
  </div>
  <button class="btn btn-danger">try</button> -->

  <?php
}else{
  $response['status']='error';
  $response['message']='Unable to save that collection!';
  ?>
  <!-- <script>alert('Error while registering you...');</script> -->
  <?php
}

}else { 
 $response['status']='error';
 $response['message']='Employee Collection already taken!';


 echo json_encode(array(
  "status" => "error",
  "message" => "Employee Collection already taken!"
));

 } ?>

