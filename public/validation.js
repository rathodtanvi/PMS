$(document).ready(function(){
    $("#holidayadd").validate({
        rules: {
            name: "required",
            start_date: "required",
            end_date: "required",    
        },
        messages: {
            name: "Holiday name is required",
        }
    });

    $("#employeeadd").validate({
        rules: {
            name: {
                required: true,
                maxlength: 225,
            },
            email: {
                required: true,
                email: true,
                maxlength: 225,    
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {   
                required: true, 
                minlength : 8,
                equalTo : "#password"
            },
            mobile_number:{
                required: true,
                minlength : 10,
             
            },
            dob: {
                required: true,
                date: true,
            },
            joining_date:"required",
            gender:"required",
            qualification:"required",
            address: {
                required: true,
            },
        },
        messages: {
            name: "Name is required",
            email: {
                required: "Email is required",
                email: "Email must be a valid email address",
            },
            password:{
                required: "Password is required",
                minlength:"Password minimum 8 character",
            },
            password_confirmation: {
                required:  "Confirm password is required",
                equalTo: "Password and confirm password should same"
            },
            mobile_number:{
                required:  "Mobile number is required",
                minlength : "Mobile number minimum 10 digit",
            },
            dob: {
                required:  "Mobile number is required",
            },
            joining_date:"Joining date is required",
            gender:"Gender is required",
            qualification:"Qualification is required",
            address: {
                required: "Address is required", 
            },
        },
        errorPlacement: function(error, element) 
        {
            if ( element.is(":radio")) 
            {
                error.appendTo(element.parents('.container')).before('<br>');
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
         }
    });
    $("#leaveadd").validate({
        ignore: [],
        debug: false,
        rules: {
            leave_type: "required",
            half_leave_type:"required",
            date_start:"required",
            message:{
                required: function() 
               {
                CKEDITOR.instances.message.updateElement();
               },
                minlength:10
           }
           
        },
        messages: {
            leave_type: "Leave type is required",
            half_leave_type:"Half leave is required",
            date_start:"Date is required",
            message:{
                required:"message is required",
            }
        },
        errorPlacement: function(error, element) 
        {     
        if ( element.attr("id") == "message") 
        {
            error.appendTo(element.parents('.container'));
        }
        else 
        {
            error.insertAfter( element );
        }
    }
    
    });
    //  CKEDITOR.instances.message.on("change",function(){
    //      $('#message-error').text('');
    // });
    $("#dailyworkentryadd").validate({
        ignore: [],
        debug: false,
        rules: {
            project_id: "required",
            entry_date: "required",
            entry_duration_hours:{
                required: true,
            },
            entry_duration_minutes:"required",
            description:{
                required: function() 
               {
                CKEDITOR.instances.description.updateElement();
               },
                minlength:10
           }
        },
        messages: {
            project_id: "Project name is required",
            entry_date:"Date is required",
            entry_duration_hours:"Hours is required",
            entry_duration_minutes:"Minutes is required",
            description:{
            required:"Description is required",
              
            }
        },
         errorPlacement: function(error, element) 
            {     
            if ( element.attr("id") == "description") 
            {
                error.appendTo(element.parents('.container'));
            }
            else 
            {
                error.insertAfter( element );
            }
        },
      
    });
     CKEDITOR.instances.description.on("change",function(){
           $('#description-error').text('');
     });

    $("#TaskAllotmentadd").validate({
        ignore: [],
       debug: false,
        rules: {
            project_id: "required",
            title: "required",
            days_txt: {
                required: '#hours_txt:blank',
           },
           hours_txt: {
            required: '#days_txt:blank',
           },
            description:{
                required: function() 
               {
                CKEDITOR.instances.description.updateElement();
               },
                minlength:10
           }
        },
        messages: {
            project_id: "Project name is required",
            title:"Title is required",
            days_txt:"Days is required",
            hours_txt:"Hours is required",
            description:{
                required:"Description is required",
                }
        },
        errorPlacement: function(error, element) 
        {     
        if ( element.attr("id") == "description") 
        {
            error.appendTo(element.parents('.container'));
        }
        else 
        {
            error.insertAfter( element );
        }
     }
    });
});