$(function() {

  $("#PresentToday").hide();
  $("#pay").hide();
  $('[data-toggle="tooltip"]').tooltip(); 
  $('[data-toggle="popover"]').popover();


  //Registration form submission
  $("form[name='uploadForm']").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    var doo=$('').val();
    $.ajax({
      url: "./php/registerStaff.php",
      type: "POST",
      data: formData,
      async: false,
      success: function (msg) {
        if(msg==1){
          swal('Success',"Registration done Successfully ",'success');
                setTimeout(function(){
                     location.reload();
                  }, 200);
        }else if (msg==2) {
         swal('Oooooops','Username already taken!','error');
         $('.form-control').val();
       }else{
         alert('An error occured when registering new staff!')
       }
     },
     error: function(data){
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
                setTimeout(function(){
                     location.reload();
                  }, 200);
            }else if (responses==2) {
              swal('Aborted',"Unable to save that collection, please check your values before submitting",'danger');
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
    alert(staf)
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
                setTimeout(function(){
                     location.reload();
                  }, 200); 
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
          if(resp !==null){
            if(resp==1){
              swal('Success','Update Successful!','success');
     $('.tool').val('')
            }else {
        alert('Please check your values before submitting! Must be between 50 and 2000');
     $('.tool').val('')
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

   //Add a new tool
  $('#addT').click(function(){
    var cost=$('#cost').val();
    var namba=$('#namba').val();
    var tname=$('#nam3').val();
    if($.trim(namba) != '' && $.trim(cost) != ''){
      $.ajax({
        url:"php/addTool.php",
        method:"POST",
        data: {cost: cost, tname: tname, namba: namba},
        success: function(resp){
          console.log(resp)
          if(resp !==null){
            if(resp==1){
              swal('Success','Tool saved Successfully!','success');
     $('.cost').val('')
     $('.namba').val('')
            }else {
        alert('Please check your values before submitting!');
         $('.cost').val('')
         $('.namba').val('')
            }          
          } else {
            swal('Error','An Error occured while saving','danger');
          }
        }
      });
    }else{
     $('#namba').css('border-color', 'red');
     $('#cost').css('border-color', 'red');
     $('#nam').css('border-color', 'red');
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
                setTimeout(function(){
                     location.reload();
                  }, 200);
      }else {
        swal('Aborted','Something wennt wrong','error');
      }  
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
  $('.employeeDetail1').click(function(){
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
         <input type="hidden" value="${resp.staff_id}" id="staf2">
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
         <h5 align="center"><b> Picture ${resp.image}</b></5>
                              <div class="col-md-4 well" id="content">
                                  <div class="col-md-12">
                                  <div id='img_div'>
                                  <img src="img/itt.jpg">
                                  </div>
                                  </div>
                                 </div>
         </div>
         <div class="col-md-3"></div>
         <button class="btn btn-danger pull-right" id="delEmp">Delete - ${resp.staff_id}</button>
         </div>
         </form>

         `);  
      }
    });
  });

  $('#delEmp').click(function(){
    console.log('#delEmp')
      var stId=$('#staf2').val();
      alert(stId)
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




  //More info on payments
  $(".show").click(function(){
    $('#attTable').hide();
    $('#PresentToday').show();
    $('#editThis').hide();
    $('.bac2').hide();

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
    $('#viewC').hide();
    $('#A').hide();

  $("#A").click(function(){
    $('#viewC').hide();
    $('#viewA').show();
    $('#A').hide();
    $('#C').show();
  });$("#C").click(function(){
    $('#viewA').hide();
    $('#C').hide();
    $('#A').show();
    $('#viewC').show();
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
                setTimeout(function(){
                     location.reload();
                  }, 200);
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
                setTimeout(function(){
                     location.reload();
                  }, 200);
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
    if($.trim(msg) !==''){
  $.post('./php/sendSms.php', {msg: msg}, function(response){
    if(response==1){
         swal('Success','SMSs sent successfully!','success');
         $("textarea").val('')
    }else if (response==0) {
         swal('Oops','Check your internet connection Please!','error');
         $("textarea").val('')
    }else{
         swal('Oooops','You can not send a Blank message!','error');
    }
  })
   }else{
         swal('Oooops','You can not send a Blank message!','error');
   }

  });

   //Send sms to all one employee 
  $("#sendOne").click(function(e) {
     e.preventDefault();
    var msg=$.trim($("textarea").val());
    var staf=$.trim($("#emplo").val());
    if($.trim(msg) !==''){
  $.post('./php/sendOne.php', {msg: msg, staf:staf}, function(response){
    if(response==1){
         swal('Success','SMS sent successfully!','success');
         $("textarea").val('')
    }else if (response==0) {
         swal('Oops','Check your internet connection Please!','error');
         $("textarea").val('')
    }else{
         swal('Oops','Please check, something is wrong!','error');
    }
  })

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
        if(msg==1){
          swal('Success','Collection rate Updated Successful!','success');
          $('#rate').val('');
        }else {
         swal('Oooooops','Something went wrong! Please check your value before submiting','error');
         $('#rate').val('');
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
        console.log(msg)
        if(msg==1){
          swal('Success','Wage Updated Successful!','success');
          $('#wag1').val('');
          $('#wag2').val('');
        }else {
         swal('Oooooops','Something went wrong! Please check your values before submiting','error');
          $('#wag1').val('');
          $('#wag2').val('');
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
    var r=confirm("Are you sure to promote this Employee to clerk?");
    if(r==true){
    $.ajax({
      url: "./php/updatePromotion.php",
      type: "POST",
      data: formData,
      async: false,
      success: function (msg) {
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
  }
  });
//Demote Employee 
$("form[name='updateDemotion']").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    var r=confirm("Are you sure to demote this clerk?");
    if(r==true){
    $.ajax({
      url: "./php/updateDemotion.php",
      type: "POST",
      data: formData,
      async: false,
      success: function (msg) {
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
  }
  });

//edit employee details
$('#toolUpdate').hide();
$('#toolAdd').hide();
$('#editEmp').hide();

$('.empAtt').click(function(){
    $('#editEmp').show();
     $('#toolUpdate').hide();
      $('#moreEdit').hide();
      $('#toolAdd').hide();
});

$('#addTool').click(function(){
     $('#toolAdd').show();
     $('#toolUpdate').hide();
      $('#moreEdit').hide();
      $('#editEmp').hide();

});
$('#updateTool').click(function(){
      $('#toolUpdate').show();
      $('#toolAdd').hide();
      $('#moreEdit').hide();
      $('#editEmp').hide();
    });

$('#editMore').click(function(){
      $('#moreEdit').show();
      $('#toolUpdate').hide();
      $('#toolAdd').hide();
      $('#editEmp').hide();

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


  // //Auto refresh 
  // setInterval(function(){
  //      $('#attTable').load("./attendance.php").fadeIn("slow");
  //   }, 1000);


//Notification delete
$('.del').click(function(){
    var row=$(this).closest('tr')
    var del=row.find('.m_id').val();
    var r=confirm("Are you sure to delete this message?");
    if(r==true){
    $.ajax({
      url:"php/deleteIn.php",
      method:"POST",
      data: {del: del},
      success: function(resp){
      console.log(resp) 
       if(resp==1){
        swal('Success','Notification deleted','success');
      }else {
        swal('Aborted','Something went wrong','error');
      }  
    }

  });
  }

});

//delete present
$('.delAtt').click(function(){   
    var row=$(this).closest('tr')
    var stafId=row.find('.stafT').val();
    var r=confirm("Are you sure you want to delete this?")
    if(r==true){
      $.ajax({
      url:"./php/deleteAtt.php",
      method:"POST",
      data: {stafId: stafId},
      success: function(resp){ 
       if(resp==1){
        swal('Success','Deleted Successful!','success');
                setTimeout(function(){
                     location.reload();
                  }, 200);
      }else {
        swal('Aborted','Something wennt wrong','error');
      }  
    }

  });
    }
});


 $('.bac2').click(function(){  
     $('#presentTable').show();
     $('.bac').show();
     $('#editThis').hide();
    $('.bac2').hide();
  })
//edit present
$('.editAtt').click(function(){  
   var row=$(this).closest('tr')
   var nam=row.find('.stafN').val();
   var id=row.find('.stafT').val();
       $('.st').val(nam);
       $('#eStaf').val(id);
     $('#presentTable').hide();
     $('.bac').hide();
     $('#editThis').show();
    $('.bac2').show();


    // var row=$(this).closest('tr')
    // var stafId=row.find('.stafT').val();
    // var r=confirm("Are you sure you want to Edit this?")
    // if(r==true){
    //   alert(ok)
  //     $.ajax({
  //     url:"./php/editAtt.php",
  //     method:"POST",
  //     data: {stafId: stafId},
  //     success: function(resp){ 
  //      if(resp==1){
  //       swal('Success','Update Successful!','success');
  //     }else {
  //       swal('Aborted','Something wennt wrong','error');
  //     }  
  //   }

  // });
    // }
});

$('#colTable').hide();
$('#colT').hide();


$('#tCol').click(function(){
      $('#col5').hide();
      $('#tCol').hide();
      $('#colT').show();
      $('#colTable').show();
});

$('#colT').click(function(){
      $('#col5').show();
      $('#tCol').show();
      $('#colT').hide();
      $('#colTable').hide();
});
//Promote Employee 
$('#changepass').click(function() {
    var pass =$('#password').val();
    var emp =$('#empl').val();
    var r=confirm("Are you sure to change your password?");
    if(r==true){
    $.ajax({
      url: "./php/changePass.php",
      type: "POST",
      data: {pass: pass, emp: emp},
      success: function (msg) {
        if(msg==1){
          swal('Success','Password Changed!','success');
        }else {
    --     swal('Oooooops','Something went wrong!','error');
       }
     }
  });
  }
  });

$('#reports').hide();
$('#showGraph').hide();
$('#hideGraph').click(function(){
     $('#graphs').fadeOut();
     $('#reports').fadeIn();
     $('#showGraph').show();
     $('#hideGraph').hide();
})
$('#showGraph').click(function(){
     $('#reports').fadeOut();
     $('#graphs').fadeIn();
     $('#showGraph').hide();
     $('#hideGraph').show();
})
$('.saveE').click(function(){
     var stafId=$('#eStaf').val();
     var nam=$('.st').val();
     var present=$('#pre').val();
     var tool=$('#t').val();
    var r=confirm("Are you sure to edit this Attendance?");
    if(r==true){
      $.ajax({
      url:"./php/editAtt.php",
      method:"POST",
      data: {stafId: stafId, present:present, tool:tool},
      success: function(resp){ 
        console.log(resp)
       if(resp==1){
        swal('Success','Attendance edited!','success');
                setTimeout(function(){
                     location.reload();
                  }, 200);
      }else if(resp==3){           
        swal('Success','Attendance Deleted!','success');
                setTimeout(function(){
                     location.reload();
                  }, 200);
      }else {
        swal('Aborted','Something wennt wrong','error');
      }  
    }

  });
    }else{      
    }

});


//delete collection
$('.delCol').click(function(){   
    var row=$(this).closest('tr')
    var stafId=row.find('.staf').val();
    var r=confirm("Are you sure you want to delete this?")
    if(r==true){
      $.ajax({
      url:"./php/deleteCol.php",
      method:"POST",
      data: {stafId: stafId},
      success: function(resp){ 
       if(resp==1){
        swal('Success','Deleted Successful!','success');
                setTimeout(function(){
                     location.reload();
                  }, 200);
      }else {
        swal('Aborted','Something went wrong','error');
      }  
    }

  });
    } else{
    }
});

//edit collection
$('.editCol').click(function(){  
   var row=$(this).closest('tr')
   var weight=row.find('.weight').val();
   var stafId=row.find('.staf').val();
    var r=confirm("Are you sure you want to Edit this?")
    if(r==true){
      if($.trim(weight) < 10 || $.trim(weight) > 1000 ){
        alert('Your Value should range from 10 to 1000');
      }else{
      $.ajax({
      url:"./php/editCol.php",
      method:"POST",
      data: {weight:weight, stafId: stafId},
      success: function(resp){ 
        console.log(resp)
       if(resp==1){
        swal('Success','Collection Edited!','success');
                setTimeout(function(){
                     location.reload();
                  }, 200);
      }else if(resp==0) {
            alert("Collection up to date")
      }else if(resp==3) {
            alert("Your values should range from 5 to 1000")
      } else{
        swal('Aborted','Something went wrong','error');
      }  
    }

  }); }
    }
});

$('#bacEmp').hide();
//Edit employee form
$('#edit').hide();
$('#bacEmp').click(function(){
  $('#view').show();
  $('#edit').hide();
  $('#bacEmp').hide();
})

//Edit employee form
$('.employeeDetail').click(function(){
  $('#view').hide();
  $('#edit').show();
  $('#bacEmp').show();
  var row=$(this).closest('tr')
    var empId=row.find('.staff_id').val();
    var fname=row.find('.fname').val();
    var lname=row.find('.lname').val();
    var sex=row.find('.sex').val();
    var birth=row.find('.birthday').val();
    var id=row.find('.id').val();
    var username=row.find('.username').val();
    var phone=row.find('.phone_number').val();
    var loc=row.find('.location').val();
    var level=row.find('.level').val();
    var email=row.find('.email').val();
    var image=row.find('.image').val();
  $('#empId2').val(empId);
  $('#lname').val(lname);
  $('#fname').val(fname);
  $('#sex').val(sex);
  $('#username').val(username);
  $('#birthday').val(birth);
  $('#location').val(loc);
  $('#phoneNo').val(phone);
  $('#id').val(id);
  $('#level').val(level);
  $('#email').val(email);

});                               


 //Alter Registration form submission
  $("form[name='altEmp']").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: "./php/editEmp.php",
      type: "POST",
      data: formData,
      async: false,
      success: function (msg) {
        if(msg==1){
          swal('Success',"Employee edited ",'success');
                setTimeout(function(){
                     location.reload();
                  }, 200);
        }else if (msg==0) {
         alert('Ensure Gender is either Male or Female');
       }else if(msg==3){
         alert('Enter Correct date format e.g. 2012-09-24');
       }else{
         alert('An error occured when saving changes!')
       }
     },
     error: function(data){
    }, 
    cache: false,
    contentType: false,
    processData: false
  });
})

//Delete employee
$('#deleteEmp').click(function(){
  var emp=$('#empId2').val();
  var pass=$('#pass').val();
    var r=confirm("Are you sure you want to delete this?")
    if(r==true){
     var c=confirm('You need your password  to delete an employee, Do you steel want to delete the employee?')
        if(c==true){

     var p=prompt('Please enter your password');
     if (p == pass) {
      $.ajax({
      url:"./php/deleteEmployee.php",
      method:"POST",
      data: { stafId: emp},
      success: function(resp){ 
        console.log(resp)
       if(resp==1){
        swal('Success','Employee deleted!','success');
                setTimeout(function(){
                     location.reload();
                  }, 200);
      } else{
        swal('Aborted','Something went wrong','error');
      }  
    }
  });
    } else {
        alert('Invalid password!')
    }        }
    }
})


});//End of jquery file ................................................................................................................................