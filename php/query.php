<?php
        $staff_id = $_SESSION['staff_id'];
        $qr = mysql_query("SELECT * FROM staff WHERE staff_id = '$staff_id'");      
        $qry2 = "SELECT count(*) FROM staff";
        $run2 =  $con->query($qry2);

        $qry3 = "SELECT *, count(*) FROM staff GROUP BY sex";
        $run3 =  $con->query($qry3);
        $query3="SELECT count(*) FROM message WHERE dest_id=1 AND Msg_read=1";
        $mesNo=$con->query($query3);

         $emp="SELECT `staff_id`, `fname`, `sex`, year(birthday), `username`, `password`, `date_registered`, `id_number`, `phone_number`, `level`, `dailyWage`, `image` FROM `staff` WHERE `level`!= 'admin'";
         $employe = $con->query($emp);

         $empW="SELECT * FROM staff WHERE `level`!= 'admin' AND `level`!= 'clerk'";
         $employ = $con->query($empW);
        //All days present
         $empo="SELECT count(*) FROM attendance WHERE staff_id='$staff_id'";
         $empone = $con->query($empo);

                            //Days of the week
                              $yesterday=date("Y-m-d", strtotime("yesterday"));
                              $dayBeforeYesterday=date("Y-m-d", strtotime("-2 day"));
                              $dayBY=date("D", strtotime("-2 day"));
                              $twoDaysBeforeYesterday=date("Y-m-d", strtotime("-3 day"));
                              $twoDaysBY=date("D", strtotime("-3 day"));
                              $threeDaysBYesterday=date("Y-m-d", strtotime("-4 day"));
                              $threeDaysBY=date("D", strtotime("-4 day"));
                              $fourDaysBYesterday=date("Y-m-d", strtotime("-5 day"));
                              $fourDaysBY=date("D", strtotime("-5 day"));
                              $fiveDaysBYesterday=date("Y-m-d", strtotime("-6 day"));
                              $fiveDaysBY=date("D", strtotime("-6 day"));

         //Check this week
          $dy=date('d');
          $todate=date('Y-m-d');
          $today=date('D');  
         if($today=='Mon'){
          $dy=$dy;
        } else if($today=='Tue'){
          $dy=$dy-1;
          // SELECT * FROM `collection` LEFT JOIN staff on collection.staff_id=staff.staff_id WHERE collection.col_date="2018-07-$dy"
        }else if($today=='Wed'){
          $dy=$dy-2;
        }else if($today=='Thu'){
          $dy=$dy-3;
        }else if($today=='Fri'){
          $dy=$dy-4;
        }else if($today=='Sat'){
          $dy=$dy-5;
        }else{
          $dy=$dy-6;
        }
          $dayBf=date("D", strtotime("2018-07-$dy"));
          $frm="2018-07-$dy";
         //All days present this week
      $empo2="SELECT count(*) FROM attendance LEFT JOIN staff on attendance.staff_id=staff.staff_id WHERE attendance.staff_id='$staff_id' AND date BETWEEN '$frm' AND '$todate'";
         $employeeC = $con->query($empo2);
         $r2=$employeeC->fetch_assoc();
      $empt="SELECT * FROM attendance LEFT JOIN staff on attendance.staff_id=staff.staff_id WHERE attendance.staff_id='$staff_id' AND date BETWEEN '$frm' AND '$todate'";
         $employeeCounted = $con->query($empt);

         //Payment this week
         $empo2="SELECT count(*) FROM attendance LEFT JOIN staff on attendance.staff_id=staff.staff_id WHERE attendance.staff_id='$staff_id' AND date BETWEEN '$frm' AND '$todate'";
         $employeeC = $con->query($empo2);
         $r2=$employeeC->fetch_assoc();
      $empPayNow="SELECT s.fname, s.staff_id, s.dailyWage, t.name, a.present, t.name, t.cost, a.status
                from staff s LEFT JOIN attendance a on a.staff_id=s.staff_id
                  LEFT JOIN tools t on t.t_id= a.t_id WHERE  date BETWEEN '$frm' AND '$todate' group by s.staff_id ";
         $empPayThisweek = $con->query($empPayNow);
     $pa= "SELECT s.fname, s.staff_id, s.dailyWage, t.name, a.present, t.name, t.cost
                from staff s LEFT JOIN attendance a on a.staff_id=s.staff_id
                  LEFT JOIN tools t on t.t_id= a.t_id group by s.staff_id";
    $pay=$con->query($pa);
          
         

         //Present today
         $empopre="SELECT * FROM staff RIGHT JOIN attendance ON attendance.staff_id=staff.staff_id LEFT JOIN tools on attendance.t_id=tools.t_id WHERE attendance.date=CURDATE()";
         $emponPre = $con->query($empopre);


