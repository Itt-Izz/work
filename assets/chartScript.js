$(function() {

    $("#more").hide();
    $("#payInfo").hide();
    $("#preTable").hide();
    $("#code").hide();
    $('[data-toggle="tooltip"]').tooltip(); 
    $('[data-toggle="popover"]').popover();


  //Try ajax method
  $('.col_save').click(function(){
    var row=$(this).closest('tr')
    var save=row.find('.tea_collect').val();
    var staf=row.find('.staf').val();
    if($.trim(save) != ''){//trim---remove spaces
      $.ajax({
        url:"php/collect.php",
        method:"POST",
        data: {collect:save, staff:staf},
        success: function(response){
          console.log(typeof response)
         // $("#showMess").html(tea);
         //  $('#showMod').modal();
          swal("Status", response.message);
        }, 
        fail: function(err){
          swal({
            title:"Failed",
            text:"There was an Error when saving this entry",
            type:"warning"});
        }
      });
    }else {
       swal('Oops','Todays value Can not be Empty','error');
      // alert("Empty feeds");
    }
  });

function fun1(){
 swal({
  position: 'top-end',
  type: 'success',
  title: 'Your work has been saved',
  showConfirmButton: false,
  timer: 1500
});}

function fun2(){
    swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
    swal(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
});}

function fun3(){
    swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Poof! Your imaginary file has been deleted!", {
      icon: "success",
    });
  } else {
    swal("Your imaginary file is safe!");
  }
});}

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
        $("#code").show();
    });
 $("#sendCode").mouseleave(function(){
        $("#code").hide();
    });
 //More info on payments
     $(".show").click(function(){
        $('#view').hide();
        $("#more").show();
        $('#pay').hide();
        $("#payInfo").show();
        $('#attTable').hide();
        $("#preTable").show();
    }); $(".bac").click(function(){
        $('#more').hide();
        $("#view").show();
        $('#payInfo').hide();
        $("#pay").show();
        $('#preTable').hide();
        $("#attTable").show();
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
  $('#mytable').dataTable({
    responsive: true
})
  $('#mytable2').dataTable({
    responsive: true
})
  $('#mytable3').dataTable({
    responsive: true
})
  $('#mytable4').dataTable({
    responsive: true
})
  // Chart js implementation --------------------------------------------------------------------------------
  let mychart = document.getElementById('mychart').getContext('2d');
  let massPopChart = new Chart(mychart, {
    type: 'line', //bar,horicontalBar, pie,line ,doughnut, radar, polarArea
    data: {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        datasets: [{
            label: 'employee',
            data: [
            100,
            180,
            105,
            45,
            204,
            163

            ],
            backgroundColor: 'green'
        }]
    },
    options: {}
});


  //pie chart
  let mypie = document.getElementById('mypie');
  let massPoppie = new Chart(mypie, {
    type: 'pie', //bar,horicontalBar, pie,line ,doughnut, radar, polarArea
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Money(Ksh)',
            data: [
            627000,
            163000,
            150000,
            90000,
            60000,
            200000

            ],
            // backgroundColor: 'green'
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
    },
    options: {}
});
  //
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