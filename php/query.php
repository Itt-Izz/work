<?php
        $staff_id = $_SESSION['staff_id'];
        $qr = mysql_query("SELECT * FROM staff WHERE staff_id = '$staff_id'");
        

        $qry2 = "SELECT count(*) FROM staff";
        $run2 =  $con->query($qry2);

        $qry3 = "SELECT *, count(*) FROM staff GROUP BY sex";
        $run3 =  $con->query($qry3);

        $qry4 = "SELECT *, count(*) FROM staff GROUP BY position";
        $run4 =  $con->query($qry4);

        $qry5 = "SELECT *, count(*) FROM staff GROUP BY department";
        $run5 =  $con->query($qry5);
        
         $q="SELECT count(*) FROM message WHERE dest_id ='$staff_id' AND Msg_read = 1";
         $mesNo = $con->query($q);

         $all="SELECT * FROM staff WHERE staff_id = 35";
         $allD = $con->query($all);

         $emp="SELECT `staff_id`, `fname`, `sex`, year(birthday), `department`, `position`, `username`, `password`, `date_registered`, `id_number`, `phone_number`, `level`, `dailyWage`, `image` FROM `staff` WHERE `level`!= 'admin'";
         $employe = $con->query($emp);

         $empW="SELECT * FROM staff WHERE `level`!= 'admin' AND `level`!= 'clerk'";
         $employ = $con->query($empW);

         $empAll="SELECT * FROM staff";
         $empA = $con->query($empAll);
         $allEmpRow=$empA->fetch_assoc();

        
         $sl="SELECT image FROM staff where staff_id='$staff_id'";
         $img=$con->query($sl);

         $out="SELECT * FROM message LEFT JOIN staff on staff.staff_id=message.staff_id where message.dest_id='$staff_id'";
         $outbox=$con->query($out);

         $in="SELECT * FROM message LEFT JOIN staff on staff.staff_id=message.staff_id where message.staff_id='$staff_id'";
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
              $collection="SELECT * FROM collection INNER JOIN staff ON staff.staff_id=collection.staff_id";
              $col=$con->query($collection);
              $collectW="SELECT sum(weight) as weight FROM collection LEFT JOIN staff ON staff.staff_id=collection.staff_id";

              $sumWeight=$con->query($collectW);

//chart


              //three tables
            $t3= " SELECT name id wage present tool cost TTdeduction TTwage FROM attendance INNER JOIN `staff` ON staff.staff_id=attendance.staff_id INNER JOIN tools ON tools.t_id=attendance.t_id";
           $payy= "select s.fname, s.staff_id, s.dailyWage, t.name, t.cost, p.deduction, p.amt from staff s inner join pay_staff ps on s.staff_id = ps.staff_id inner join pay p on p.p_id = ps.p_id INNER JOIN attendance a on a.staff_id=s.staff_id INNER JOIN tools t on t.t_id= a.t_id where s.staff_id = 18 ";


     $pa= "select s.fname, s.staff_id, s.dailyWage, t.name, a.present, t.name, t.cost
                from staff s LEFT JOIN attendance a on a.staff_id=s.staff_id
                  LEFT JOIN tools t on t.t_id= a.t_id group by s.staff_id";
    $pay=$con->query($pa);

              
// dates this week 
//                SET DATEFIRST 1 -- Define beginning of week as Monday
//                  SELECT [...]
//                 AND WorkDate >= dateadd(day, 1-datepart(dw, getdate()), CONVERT(date,getdate())) 
//                 AND WorkDate <  dateadd(day, 8-datepart(dw, getdate()), CONVERT(date,getdate()))

        ?>