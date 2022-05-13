@extends('layouts.frontend.index')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1> Attendance </h1>
    </div>  
    
    <div class="card">
        <div class="card-body">

            <center>
                <h3 class="h3tag"> Attendance on {{date('d-m-Y')}} </h3>
                
                @if ($attendance->isEmpty())
                    <button type="button" class="btn-inentry" ><i class="bi bi-box-arrow-right"></i> In Entry </button>
                    <button type="button" style="display:none" class="btn-outentry"> Out Entry <i class="bi bi-box-arrow-right"></i> </button><br/>
                @else
                
                    @foreach ($attendance as $row)
                    <div>
                        @if ($row->user_id == '1')
                            <button type="button" class="btn-inentry" disabled="disabled" > {{$row->In_Entry}} </button>
                        
                        @else
                            <button type="button" class="btn-inentry" ><i class="bi bi-box-arrow-right"></i> In Entry </button>
                        
                        @endif

                        @if ($row->Out_Entry == null)
                            <button type="button" class="btn-outentry" > Out Entry <i class="bi bi-box-arrow-right"></i> </button>
                            <br/>
                        @else
                            <button type="button" class="btn-outentry" disabled="disabled"> {{$row->Out_Entry}} </button>    
                        @endif
                    </div>
                    @endforeach 
                @endif
                <br/>
                <button type="button" class="btn-workinhours">Workibg Hour : <i class="bi bi-clock"></i></button>
                
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
                    tr.find(".btn-inentry").html(value);
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
                    tr.find(".btn-outentry").html(value);
                    $(".btn-outentry").attr("disabled","disabled");
                    $(".h3tag").after('<div><button type="button" class="btn-inentry" ><i class="bi bi-box-arrow-right"></i> In Entry </button>  <button type="button" style="display:none" class="btn-outentry"> Out Entry <i class="bi bi-box-arrow-right"></i> </button><br/></div>');
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
                $(".btn-workinhours").html('Workibg Hour : <i class="bi bi-clock"></i> '+res);
            }
        });
    }

</script>

@endsection