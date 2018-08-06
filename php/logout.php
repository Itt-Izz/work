<?php
session_start();
unset($_SESSION['level']);
unset($_SESSION['username']);
unset($_SESSION['name']);
unset($_SESSION['staff_id']);
session_unset();
session_destroy();
header('Location: ../index.php');
?>