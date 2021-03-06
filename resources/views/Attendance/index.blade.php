@extends('layouts.index')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1> Attendance </h1>
    </div>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Attendance</li>
        </ol>
    </nav>
    <div class="error"></div>
    <div class="card ">
        <div class="card-body">

            <center>
                <h3 class="h3tag"> Attendance on {{date('d-m-Y')}} </h3><br/>
                
                @if ($attendance->isEmpty())
                    <div class="mydiv" style="margin-bottom:5px;"> </div>
                    <div style="margin-bottom:5px;"> <button type="button" class="btn btn-success btn-sm active btn-inentry" style="font-size:18px;"><i class="fa fa-sign-in"></i> In Entry </button>
                    <button type="button" style="display:none;font-size:18px;" class="btn btn-danger btn-sm inactive btn-outentry" > Out Entry <i class="fa fa-sign-out"></i> </button></div>
                    
                @else
                    <div class="mydiv" style="margin-bottom:5px;"> </div>
                    @if($getlatest->out_entry != Null)

                        <div style="margin-bottom:5px;"><button type="button" class="btn btn-success btn-sm active btn-inentry" style="font-size:18px;"><i class="fa fa-sign-in"></i> In Entry </button>
                        <button type="button" style="display:none;font-size:18px;" class="btn btn-danger btn-sm inactive btn-outentry"> Out Entry <i class="fa fa-sign-out"></i> </button></div>
                        
                    @endif
                    @foreach ($attendance as $row)
                        <div style="margin-bottom:5px;"><button type="button" class="btn btn-success btn-sm active btn-inentry" style="font-size:18px;" disabled="disabled"><i class='fa fa-clock-o'> </i> {{$row->in_entry}} </button>
                        
                        @if ($row->out_entry == Null)
                            <button type="button" class="btn btn-danger btn-sm inactive btn-outentry" style="font-size:18px;"> Out Entry <i class="fa fa-sign-out"></i> </button>
                        @else
                            <button type="button" class="btn btn-danger btn-sm inactive btn-outentry" style="font-size:18px;" disabled="disabled"><i class='fa fa-clock-o'> </i> {{$row->out_entry}} </button>
                            
                        @endif
                    </div>
                    @endforeach
                    
                @endif
                
                <br/>
                <button type="button" class="btn-workinhours btn btn-primary" style="font-size:18px;"> Workibg Hour : <i class="fa fa-clock-o"></i> 00:00:00 </button>
                
            </center>
        </div>
    </div>

    {{-- <div class="modal fade" id="verticalycentered" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <center><i class="fa fa-exclamation-circle" style="font-size:50px;color:rgb(233, 177, 23);margin:15px"></i></center>
                <div class="modal-body">
                    Are You Sure You want to <span id="disp_inout">  </span>?
                </div>
                <span class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> No </button>
                    <button type="button" class="btn btn-primary" id="btn-yes"> Yes </button>
                </span>
            </div>
            </div>
        </div> --}}<!-- End Vertically centered Modal-->
</main>

<script>

    $("body").on("click",".btn-inentry",function(){
        var tr = $(this).closest("div");
        
        swal({
            //title: "Delete?",
            text: "Are You Sure You want to In ?",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            reverseButtons: !0
        }).then(function (e) 
        {
            if (e.value === true) 
            {
                
                $.ajax
                ({
                    url: "{{url('addatendance')}}",
                    type: "GET",
                    dataType: "json",
                    success: function(res)
                    {
                        $.each(res,function(Index,value)
                        {
                            tr.find(".btn-inentry").html("<i class='fa fa-clock-o'></i> " + value);
                            $(".btn-inentry").attr("disabled","disabled");
                            $(".btn-outentry").show();
                            
                        });
                    }
                });   
            } 
            else 
            {
                e.dismiss;
                if(res.success == true)
                {
                    $('.error').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
                      Today Holiday
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`);
                }
                else
                {
                    $.each(res,function(Index,value)
                   {
                    tr.find(".btn-inentry").html("<i class='fa fa-clock-o'></i> " + value);
                    $(".btn-inentry").attr("disabled","disabled");
                    $(".btn-outentry").show();
                });
                }
               
            }

        }, 
        function (dismiss) 
        {
            return false;
        });    
    });

    $("body").on("click",".btn-outentry",function()
    {
        var tr = $(this).closest("div");
        var starttime = tr.find(".btn-inentry").text();
        $('#disp_inout').html("Out");
        
        swal({
            //title: "Delete?",
            text: "Are You Sure You want to Out ?",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            reverseButtons: !0
        }).then(function (e) 
        {
            if (e.value === true) 
            {
            $.ajax
            ({
                url: "{{url('outatendance')}}",
                type: "GET",
                dataType: "json",
                data: {stime : starttime },
                success: function(res)
                {
                    $.each(res,function(Index,value)
                    {
                        tr.find(".btn-outentry").html("<i class='fa fa-clock-o'></i> " + value);
                        $(".btn-outentry").attr("disabled","disabled");
                        $(".mydiv").prepend('<div style="margin-bottom:5px;"><button type="button" class="btn btn-success btn-sm active btn-inentry" style="font-size:18px;"><i class="fa fa-sign-in"></i> In Entry </button>  <button type="button" style="display:none;font-size:18px;" class="btn btn-danger btn-sm inactive btn-outentry" > Out Entry <i class="fa fa-sign-out"></i> </button></div>');
                        
                    });
                }
            });
        } 
            else 
            {
                e.dismiss;
            }

        }, 
        function (dismiss) 
        {
            return false;
        });  
    });

    window.onload = function () 
	{
        $.ajax
        ({
            url: "{{url('workhour')}}",
            type: "GET",
            dataType: "json",
            success: function(res)
            {
                console.log(res);
                $(".btn-workinhours").html('Working Hour : <i class="fa fa-clock-o"></i> '+res);
            }
        });
    }

</script>

@endsection