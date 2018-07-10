
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
  die(header('Location: ../index.php'));
}
require_once 'connection.php';
$date=date("Y/m/d");
$present='No';
$tool =trim($_POST['tool']);
$staf=trim($_POST['staf']);
$clerk=$_SESSION['staff_id'];
$d=$con->query("SELECT date FROM attendance WHERE date='$date' AND staff_id='$staf'");
$r=$d->fetch_assoc();
if ($r<1) {
if(isset($_POST['pre'])) {
  $present =trim($_POST['pre']);
$con->query("INSERT INTO `attendance`(`id`, `date`, `staff_id`, `present`, `t_id`, `returned_tool`, `ur_clerk`) VALUES ('','$date','$staf','$present','$tool','','$clerk')"); ?>
    <div class="container">
      <div class="alert alert-success" align="center" style="margin-top: 300px; color: green; ">
       <h3> <strong>Success!</strong> Employee marked as Present</h3>
     </div>
   </div>
   <?php
}else {?>
  <div class="container" S>
    <div class="alert alert-info" align="center" style="margin-top: 300px; color: blue; ">
    <script type="text/javascript"> alert("Please try checking as present before sending !!");</script>
     <!-- <h3> <strong>Stop!</strong><br> Please try checking as present before sending  </h3> -->
   </div>
 </div>
    <?php }

}else {  ?>
    <div class="container">
      <div class="alert alert-warning" align="center" style="margin-top: 300px; color: red; ">
 
      <?php 
         

$yourJS = '<script >
                window.onload = dothis();
                function dothis(){
                    fun1();
                    //Replace the above code with anything you want.Just make sure you escape any single quotes
                }
           </script>';
echo $yourJS;

          //header('Location: ../home.php');
          ?>      
     </div>
   </div>
   <?php
    

  } 
  ?>