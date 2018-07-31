$(function() {

    $("#PresentToday").hide();
    $("#pay").hide();
    $('[data-toggle="tooltip"]').tooltip(); 
    $('[data-toggle="popover"]').popover();


  //Ajaxalert collections
  $('.col_save').click(function(){
    var row=$(this).closest('tr')
    var save=row.find('.tea_collect').val();
    var staf=row.find('.staf').val();
    if($.trim(save) != ''){//trim---remove spaces
      $.ajax({
        url:"php/collect.php",
        method:"POST",
        data: {collect:save, staff:staf},
        success: function(responses){
          if(responses !== null){
            if(responses==1){
              swal('Success',"Collection saved Successfully ",'success');
            }else if (responses==2) {
              swal('Aborted',"Unable to save that collection",'danger');
              
            }else{
       swal('Oooooooooops','Employee Collection already taken!','error');
            }
          } else{
              swal('Aborted',"Unable to save that collection",'danger');
        }
      }
      });
    }else {
         $(this).closest('tr').find('.tea_collect').css('border-color', 'red');
      }
  });
  //Ajaxalert Attendance
  $('.btnS').click(function(){
    var row=$(this).closest('tr')
    var tool=row.find('.tool').val();
    var staff=row.find('.staff').val();
    if(row.find('.check').is(':checked')){
      $.ajax({
        url:"php/attendance.php",
        method:"POST",
        data: {staff:staff, tool: tool},
        success: function(resp){
          if(resp !==null){
            if(resp==1){
              swal('Success','Employee Saved Successfully!','success');
            }else {
              swal('Aborted','Employee already marked as present','error');
            }          
        } else {
          swal('Error','An Error occured while saving','danger');
        }
          }
      });
    }else{
              swal('Aborted','Check as present before saving','error');
        }
    });
//Update tools cost
  $('.updateCost').click(function(){
    var row=$(this).closest('tr')
    var tool=row.find('.tool').val();
    var tname=row.find('.tname').val();
    if($.trim(tool) != ''){
      $.ajax({
        url:"php/updateTools.php",
        method:"POST",
        data: {tool: tool, tname: tname},
        success: function(resp){
          console.log(resp);
          if(resp !==null){
            if(resp==1){
              swal('Success','Update Successful!','success');
            }else {
              swal('Aborted','Something wennt wrong','error');
            }          
        } else {
          swal('Error','An Error occured while saving','danger');
        }
          }
      });
    }else{
         $(this).closest('tr').find('.tool').css('border-color', 'red');
        }
    });

//Mark tool as returned 
  $('.retanT').click(function(){
    var row=$(this).closest('tr')
    var stafId=row.find('.stafT').val();
      $.ajax({
        url:"php/returnTool.php",
        method:"POST",
        data: {stafId: stafId},
        success: function(resp){ 
           if(resp==1){
              swal('Success','Update Successful!','success');
            }else {
              swal('Aborted','Something wennt wrong','error');
            }  
              swal('Failure','Encountered an error!','error');
          }

      });
    });


   //Show each employees info 
  $('.employeeDetails').click(function(){
    var row=$(this).closest('tr')
    var empId=row.find('.staff_id').val();
      $.ajax({
        url:"php/emp.php",
        method:"POST",
        data: {empId: empId},
        // dataType:'json',
        success: function(resp){
          resp=JSON.parse(resp);
$.post(resp, function(returnedData) {
    // do something here with the returnedData
    console.log(returnedData);
});

          console.log(resp)
        $("#emp").modal('show');
        $("#getMsg").html(`
           <form>
            Name : <label class="form-group form-control ">${resp.fname}</label><br>
         Registration No : <label class="form-group form-control"> ${resp.staff_id}</label><br>
          <label class="form-group form-control">Gender : ${resp.sex}</label><br>
          <label class="form-group form-control">Date of Birth : ${resp.birthday}</label><br>
          <label class="form-group form-control">Username: ${resp.username}</label><br>
          <label class="form-group form-control">Date of Birth : ${resp.birthday}</label><br>
          <label class="form-group form-control">level: ${resp.level}</label><br>
          <label class="form-group form-control">ID Number : ${resp.id_number}</label><br>
          <label class="form-group form-control">Date Registered: ${resp.date_registered}</label><br>
          <label class="form-group form-control">Image: &nbspc; ${resp.image}</label><br>
           </form>
          
         `);  
          }
      });
    });

$('#printPay').click(function(){
   var divToPrint=document.getElementById("print_content");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();

   });
$('#printCol').click(function(){

   var divToPrint=document.getElementById("print_collection");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();

   });
$('#printEmp').click(function(){
  var divToPrint=document.getElementById("mytable3");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
   });



$("#phoneNo").on({
    mouseleave: function(){
    var bla = $('#phoneNo').val();
        $('#inp[type=text]').val(bla);
    }

});

    //Datepicker
    $("#datepicker").datepicker({
        autoclose:true,
        todayHighlight:true
    }).datepicker('update', new Date());
//Sweetalert
$('#btn').submit(function(){
      swal({
            title:"Confirmation",
            text:"Are You Sure?",
            button:{
                showCancelButton: true,
                closeOnConfirm: true,
                confirm: "Submit"
            }
      }).then(val => {
        if(val){
            swal({
                title:"Thanks!",
                text:"You typed: " +val,
                icon:"Success"
            });
        }
      });
});



 $("#sendCode").click(function(){
    var no = $('#inp').val();
        if(no != ''){
          $("#code").show();
        }else{
          alert("No Number please")
        }
    });

 //More info on payments
     $(".show").click(function(){
        $('#attTable').hide();
        $('#PresentToday').show();
    }); $(".bac").click(function(){
        $('#PresentToday').hide();
        $("#attTable").show();
    });
      $("#allC").click(function(){
        $('#singlePay').hide();
        $('#pay').show();
    });
        $("#allS").click(function(){
        $('#pay').hide();
        $('#singlePay').show();
  });
        $(".payWage").click(function(){
    var row=$(this).closest('tr')
    var stafId=row.find('.staf').val();
    var deduct=row.find('.ded').val();
    var amt=row.find('.total').val();
      $.ajax({
        url:"php/payAtt.php",
        method:"POST",
        data: {stafId: stafId, deduct:deduct, amt:amt},
        success: function(resp){ 
           if(resp==1){
              swal('Success','Update Successful!','success');
            }else {
              swal('Aborted','Something wennt wrong','error');
            }  
          }

      });
  });

      $(".payCol").click(function(){
    var row=$(this).closest('tr')
    var stafId=row.find('.staff').val();
    var amt=row.find('.amount').val();
      $.ajax({
        url:"php/payCol.php",
        method:"POST",
        data: {stafId: stafId, amt:amt},
        success: function(resp){ 
           if(resp==1){
              swal('Success','Update Successful!','success');
            }else {
              swal('Aborted','Something wennt wrong','error');
            }  
          }

      });
  });
    //File preview Load image from pc to DOM
    function filePreview(input){
        if(input.files && input.files[0]){
            var reader=new FileReader();
            reader.onload=function(e){
              console.log('reader');
              $('#uploadForm + img').remove();
              $('#img_div').html('<img src="'+e.target.result+'" width ="450" height = "300"/>');
          }
          reader.readAsDataURL(input.files[0]);
      }
  }

  $('#file').change(function(){
    filePreview(this);
});
  // DataTables implementation --------------------------------------------------------------------------------
  $('#print_content').dataTable({
    responsive: true
})
  $('#mytable2').dataTable({
    responsive: true
})
  $('#mytable3').DataTable({
    responsive: true,
     dom: 'lBfrtip',
        buttons: ['pageLength','copy', 'pdf', 'csv', 'excel' ]
})
  $('#mytable4').dataTable({
    responsive: true
})
  $('#print_collection').dataTable({
    responsive: true
})

 

  //pie chart
//   let mypie = document.getElementById('mypie');
//   let massPoppie = new Chart(mypie, {
//     type: 'pie', //bar,horicontalBar, pie,line ,doughnut, radar, polarArea
//     data: {
//         labels: ['January', 'February', 'March', 'April', 'May', 'June'],
//         datasets: [{
//             label: 'Money(Ksh)',
//             data: [
//             627000,
//             163000,
//             150000,
//             90000,
//             60000,
//             200000

//             ],
//             // backgroundColor: 'green'
//             backgroundColor: [
//             'rgba(255,99,132,0.6)',
//             'rgba(255,162,235,0.6)',
//             'rgba(255,206,86,0.6)',
//             'rgba(75,192,192,0.6)',
//             'rgba(153,102,255,0.6)',
//             'rgba(255,159,64,0.6)',
//             'rgba(255,99,132,0.6)'
//             ]
//         }]
//     },
//     options: {}
// });
  //Graph and date from Db
  $.ajax({
    url: "http://localhost/work/stats.php",
    type: "GET",
    success: function(data){
        var cost={
        };
        var len=data.length;
        for (var i=0; i<len; i++){
            if(data[i].team=="TeamA"){}
         }
    },
    error: function(data){
    }
  });


});