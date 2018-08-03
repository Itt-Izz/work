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
    var message=$.trim($("textarea").val());
    alert(message);
    if($.trim(message) !==''){
    $.ajax({
      url: "./php/sendSms.php",
      type: "POST",
      data: {message: message},
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
         swal('Oooops','You can not sent a Blank message!','error');
   }

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


  //check image before uploading
  (function($) {
    $.fn.checkFileType = function(options) {
      var defaults = {
        allowedExtensions: [],
        success: function() {},
        error: function() {}
      };
      options = $.extend(defaults, options);

      return this.each(function() {

        $(this).on('change', function() {
          var value = $(this).val(),
          file = value.toLowerCase(),
          extension = file.substring(file.lastIndexOf('.') + 1);

          if ($.inArray(extension, options.allowedExtensions) == -1) {
            options.error();
            $(this).focus();
          } else {
            options.success();
          }
        });
      });
    };
  })

  //File preview Load image from pc to DOM
  function filePreview(input){
    if(input.files && input.files[0]){
      if((input.files[0]['type'].trim() !== 'image/jpeg') || (input.files[0]['type'].trim() !== 'image/png') || (input.files[0]['type'].trim() !== 'image/jpg')){
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


});