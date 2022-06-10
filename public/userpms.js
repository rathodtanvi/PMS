$(document).ready(function(){
        $('.changepassword').click(function(e){
            e.preventDefault();
            var current_password=$('#current_password').val();
            var password=$('#password').val();
            var confirm_password=$('#confirm_password').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },    
                type: "post",
                url: "userchangepassword",
                data: {
                    'current_password':current_password,
                     'password':password,
                      'confirm_password':confirm_password,
                     _token: $('meta[name="csrf-token"]').attr('content'),
              },
                dataType: "json",
                success: function (data) {
                    if(data.fail == true)
                    {
                        $('#current_password').keyup(function(){
                            $('.err_current_password').html('');
                        });
                        $('#password').keyup(function(){
                            $('.err_password').html('');
                        });
                        $('#confirm_password').keyup(function(){
                            $('.err_confirm_password').html('');
                        });

                        $('.err_current_password').html(`Please enter current password`);
                        $('.err_password').html(`Please enter password`);
                        $('.err_confirm_password').html(`Please enter confirm password`);
                    }
                    else if(data.match == true)
                    {
                        $('#current_password').keyup(function(){
                            $('.err_current_password').html('');
                        });
                        $('.err_current_password').html(`Your Password does NOT match!`);
                    }
                    else if(data.equl ==true)
                    {
                        $('#confirm_password').keyup(function(){
                            $('.err_confirm_password').html('');
                        });
                        $('.err_confirm_password').html(`New Password is not match!`);
                    }
                    else
                    {
                        $('.data_update').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        Password Updated
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`);
                    }
                    $('#current_password').val('');
                    $('#password').val('');
                    $('#confirm_password').val('');
                },        
            });
        });
     
      $('select.leave_type').change(function(){
        var leave = $(".leave_type option:selected").val();
        if(leave == 1)
        {
            $('.halfday').show();
            $('.todate').hide();
        }
        else{
            $('.halfday').hide();
        }
        if(leave == 2)
        {
            $('.todate').hide();
        }

        if(leave == 3)
        {
            $('.todate').show();
        }
      });

      $("input[type='radio']").change(function(){
      
        if($(this).val()=="hours")
        {
            $("#days").hide(); 
          
           $("#hours").show();
        }
        if($(this).val()=="days")
        {
            $("#hours").hide(); 
        
            $("#days").show();
        }
       
      });

      $('select.project_tl').change(function(){
        $('.empname').html('');
         project_id=$(this).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },  
                type: "post",
                url: "empname",
                data: {
                    'project_id':project_id,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                dataType:"json",
                success: function (result) {
                    $('.empname').html('<option disabled selected value>---select---</option>'); 
                    $.each(result.user,function(key,value){
                        $('.empname').append('<option value="'+value.id+'">'+value.name+'</option>');
                  });
                 }
            });
      });
        

       $('select.project_tl').change(function(){
        project_id=$(this).val();
           $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },  
               type: "post",
               url: "emptl",
               data: {
                'project_id':project_id,
                _token: $('meta[name="csrf-token"]').attr('content'),
               },
               dataType: "json",
               success: function (result) {
                $('.emp_tl').html('<option disabled selected value>---select---</option>'); 
                $.each(result.user,function(key,value){
                    $('.emp_tl').append('<option value="'+value.id+'">'+value.name+'</option>');
              }); 
               }
           });
       });
   
 
       

       $('.change').click(function(){ 
           $(this).add($(this).prevAll("li")).removeClass("fa-star-o").addClass("fa-star").addClass('rating-css');
           $(this).nextAll("li").removeClass("fa-star").removeClass('rating-css').addClass("fa-star-o").addClass('rating');
           $ratingvalue=$(this).attr('id'); 
           $taskid=$('#taskid').text();
            //console.log($taskid);      
           $.ajax({
            type: "GET",
            url: "rating/id",
            data: {
              'ratingvalue':$ratingvalue,
              'taskid':$taskid,
            },
            success: function (response) {
              if(response.status == true)
              {
                $('.message').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
                   Done!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`);
              }
              else
              {
                $('.message').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
                Updated
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>`);
              }
            }
          });
        });
     
        $('#exampleModalCenter').on('click','#close', function () {
            console.log("close");
            // $('.change').addClass('rating-star-o');
          });
       
});


$(document).on("click", ".star", function () {
    var eventId = $(this).data('id');
    //console.log(eventId);
    $('#taskid').html( eventId );
});
    

$(document).on("click", ".star1", function () {
    $taskid=$('#taskid').text();
   // alert(eventId);
    console.log(eventId);
    $.ajax({
        type: "GET",
        url: "ratingdisplay/id",
        data:{
            'taskid':$taskid,
        },
        dataType: "json",
        success: function (response) {
          
        }
    });
});





     



