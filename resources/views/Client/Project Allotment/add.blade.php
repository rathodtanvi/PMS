
@extends('Client.layouts.master')

@section('content')

<!-- Select2  link -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<div class="pagetitle">
    <h1> Enter Project </h1>
</div>
    
<div class="box-body">
    <h4 class="box-form-header"> Add Project Allotment </h4>
    <form method="post" action="{{url('/')}}/AddAllotment"> 
        @csrf
        
            Project Name <span class="error" style="margin-right:12%;"> * </span>
            <select style="width: 40%;" id="projectid" name="projectnm" >
                <option></option>
                @foreach($projects as $project)
                    <option value="{{$project->Project_Name}}">{{$project->Project_Name}}</option>
                @endforeach
            </select>
            <br/><br/>
            
            Technology Name <span class="error" style="margin-right:9%;"> * </span>
            <select style="width: 40%;" id="nameid" name="technm[]" multiple>
                <option></option>
                @foreach($technology as $row)
                    <option value="{{$row->Technology_Name}}">{{$row->Technology_Name}}</option>
                @endforeach
            </select>
            
        <br/><br/>

        <button type="button"  class="btn-cancel"> Cancel </button>
        <button type="submit" name="submit" class="btn-submit"> Submit </button>
    </form>
</div>

<script type="text/javascript">

    $("#nameid").select2({
        placeholder: "Select a Technology",
        allowClear: true
    });

    $("#projectid").select2({
        placeholder: "Select a Project",
        allowClear: true
    });

    $(document).ready(function(){
        $('select[name="projectnm"]').on('change',function(){
            var pnm = $(this).val();
            if (pnm) 
            {
                $.ajax
                ({
                    url: "{{url('getprojectnm')}}",
                    type: "GET",
                    dataType: "json",
                    data: {name : pnm },
                    success: function(res)
                    {
                        $('select[id="nameid"]').empty();
                        $.each(res,function(Index,value)
                        {
                            $('select[id="nameid"]').append("<option>"+value+"</option>");
                        });
                    }
                });
            }
            else 
            {
                $('select[id="nameid"]').empty();
            }
        });
            
    });

</script>


@endsection
