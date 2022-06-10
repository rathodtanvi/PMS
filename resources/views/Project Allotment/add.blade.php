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
                <li class="breadcrumb-item"><a href="{{url('ProjectAllotment')}}">Project Allotment</a></li>
                <li class="breadcrumb-item">Add</li>
            </ol>
        </nav>
    </div>
        
    <div class="card">
        <div class="card-body">

            <form method="post" action="{{ route('projectAllotement.store') }}"> 
                @csrf

            @if (Auth::user()->roles_id == 1 || Auth::user()->roles_id == 2)
                

                    <div class="row mb-3">
                        <label for="unm" class="col-md-4 col-form-label ">{{ __('Employee Name') }}
                            <span style="color:red"> * </span></label>
    
                        <div class="col-md-6">
                            
                            <select class="selectid form-control @error('unm') is-invalid @enderror" name="unm" >
                                <option></option>
                                @foreach ($users as $user)
                                    @if ($user->roles_id != 1)
                                        <option value={{$user->id}}>{{$user->name}}</option>
                                    @endif
                                    
                                @endforeach
                            </select>
                            @error('unm')
                                <span style="color:red"> {{$message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="projectnm" class="col-md-4 col-form-label ">{{ __('Project Name') }}
                            <span style="color:red"> * </span></label>
    
                        <div class="col-md-6">
                            <select class="selectid form-control @error('projectnm') is-invalid @enderror" name="projectnm" >
                                <option></option>
                                @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->project_name}}</option>
                                @endforeach
                            </select>
                            @error('projectnm')
                                <span style="color:red"> {{$message }} </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="technology_id" class="col-md-4 col-form-label ">{{ __('Technology Name') }}
                            <span style="color:red"> * </span></label>
    
                        <div class="col-md-6">
                            <select class="selectid form-control @error('technology_id') is-invalid @enderror" id="nameid" name="technology_id[]" multiple>
                                <option></option>
                                @foreach($technology as $row)
                                    <option value="{{$row->id}}">{{$row->technology_name}}</option>
                                @endforeach
                            </select>
                            @error('technology_id')
                                <span style="color:red"> {{$message }} </span>
                            @enderror
                        </div>
                    </div>
                                        
                @else
                
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label ">{{ __('Project Name') }}
                            <span style="color:red"> * </span></label>
    
                        <div class="col-md-6">
                            <select class="selectid form-control @error('projectnm') is-invalid @enderror" name="projectnm" >
                                <option></option>
                                @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->project_name}}</option>
                                @endforeach
                            </select>
                            @error('projectnm')
                                <span style="color:red"> {{$message }} </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label ">{{ __('Technology Name') }}
                            <span style="color:red"> * </span></label>
    
                        <div class="col-md-6">
                            <select class="selectid form-control @error('technology_id') is-invalid @enderror" id="nameid" name="technology_id[]" multiple>
                                <option></option>
                                @foreach($technology as $row)
                                    <option value="{{$row->id}}">{{$row->technology_name}}</option>
                                @endforeach
                            </select>
                            @error('technology_id')
                                <span style="color:red"> {{$message }} </span>
                            @enderror
                        </div>
                    </div>

            @endif
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                </div>
            </div> 
        </form>
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
                    url: "{{url('gettechnology')}}",
                    type: "GET",
                    dataType: "json",
                    data: {name : pnm },
                    success: function(res)
                    {
                        $('select[id="nameid"]').empty();
                        $.each(res,function(Index,value)
                        {
                            $('select[id="nameid"]').append("<option value='"+ value.id +"'>"+value.technology_name+"</option>");
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