<?php
        $staff_id = $_SESSION['staff_id'];
        $qr = mysql_query("SELECT * FROM staff WHERE staff_id = '$staff_id'");      
        $qry2 = "SELECT count(*) FROM staff";
        $run2 =  $con->query($qry2);

        $qry3 = "SELECT *, count(*) FROM staff GROUP BY sex";
        $run3 =  $con->query($qry3);
        $notification="SELECT count(*) FROM message WHERE dest_id='$staff_id' AND Msg_read=0 AND subject='FEEDBACK'";
        $mesNo=$con->query($notification);
        $query4="SELECT count(*) FROM message WHERE dest_id='$staff_id' AND Msg_read=0  AND subject!='FEEDBACK'";
        $mesNo2=$con->query($query4);

         $emp="SELECT *, year(birthday) FROM `staff` WHERE `level`!= 'admin'";
         $employe = $con->query($emp);

         $empW="SELECT * FROM staff WHERE `level`!= 'admin' AND `level`!= 'clerk'";
         $employ = $con->query($empW);

         $empW2="SELECT * FROM staff WHERE `level`= 'clerk'";
         $employ2 = $con->query($empW2);

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
        $frm="2018-07-$dy";
          $dayBf=date("D", strtotime($frm));
          
         //All days present this week
      $empo2="SELECT count(*) FROM attendance LEFT JOIN staff on attendance.staff_id=staff.staff_id WHERE attendance.staff_id='$staff_id' AND date BETWEEN '$frm' AND CURDATE()";
         $employeeC = $con->query($empo2);
         $r2=$employeeC->fetch_assoc();
      $empt="SELECT * FROM attendance LEFT JOIN staff on attendance.staff_id=staff.staff_id LEFT JOIN wage on wage.w_id=attendance.w_id WHERE attendance.staff_id='$staff_id' AND attendance.date BETWEEN '$frm' AND CURDATE()";
         $employeeCounted = $con->query($empt);

         //Payment this week
         $empo2="SELECT count(*) FROM attendance LEFT JOIN staff on attendance.staff_id=staff.staff_id WHERE attendance.staff_id='$staff_id' AND date BETWEEN '$frm' AND '$todate'";
         $employeeC = $con->query($empo2);
         $r2=$employeeC->fetch_assoc();
      $empPayNow="SELECT s.fname, s.staff_id, t.name, a.present, t.name, t.cost, a.status, a.date
                from staff s LEFT JOIN attendance a on a.staff_id=s.staff_id
                  LEFT JOIN tools t on t.t_id= a.t_id WHERE  date BETWEEN '$frm' AND CURDATE() ORDER BY a.date DESC";
         $empPayThisweek = $con->query($empPayNow);
         $empPa1="SELECT s.fname, s.staff_id, t.name, a.present, t.name, t.cost, a.status, a.date
                from staff s LEFT JOIN attendance a on a.staff_id=s.staff_id
                  LEFT JOIN tools t on t.t_id= a.t_id WHERE a.staff_id='$staff_id' AND date BETWEEN '$frm' AND CURDATE() ORDER BY a.date DESC";
         $empPay1 = $con->query($empPa1);
     $pa= "SELECT * FROM attendance LEFT JOIN staff ON staff.staff_id=attendance.staff_id LEFT JOIN tools on tools.t_id=attendance.t_id LEFT JOIN wage on wage.w_id=attendance.w_id GROUP by staff.staff_id";
    $pay=$con->query($pa);
        


//All staff
         $empAll="SELECT * FROM staff";
         $empA = $con->query($empAll);
         $p=$empA->fetch_assoc();

         $staf="SELECT * FROM staff WHERE `level`!= 'staff'";
         $empB = $con->query($staf);

        
         $sl="SELECT image FROM staff where staff_id='$staff_id'";
         $img=$con->query($sl);

         $out="SELECT * FROM message LEFT JOIN staff on staff.staff_id=message.dest_id where message.staff_id='$staff_id' order by m_id desc";
         $outbox=$con->query($out);

         $in="SELECT * FROM message LEFT JOIN staff on staff.staff_id=message.staff_id where message.dest_id='$staff_id' AND subject='FEEDBACK' order by m_id desc";
         $inbox=$con->query($in);
         $in2="SELECT * FROM message LEFT JOIN staff on staff.staff_id=message.staff_id where message.dest_id='$staff_id' AND subject !='FEEDBACK' order by m_id desc";
         $inbox2=$con->query($in2);

         $unR="SELECT * FROM message LEFT JOIN staff on staff.staff_id=message.staff_id where Msg_read=0 AND message.staff_id!='$staff_id' order by m_id desc";
         $unRead=$con->query($unR);

        $pres="SELECT staff.fname, staff.sex, staff.staff_id, wage.employee, attendance.date,attendance.present,attendance.returned_tool FROM staff RIGHT JOIN attendance ON attendance.staff_id=staff.staff_id left join wage on attendance.w_id=wage.w_id WHERE attendance.present='yes' AND attendance.staff_id !=1 GROUP BY staff.staff_id";
         $present=$con->query($pres);

         $onePresent="SELECT count(*) FROM attendance LEFT JOIN staff on staff.staff_id=attendance.staff_id WHERE attendance.present='yes' AND staff.staff_id=18";
         $onePre=$con->query($pres);

         // Not returned tool
         $lostT="SELECT * FROM attendance LEFT JOIN staff ON attendance.staff_id= staff.staff_id WHERE attendance.returned_tool='no'";


              $tools="SELECT * FROM tools";
              $tool=$con->query($tools);
              $rw=$tool->fetch_all();

              $ttt="SELECT * FROM tools";
              $tol=$con->query($ttt);
            