//All staff
         $empAll="SELECT * FROM staff";
         $empA = $con->query($empAll);
         $allEmpRow=$empA->fetch_assoc();

         $staf="SELECT * FROM staff WHERE `level`= 'clerk'";
         $empB = $con->query($staf);

        
         $sl="SELECT image FROM staff where staff_id='$staff_id'";
         $img=$con->query($sl);

         $out="SELECT * FROM message LEFT JOIN staff on staff.staff_id=message.dest_id where message.staff_id='$staff_id' order by sent_date desc";
         $outbox=$con->query($out);

         $in="SELECT * FROM message LEFT JOIN staff on staff.staff_id=message.staff_id where message.dest_id='$staff_id'";
         $inbox=$con->query($in);

         $unR="SELECT * FROM message LEFT JOIN staff on staff.staff_id=message.staff_id where Msg_read=0 AND message.staff_id!='$staff_id'";
         $unRead=$con->query($unR);

        $pres="SELECT staff.fname, staff.sex, staff.staff_id, staff.dailyWage, attendance.date,attendance.present,attendance.returned_tool FROM staff RIGHT JOIN attendance ON attendance.staff_id=staff.staff_id WHERE attendance.present='yes' AND attendance.staff_id !=1 GROUP BY staff.staff_id";
         $present=$con->query($pres);

         $onePresent="SELECT count(*) FROM `attendance` LEFT JOIN staff on staff.staff_id=attendance.staff_id WHERE attendance.present='yes' AND staff.staff_id=18";
         $onePre=$con->query($pres);

         // Not returned tool
         $lostT="SELECT * FROM attendance LEFT JOIN staff ON attendance.staff_id= staff.staff_id WHERE attendance.returned_tool='no'";

         $allPay="SELECT pay.p_id, staff.fname, staff.staff_id, pay.amt, pay.deduction,pay.bal, pay.pay_date FROM staff left join pay_staff ON staff.staff_id=pay_staff.staff_id INNER JOIN pay ON pay.p_id=pay_staff.p_id";
              $allPayment=$con->query($allPay);

              $tools="SELECT * FROM tools";
              $tool=$con->query($tools);
              $rw=$tool->fetch_all();
            
//All collections
              $collection="SELECT * FROM collection INNER JOIN staff ON staff.staff_id=collection.staff_id GROUP by staff.staff_id";
              $col=$con->query($collection);
              $collectW="SELECT sum(weight) as weight FROM collection LEFT JOIN staff ON staff.staff_id=collection.staff_id";
              $sumWeight=$con->query($collectW);
      //collection per week  
        $colW="SELECT *, sum(weight) as total FROM collection LEFT JOIN staff on collection.staff_id=staff.staff_id WHERE col_date BETWEEN '$frm' AND '$todate' group by staff.staff_id";
         $colWk=$con->query($colW);

//chart
              //three tables
            $t3= " SELECT name id wage present tool cost TTdeduction TTwage FROM attendance INNER JOIN `staff` ON staff.staff_id=attendance.staff_id INNER JOIN tools ON tools.t_id=attendance.t_id";
           $payy= "SELECT s.fname, s.staff_id, s.dailyWage, t.name, t.cost, p.deduction, p.amt from staff s inner join pay_staff ps on s.staff_id = ps.staff_id inner join pay p on p.p_id = ps.p_id INNER JOIN attendance a on a.staff_id=s.staff_id INNER JOIN tools t on t.t_id= a.t_id where s.staff_id = 18 ";





        ?>