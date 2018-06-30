$(function() {

    $("#more").hide();
    $("#payInfo").hide();
    $("#preTable").hide();
    $('[data-toggle="tooltip"]').tooltip(); 
    $('[data-toggle="popover"]').popover(); 
//
$('#button-a').click(function(){
      swal({
            title:"Confirmation",
            text:"Are You Sure?",
            type: "input",
            button:{
                showCancelButton: true,
                closeOnConfirm: false,
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
  let mypie = document.getElementById('mypie').getContext('2d');
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
  // Chart js implementation --------------------------------------------------------------------------------
  let mybar = document.getElementById('mybar').getContext('2d');
  let massPopBar = new Chart(mybar, {
    type: 'bar', //bar,horicontalBar, pie,line ,doughnut, radar, polarArea
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
            backgroundColor: 'blue'
        }]
    },
    options: {}
});

});