//All collections
              $collection="SELECT * FROM collection INNER JOIN staff ON staff.staff_id=collection.staff_id GROUP by staff.staff_id";
              $col=$con->query($collection);
              $collectW="SELECT sum(weight) as weight FROM collection LEFT JOIN staff ON staff.staff_id=collection.staff_id";
              $sumWeight=$con->query($collectW);
      //collection per week  
        $colW="SELECT * FROM collection LEFT JOIN staff on collection.staff_id=staff.staff_id ORDER BY collection.col_date desc";
         $colWk=$con->query($colW);
         $colW2="SELECT * FROM collection LEFT JOIN staff on collection.staff_id=staff.staff_id WHERE collection.staff_id='$staff_id' ORDER BY collection.col_date desc";
         $colW2=$con->query($colW2);

//chart
              //three tables
            $t3= " SELECT name id wage present tool cost TTdeduction TTwage FROM attendance INNER JOIN `staff` ON staff.staff_id=attendance.staff_id INNER JOIN tools ON tools.t_id=attendance.t_id";
           // $payy= "SELECT s.fname, s.staff_id, s.dailyWage, t.name, t.cost, p.deduction, p.amt from staff s inner join pay_staff ps on s.staff_id = ps.staff_id inner join pay p on p.p_id = ps.p_id INNER JOIN attendance a on a.staff_id=s.staff_id INNER JOIN tools t on t.t_id= a.t_id where s.staff_id = 18 ";

 //Present today
         $empopre="SELECT * FROM staff RIGHT JOIN attendance ON attendance.staff_id=staff.staff_id LEFT JOIN tools on attendance.t_id=tools.t_id WHERE attendance.date=CURDATE()";
         $emponPre = $con->query($empopre);
    //Present Yesterday
         $empopre2="SELECT * FROM staff RIGHT JOIN attendance ON attendance.staff_id=staff.staff_id LEFT JOIN tools on attendance.t_id=tools.t_id WHERE attendance.date >= Date(NOW()) - INTERVAL 1 DAY AND attendance.date  < Date(NOW())";
         $emponPre2 = $con->query($empopre2);
//THIS WEEK ONLY
           $wkAtt= "SELECT * FROM attendance LEFT JOIN staff ON staff.staff_id=attendance.staff_id LEFT JOIN tools on tools.t_id=attendance.t_id WHERE YEARWEEK(`date`, 1) = YEARWEEK(CURDATE(), 1)";
           $wkA=$con->query($wkAtt);
//Last WEEK
           $wkAtt2= "SELECT * FROM attendance LEFT JOIN staff ON staff.staff_id=attendance.staff_id LEFT JOIN tools on tools.t_id=attendance.t_id WHERE YEARWEEK(`date`, 1) = YEARWEEK( CURDATE() - INTERVAL 1 WEEK, 1)";
           $wkB=$con->query($wkAtt2);
//This Month
           $wkAtt3= "SELECT * FROM attendance LEFT JOIN staff ON staff.staff_id=attendance.staff_id LEFT JOIN tools on tools.t_id=attendance.t_id WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())";
           $mtA=$con->query($wkAtt3);
//Last Month
           $wkAtt4= "SELECT * FROM attendance LEFT JOIN staff ON staff.staff_id=attendance.staff_id LEFT JOIN tools on tools.t_id=attendance.t_id WHERE date >= DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01') 
         AND date < DATE_FORMAT(NOW() ,'%Y-%m-01')";
           $mtB=$con->query($wkAtt4);

