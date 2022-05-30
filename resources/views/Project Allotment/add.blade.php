
@extends('layouts.index')

@section('content')

<!-- Select2  link -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<main id="main" class="main">

    <div class="pagetitle">
        <h1> Enter Project Allotment</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{url('AdminProjectAllotment')}}">Project Allotment</a></li>
                <li class="breadcrumb-item">Add</li>
            </ol>
        </nav>
    </div>
        
    <div class="card">
        <div class="card-body">

            <h4 class="box-form-header"> Add Project Allotment </h4>
            @if (Auth::user()->roles_id == 1 || Auth::user()->roles_id == 2)
                <form method="post" action="{{url('/')}}/adminAddAllotment"> 
                    @csrf

                    Employee Name <span class="error" style="margin-right:10%;"> * </span>
                    <select style="width: 40%;" class="selectid" name="unm" >
                        <option></option>
                        @foreach ($users as $user)
                            @if ($user->roles_id != 1)
                                <option value={{$user->id}}>{{$user->name}}</option>
                            @endif
                            
                        @endforeach
                    </select>
                    <br/><br/>

                    Project Name <span class="error" style="margin-right:12.5%;"> * </span>
                    <select style="width: 40%;" class="selectid" name="projectnm" >
                        <option></option>
                        @foreach($projects as $project)
                            <option value="{{$project->project_name}}">{{$project->project_name}}</option>
                        @endforeach
                    </select>
                    <br/><br/>
                    
                    Technology Name <span class="error" style="margin-right:9%;"> * </span>
                    <select style="width: 40%;" class="selectid" id="nameid" name="technm[]" multiple>
                        <option></option>
                        @foreach($technology as $row)
                            <option value="{{$row->technology_name}}">{{$row->technology_name}}</option>
                        @endforeach
                    </select>
                    
                    <br/><br/>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                        </div>
                    </div>   
                </form>
            @else
                
                <form method="post" action="{{url('/')}}/adminAddAllotment"> 
                    @csrf

                    Project Name <span class="error" style="margin-right:12.5%;"> * </span>
                    <select style="width: 40%;" class="selectid" name="projectnm" >
                        <option></option>
                        @foreach($projects as $project)
                            <option value="{{$project->project_name}}">{{$project->project_name}}</option>
                        @endforeach
                    </select>
                    <br/><br/>
                    
                    Technology Name <span class="error" style="margin-right:9%;"> * </span>
                    <select style="width: 40%;" class="selectid" id="nameid" name="technm[]" multiple>
                        <option></option>
                        @foreach($technology as $row)
                            <option value="{{$row->technology_name}}">{{$row->technology_name}}</option>
                        @endforeach
                    </select>
                    
                    <br/><br/>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                        </div>
                    </div>   
                </form>
            @endif
            
        </div>
    </div>
</main>

<script type="text/javascript">

    $(".selectid").select2({
        placeholder: "--select--",
        allowClear: true
    });

    $(document).ready(function(){
        $('select[name="projectnm"]').on('change',function(){
            var pnm = $(this).val();
            
            if (pnm) 
            {
                $.ajax
                ({
                    url: "{{url('admingetprojectnm')}}",
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
