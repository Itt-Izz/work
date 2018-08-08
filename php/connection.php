 <?php
//<mysql -u b41b196e8e6fa9 -h us-cdbr-iron-east-05.cleardb.net -p d3494e6987b4f0e 
$con = mysqli_connect("localhost", "root", "","newsalary");

if(mysqli_connect_errno()){
    echo 'Failed to connect to MYSQL: '.mysqli_connect_error();
}
?> 

