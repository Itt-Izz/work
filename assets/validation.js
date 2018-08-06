$(function(){
   $.validator.setDefaults({
    errorClass:'help-block',
      highlight:function(element){
        $(element)
        .closest('.form-group')
        .addClass('has-error');
      },
       unhighlight:function(element){
        $(element)
        .closest('.form-group')
        .removeClass('has-error');
      },
      errorPlacement:function(error,element){
        if(element.prop('type')==='radio'){
          error.insertAfter(element.parent());
      }else{
        error.insertAfter(element);
      }
     }
   });
//Phone number 11 digits and start with 07
$.validator.addMethod("phoneNo", function(value, element) { 
  return this.optional(element) || /^07\d{8}$/.test(value); 
}, "* Must be 11 digits and begin with 07");
   //Validate new Number
   $.validator.addMethod("regex",function(value, element, regexp) {
        var re = new RegExp(regexp);
        return re.test(value);
    },
    "Please check your input."
);
//strong password method
  $.validator.addMethod('strongPassword', function(value, element){
      return this.optional(element)
      || value.length >= 6
      && /\d/.test(value)
      && /[a-z]/i.test(value);
  }, 'Your password must be at least 6 charaters long and contain at least one number and one char\'.')
   
//Form validation
   $('#uploadForm').validate({
       rules:{
        collect:{
          required:true,
          nowhitespace:true,
          lettersonly:true
        },
      	email:{
      		email:true      	
        },
      	password: {
          required: true,
          strongPassword:true
        },
        password2: {
          required: true,
          equalTo:"#password"
        },
        id:{
          required:true
         },
         phone:{
          phoneNo: true
         },
         gender:{
           required:true
         },
         birthday:{
           required:true
         },
         location:{
             required:true
         },
         type:{
           required:true
         },
        fname:{
          required:true,
          nowhitespace:true,
          lettersonly:true
        },
        uname:{
          required:true,
          nowhitespace:true,
          lettersonly:true
        },
        lname:{
          required:true,
          nowhitespace:true,
          lettersonly:true

        }
      },
      messages:{
      	email:{
      		email:'Please enter a <em>valid</em> email address if any.'
          // remote: $.validator.format("{0} already exist.")
        },
        phone:{
          phoneNo: "Anza na 07...Na iwe 10digits pekee!"
        }
      }

  });

function validatePhone(phone){
  phone=phone.replace(/[^0-9]/g,'');
  $("#phonefield").val(phone);
  if(phone ==''|| !phone.match(/^0[0-9]{9}$/)){
    $()
  }
}
});