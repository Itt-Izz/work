
<?php
session_start();
if (!isset($_SESSION['staff_id'])) 
{
die(header('Location: ../index.php'));
}
require_once 'connection.php';
	$from = $_SESSION['staff_id'];
	$to=trim($_POST['to']);
    $sub =trim ($_POST['subject']);
	$mes = trim($_POST['message']);
	$date = date("Y-m-d h:i");
	


if($con->query("INSERT INTO message(m_id, subject, msg, sent_date,staff_id, dest_id, Msg_read) 
VALUES('','$sub','$mes','$date','$from','$to','0')"))	{
			?>
	<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong>  Message sent Successfully
  </div>
  <button class="btn btn-danger">try</button>
      <?php
		}
		else
		{
			?>
			<script>alert('Error while registering you...');</script>
			<?php
		}	

?>