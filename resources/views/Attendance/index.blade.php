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
    
    <div class="card ">
        <div class="card-body">

            <center>
                <h3 class="h3tag"> Attendance on {{date('d-m-Y')}} </h3><br/>
                
                @if ($attendance->isEmpty())
                    <div class="mydiv" style="margin-bottom:5px;"> </div>
                    <div style="margin-bottom:5px;"> <button type="button" class="btn btn-success btn-sm active btn-inentry" style="font-size:18px;"><i class="fa fa-sign-in"></i> In Entry </button>
                    <button type="button" style="display:none;font-size:18px;" class="btn btn-danger btn-sm inactive btn-outentry"> Out Entry <i class="fa fa-sign-out"></i> </button></div>
                    
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
</main>

<script>

    $("body").on("click",".btn-inentry",function(){
        var tr = $(this).closest("div");
        
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
    });

    $("body").on("click",".btn-outentry",function()
    {
        var tr = $(this).closest("div");
        var starttime = tr.find(".btn-inentry").text();

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
                    $(".mydiv").prepend('<div style="margin-bottom:5px;"><button type="button" class="btn btn-success btn-sm active btn-inentry" style="font-size:18px;"><i class="fa fa-sign-in"></i> In Entry </button>  <button type="button" style="display:none;font-size:18px;" class="btn btn-danger btn-sm inactive btn-outentry"> Out Entry <i class="fa fa-sign-out"></i> </button></div>');
                });
            }
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