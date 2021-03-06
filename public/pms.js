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
                url: "changepassword",
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
});