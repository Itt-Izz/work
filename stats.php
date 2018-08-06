<?php
include('php/connection.php');
session_start();
if (!isset($_SESSION['staff_id'])) 
{
    die(header('Location: ../index.php'));
}
include ('php/query.php');
?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'inc/head.php'; ?>                   
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <section id="main">
        <a class="fix-me button" data-target="#feed" data-toggle="modal" href="">Feedback <span class="glyphicon glyphicon-comment"></span></a>
        <div class="container">
            <div class="row">
                <div class="col-md-2">  
          <div class="list-group ">
            <a href="home.php" class="list-group-item">
              <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Home </a>
               <a href="collection.php" class="list-group-item" id="col">
            <span class="glyphicon glyphicon-flag" aria-hidden="true"></span>Collections </a>
              <a href="staff.php" id="stuff2" class="list-group-item">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Employees </a>
                <a href="payment.php" id="payHist" class="list-group-item">
                  <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Payment</a>
                  <a href="register.php" id="regc2" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Register Clerk </a>
                      <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle list-group-item glyphicon glyphicon-user" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Profile
                         <span class="caret"></span></button>
                         <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                          <li><a href="contact.php"  id="con2">Contact Info</a></li>
                          <li><a href="account.php"  id="acc2">Account Info</a></li>
                        </ul>
                      </div>
                      <a href="stats.php" id="st" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Reports </a>
                      <a href="message.php" id="inbox" class="list-group-item">
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Messages </a>
                      </div>
                      <div class="well">
                        <ul class="list-group">
                          <span class="glyphicon glyphicon-flag"></span> <a href="">How to Earn more </a><br><br>
                          <span id="lg" class="glyphicon glyphicon-flag" aria-hidden="true"></span><a href="#">Change Password</a>
                        </ul>
                      </div>                                      
                </div>
                <div class="col-md-10" id="pan">
<!-- Latest Users -->
<div class="panel panel-default">
  <div class="panel-heading main-color-bg">
    <h3 class="panel-title">Statistics</h3>

  </div>
  <div class="panel-body">
    <div id="scrolTable">
      <?php
      $quer="SELECT t_id, name, namba, cost FROM tools ORDER BY t_id";
       $data=array();
       $rw=$con->query($quer);
       foreach ($rw as $row) {
         $data[]=$row;
       }
       //Daily employee attendance
      $que="SELECT date_format(date, '%W') AS day, COUNT('day') as dayCount FROM attendance GROUP BY day";
       $dat=array();
       $r=$con->query($que);
       foreach ($r as $row) {
         // $dat[]=$row;
        array_push($dat, $row);
       }
//Daily employee collection
      $que2="SELECT date_format(col_date, '%W') AS day, COUNT('day') as dayCount FROM collection GROUP BY day";
       $dat2=array();
       $rc=$con->query($que2);
       foreach ($rc as $row) {
         // $dat[]=$row;
        array_push($dat2, $row);
       }
