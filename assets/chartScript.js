$(function() {

  $("#PresentToday").hide();
  $("#pay").hide();
  $('[data-toggle="tooltip"]').tooltip(); 
  $('[data-toggle="popover"]').popover();


  //Registration form submission
  $("form[name='uploadForm']").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: "./php/registerStaff.php",
      type: "POST",
      data: formData,
      async: false,
      success: function (msg) {
        console.log(msg);
        if(msg==1){
          swal('Success',"Registration done Successfully ",'success');
        }else if (msg==2) {
         swal('Oooooops','Username already taken!','error');
       }else{
         alert('An error occured when registering new staff!')
       }
     },
     error: function(data){
      console.log(data);
    },
    cache: false,
    contentType: false,
    processData: false
  });

  });
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
              $('.tea_collect').val("");
              $('.tea_collect').css('border-color', 'lightgrey');
            }else if (responses==2) {
              swal('Aborted',"Unable to save that collection",'danger');
              $('.tea_collect').val("");
              $('.tea_collect').css('border-color', 'lightgrey');
            }else{
             swal('Oooooooooops','Employee Collection already taken!','error');
             $('.tea_collect').val("");
              $('.tea_collect').css('border-color', 'lightgrey');
           }
         } else{
          swal('Aborted',"Unable to save that collection",'danger');
          $('.tea_collect').val("");
              $('.tea_collect').css('border-color', 'lightgrey');
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
              $('.check').prop('checked',false);
            }else {
              swal('Aborted','Employee already marked as present','error');
              $('.check').prop('checked',false);
            }          
          } else {
            swal('Error','An Error occured while saving','danger');
            $('.check').prop('checked',false);
          }
        }
      });
    }else{
      swal('Aborted','Check as present before saving','error');
      $('.check').prop('checked',false);
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
      url:"./php/returnTool.php",
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

//Show message detail
$('#mes').hide();
$('.viewMessage').click(function(){
    var row=$(this).closest('tr')
    var m_id=row.find('.m_id').val();
    var sub=row.find('.subject').val();
    var mes=row.find('.message').val();
    var date=row.find('.date').val();
    var nam=row.find('.name').val();
    $.ajax({
      url:"php/readMsg.php",
      method:"POST",
      data: {m_id: m_id},
      success: function(resp){ 
    }

  });
    $('#inBody').hide();
    $('#mes').show();
    $('#mes1').val(mes);
    $('#sub1').val(sub);
    $('#name1').val(nam);
    $('#to').val(nam);
    $('#date1').val(date);

});
// back to Show message detail
$('.bac').click(function(){
    $('#mes').hide();
    $('#inBody').show();
    $('#repMes').hide();

});
// back to Show message detail
$('.del').click(function(){
    alert('Delete?????');
});
// update notification
$('#notify').click(function(){
    $.ajax({
      url:"php/viewNotification.php",
      method:"POST",
      success: function(resp){ 
    }

  });
});
// reply message detail
    $('#repMes').hide();
 $('#rep').click(function(){
    $('#mes').hide();
   $('#repMes').show();
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
        });

        $("#emp").modal('show');
        $("#getMsg").html(`
          <h3 align="center"><b>Employee details</b></h3>
         <form>
         <div class="col-md-12">
         <div class="col-md-2"></div>
         <div class="col-md-4"><br>
         First Name : <label class="form-group">${resp.fname}</label><br>
         Last Name : <label class="form-group">${resp.lname}</label><br>
         Registration No : <label class="form-group"> ${resp.staff_id}</label><br>
         Gender : <label class="form-group"> ${resp.sex}</label><br>
         Date of Birth :<label class="form-group"> ${resp.birthday}</label><br>
         Username: <label class="form-group">${resp.username}</label><br>
         level:<label class="form-group"> ${resp.level}</label><br>
         ID Number :<label class="form-group"> ${resp.id_number}</label><br>
        Location: <label class="form-group"> ${resp.location}</label><br>
        Date Registered: <label class="form-group"> ${resp.date_registered}</label><br>
         </div>
         <div class="col-md-3">
         <label class="form-group"> ${resp.image}</label><br>
         <h5 align="center"><b> Picture</b></5>
                              <div class="col-md-4 well" id="content">
                                  <div class="col-md-12">
                                  <div id='img_div'>
                                  </div>
                                  </div>
                                 </div>
         </div>
         <div class="col-md-3"></div>
         </div>
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
        swal('Aborted','Something went wrong','error');
      }  
    }

  });
  });

  //give feedback message
   $("#sendFeed").click(function(){
    alert('Thank you for your comment.');
  });

  //Send one sms
  $("form[name='smsForm']").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: "./php/sendMessage.php",
      type: "POST",
      data: formData,
      async: false,
      success: function (msg) {
        console.log(msg);
        if(msg==1){
          swal('Success','Message sent Successful!','success');
        }else {
         swal('Oooooops','something went wrong!','error');
       }
     },
     error: function(data){
    },
    cache: false,
    contentType: false,
    processData: false
  });

  });

  //Send sms to all employees 
  $("#sendMore").click(function(e) {
     e.preventDefault();
    var msg=$.trim($("textarea").val());
    alert(msg);
    if($.trim(msg) !==''){
    $.ajax({
      url: "php/sendMore.php",
      type: "POST",
      data: {message: msg},
      datatype: "text",
      success: function (msg) {
        console.log(msg)
        if(msg==1){
          swal('Success','Messages sent Successful!','success');
        }else {
         swal('Oooooops','something went wrong!','error');
       }
     },
     error: function(data){
    },
    cache: false,
    contentType: false,
    processData: false
  });
   }else{
         swal('Oooops','You can not send a Blank message!','error');
   }

  });

  //Update collection readAsText(//Send one sms
  $("form[name='colForm']").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: "./php/updateColrate.php",
      type: "POST",
      data: formData,
      async: false,
      success: function (msg) {
        console.log(msg);
        if(msg==1){
          swal('Success','Collection rate Updated Successful!','success');
        }else {
         swal('Oooooops','Something went wrong! Please check your value before submiting','error');
       }
     },
     error: function(data){
    },
    cache: false,
    contentType: false,
    processData: false
  });

  });


  //Update Employee payWage 
$("form[name='updateWage']").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: "./php/updateWage.php",
      type: "POST",
      data: formData,
      async: false,
      success: function (msg) {
        if(msg==1){
          swal('Success','Wage Updated Successful!','success');
        }else {
         swal('Oooooops','Something went wrong! Please check your values before submiting','error');
       }
     },
     error: function(data){
    },
    cache: false,
    contentType: false,
    processData: false
  });

  });
//Promote Employee 
$("form[name='updatePromotion']").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    console.log(formData);
    $.ajax({
      url: "./php/updatePromotion.php",
      type: "POST",
      data: formData,
      async: false,
      success: function (msg) {
        console.log(msg);
        if(msg==1){
          swal('Success','Updated Successful!','success');
        }else {
         swal('Oooooops','Something went wrong! Please check your values before submiting','error');
       }
     },
     error: function(data){
    },
    cache: false,
    contentType: false,
    processData: false
  });

  });

//edit employee details
$('#editEmp').hide();
$('#empEdit').click(function(){
$('#editEmp').show();
});


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



  //File preview Load image from pc to DOM
  function filePreview(input){
    var file=input.files[0];
    var fileType=file["type"];
    var validImaageType=["image/gif","image/png","image/jpg", "jpeg"]
    if(input.files && input.files[0]){
      console.log(validImaageType);
      if($.inArray(fileType, validImaageType) < 0){
        alert('Error! Only JPG, JPEG or PNG files allowed!');
    }else{
          var reader=new FileReader();
          reader.onload=function(e){
            $('#uploadForm + img').remove();
            $('#img_div').html('<img src="'+e.target.result+'" width ="450" height = "300"/>');
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
  }


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


  //Auto refresh 
  // setInterval(function(){
      // $('#mytable2').load("./attendance.php").fadeIn("slow");
  // }, 1000);


});