//---------------------------------------------------------------------------------------------------------------------------------------
    //Collection today
         $empopreC="SELECT * FROM staff RIGHT JOIN collection ON collection.staff_id=staff.staff_id WHERE collection.col_date=CURDATE()";
         $emponPreC = $con->query($empopreC);
    //Collection Yesterday
         $empopre2C="SELECT * FROM staff RIGHT JOIN collection ON collection.staff_id=staff.staff_id WHERE collection.col_date >= Date(NOW()) - INTERVAL 1 DAY AND collection.col_date  < Date(NOW())";
         $emponPre2C = $con->query($empopre2C);
//THIS WEEK ONLY
           $wkAttC= "SELECT * FROM collection LEFT JOIN staff ON staff.staff_id=collection.staff_id WHERE YEARWEEK(`col_date`, 1) = YEARWEEK(CURDATE(), 1)";
           $wkAC=$con->query($wkAttC);
//Last WEEK
           $wkAtt2C= "SELECT * FROM collection LEFT JOIN staff ON staff.staff_id=collection.staff_id WHERE YEARWEEK(`col_date`, 1) = YEARWEEK( CURDATE() - INTERVAL 1 WEEK, 1)";
           $wkBC=$con->query($wkAtt2C);
//This Month
          $wkAtt3C= "SELECT * FROM collection LEFT JOIN staff ON staff.staff_id=collection.staff_id WHERE MONTH(col_date) = MONTH(CURRENT_DATE()) AND YEAR(col_date) = YEAR(CURRENT_DATE())";
           $mtAC=$con->query($wkAtt3C);
//Last Month
           $wkAtt4C= "SELECT * FROM collection LEFT JOIN staff ON staff.staff_id=collection.staff_id WHERE col_date >= DATE_FORMAT(NOW() -    INTERVAL 1 MONTH, '%Y-%m-01') 
         AND col_date < DATE_FORMAT(NOW() ,'%Y-%m-01')";
           $mtBC=$con->query($wkAtt4C);

//Paid today
    $pd="SELECT * FROM staff RIGHT JOIN pay ON staff.staff_id=pay.staff_id WHERE pay.pay_date=CURDATE()";
    $p2d=$con->query($pd);
//Yesterday paid
    $pdy="SELECT * FROM staff RIGHT JOIN pay ON staff.staff_id=pay.staff_id WHERE pay.pay_date >= Date(NOW()) - INTERVAL 1 DAY AND pay.pay_date < Date(NOW())";
    $p2dy=$con->query($pdy);
//Payment this week
    $wkpy="SELECT * FROM staff RIGHT JOIN pay ON staff.staff_id=pay.staff_id WHERE YEARWEEK(`pay_date`, 1) = YEARWEEK(CURDATE(), 1)";
    $pyW=$con->query($wkpy);
//Payment last week
    $lastpy="SELECT * FROM staff RIGHT JOIN pay ON staff.staff_id=pay.staff_id WHERE  YEARWEEK(`pay_date`, 1) = YEARWEEK( CURDATE() - INTERVAL 1 WEEK, 1)";
    $lpy=$con->query($lastpy);

//Pay this month
      $tMth="SELECT * FROM staff RIGHT JOIN pay ON staff.staff_id=pay.staff_id WHERE  MONTH(pay_date) = MONTH(CURRENT_DATE()) AND YEAR(pay_date) = YEAR(CURRENT_DATE())";
    $mpy=$con->query($tMth);
//pay last month
      $tMthB="SELECT * FROM staff RIGHT JOIN pay ON staff.staff_id=pay.staff_id WHERE  pay_date >= DATE_FORMAT(NOW() -    INTERVAL 1 MONTH, '%Y-%m-01') 
         AND pay_date < DATE_FORMAT(NOW() ,'%Y-%m-01')";
    $mpyB=$con->query($tMthB);
//present this week
            // SELECT * FROM attendance WHERE YEARWEEK(`date`, 1) = YEARWEEK(CURDATE(), 1)
           // SELECT * FROM collection WHERE YEARWEEK(`date`, 1) = YEARWEEK(CURDATE(), 1)
//present last week   for more weeks back change interval
           // SELECT * FROM attendance WHERE YEARWEEK(`date`, 1) = YEARWEEK( CURDATE() - INTERVAL 1 WEEK, 1)
           // SELECT * FROM collection WHERE YEARWEEK(`date`, 1) = YEARWEEK( CURDATE() - INTERVAL 1 WEEK, 1)
           
// lAST MONTH
       // SELECT  
       //     DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01') as from_date, 
       //     DATE_FORMAT(NOW() ,'%Y-%m-01') as to_date
       //    FROM attendance
       //      WHERE date >= DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01') 
       //  AND date < DATE_FORMAT(NOW() ,'%Y-%m-01')

//THIS monnth
  // SELECT * FROM attendance WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())
  // SELECT * FROM collection WHERE MONTH(col-date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())


// all payents this week, last wk
// all payents this month, last month
// per employee
        ?>