//Print in json
       // print json_encode($dat2);
          // die();
       print json_encode($dat)

        ?>

       <div class="col-md-12">
         <div class="col-md-3" style="height: 150px; background-color: lightgrey;">
           <h4>Present Today</h4>

           <div class="col-md-4">
            <?php $preNo="SELECT COUNT(*) FROM attendance LEFT JOIN staff on attendance.staff_id=staff.staff_id WHERE attendance.present='yes' AND attendance.date=CURDATE() ";
               $resultPresent=$con->query($preNo);
               $row=$resultPresent->fetch_assoc();
               echo "<h1>".$row['COUNT(*)']."</h1>";

             ?>
             
           </div>
           <div class="col-md-8">
          <p> <?php 
         $qr3 = "SELECT *, count(*) FROM attendance LEFT JOIN staff on attendance.staff_id=staff.staff_id WHERE attendance.present='yes' AND attendance.date=CURDATE() GROUP BY sex";
        $sex =  $con->query($qr3);
            while($rowsb = $sex->fetch_array()) {
                        echo $rowsb['sex'].": <b>".$rowsb['count(*)'].'</b>';
                        echo "<br><br>";
                    } ?></p>
           </div>
           
         </div>
         <div class="col-md-1""></div>
         <div class="col-md-3" style="height: 150px; background-color: lightgreen;">
            <h4>Total collection</h4>
           <div class="col-md-5">
            <?php $tc="SELECT COUNT(weight) as weight FROM collection";
                  $t=$con->query($tc);
                  $row=$t->fetch_assoc(); 
                  $rat="SELECT rate FROM collectionrate";
                  $rate=$con->query($rat);
                  $rowRate=$rate->fetch_assoc();
           ?>
             <h1><?php echo $row['weight']; ?></h1>
           </div>
           <div class="col-md-7">
          <p> <h5>Rate:</h5><h6><b><?php echo $rowRate['rate']." per Kg"; ?></b></h6></p>
           <p><h5>Amount:</h5><h6><b><?php echo "Ksh. ".$rowRate['rate']*$row['weight']; ?></b></h6></p>
           </div>
         </div>
         <div class="col-md-1"></div>
         <div class="col-md-3" style="height: 150px; background-color: #cbcbcb;">
            <h4>Tools lost</h4>
           <div class="col-md-4">
            <?php $tl="SELECT COUNT(*)as no, sum(cost)as cost FROM `attendance` LEFT JOIN tools on attendance.t_id=tools.t_id WHERE attendance.returned_tool='No'";
                $tq=$con->query($tl);
                $toolRows=$tq->fetch_assoc();
             ?>
             <h1><?php echo $toolRows['no']; ?></h1>
           </div>
           <div class="col-md-8">
          <p> <h5>Cost</h5><h6><?php echo $toolRows['cost']; ?></h6></p>
           </div>
         </div>
         <div class="col-md-1"></div>
       </div><br><br><br><br>
       <div class="col-md-12" style="background-color: #F8F8F8; margin: 20px; padding: 10px;">
            <div class="container col-md-6">
                <canvas id="mychart"></canvas>
            </div>
            <div class="container col-md-6">
                <canvas id="mypy"></canvas>
            </div> 
       </div><br><br><br><br>
       <div class="col-md-12">
         <h3 align="center" class="breadcrumb">Employee Attendance</h3>
    <table class="table table-striped table-bordered table-hover" id="mytable4">
       <thead>
     <tr>
        <th>#</th>
        <th>Name</th>                       
        <th>Sex</th>                         
        <th>Wage/Day</th>                  
        <th>RegNo</th>                   
        <th>Days Present</th>                   
        <th>Amount</th> 
      </tr>
    </thead>
    <tbody>
      <?php if ($present->num_rows > 0) {
    // output data of each row
        $i=1;
        while($row = $present->fetch_assoc()) {
         ?>  <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $row["fname"]; ?></td>                        
          <td><?php echo $row["sex"]; ?></td>                        
          <td><?php echo $row["employee"]; ?></td>                   
          <td><?php 
          echo $row["staff_id"]; ?></td>                      
          <td><?php
   $em=$row["staff_id"];
 $onePresenty="SELECT count(*) FROM `attendance` LEFT JOIN staff on staff.staff_id=attendance.staff_id WHERE attendance.present='yes' AND staff.staff_id=$em";
         $onePrey=$con->query($onePresenty);
           $rw=$onePrey->fetch_assoc();
           echo $rw['count(*)']; ?>
            </td> 
          <td>
            <?php $am=$row["employee"]*$rw["count(*)"];
                     echo $am;
            ?>                
          </tr><?php
          $i++;
           }
        } else {
          echo "0 results";
        }
        $con->close();
        ?> 
      </tbody>            
    </table>
       </div>
    </div>
               </div>                                                 
            </div>
        </div>
    </section>
</body>

     <script src="assets/jquery-3.2.1.min.js"></script>
     <script src="assets/jquery.validate.min.js"></script>
     <script src="assets/additional-methods.min.js"></script>
     <script src="assets/sweetalert.min.js"></script>
     <script src="assets/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap.js"></script>
    <script src="assets/js/dataTables.responsive.js"></script>   
    <script class="reload" src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/Chart.min.js"></script>
    <script src="assets/chartScript.js"></script>
  <script src="assets/validation.js"></script>

    <script type="text/javascript">
       // Attendance implementation --------------------------------------------------------------------------------
  
     var dat=<?php echo json_encode($dat)?>;
      var day={
        attendance:[]
      };
      var leng=dat.length;

      for (var i=0; i<leng; i++){
        console.log(data[i]);
              day.attendance.push(dat[i].dayCount);
      }
  var mychart = document.getElementById('mychart').getContext('2d');
  var  data = {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        datasets:[{
            label: 'Daily Employee Attendance',
            data: day.attendance,
            backgroundColor: "green",
            borderColor: "lightgreen",
            fill: false,
            pointRadius:5,
            backgroundColor: 'lightgreen'
        }]
     };
      var options = {
        title:{
            display : true,
            position: "top",
            text : "Daily Collections",
            fontSize: 18, 
            fontColor: "#333"
        },
        legend:{
            display: true,
            position: "bottom"
        }
      };
      var option2 = {
        title:{
            display : true,
            position: "top",
            text : "Daily Employee Attendance",
            fontSize: 18, 
            fontColor: "#333"
        },
        legend:{
            display: true,
            position: "bottom"
        }
      };
      // console.log(data);
      var chart=new Chart(mychart, {
        type:"line",
        data:data,
        options: option2
      });


       // Collection implementation --------------------------------------------------------------------------------
     var dat2=<?php echo json_encode($dat2)?>;
      var day={
        collection:[]
      };
      var leng=dat.length;

      for (var i=0; i<leng; i++){
        // console.log(data[i]);
              day.collection.push(dat[i].dayCount);
      }
  var mypy = document.getElementById('mypy').getContext('2d');
  var  data2 = {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday'],
        datasets:[{
            label: 'Daily Collections',
            data: day.collection,
            fill: false,
            pointRadius:5,
            backgroundColor: [
            'rgba(255,99,132,0.6)',
            'rgba(255,162,235,0.6)',
            'rgba(255,206,86,0.6)',
            'rgba(75,192,192,0.6)',
            'rgba(153,102,255,0.6)',
            'rgba(255,159,64,0.6)',
            'rgba(255,99,132,0.6)'
            ]
        }]
     };
      var chart=new Chart(mypy, {
        type:"pie",
        data:data2,
        options: options
      });


    </script>
<footer id="footer">
    <p>Copyright &copy; www.lasittea.com 2018</p>
</footer>

    
</html>