
@extends('layouts.index')

@section('content')

<!-- Select2  link -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<main id="main" class="main">

    <div class="pagetitle">
        <h1> Enter Project </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{url('Project')}}">Project</a></li>
                <li class="breadcrumb-item">Add</li>
            </ol>
        </nav>
    </div>
        
    <div class="card">
        <div class="card-body">

            <form method="post" action="{{url('/')}}/AddProject"> 
                @csrf
                
                <div class="row mb-3">
                    <label for="technology_name" class="col-md-4 col-form-label ">{{ __('Technology Name') }}
                        <span class="error"> * </span></label>

                    <div class="col-md-6">
                        
                        <select id="nameid" name="technology_name[]" class="form-control @error('technology_name') is-invalid @enderror" value="{{ old('technology_name') }}" multiple>
                            <option></option>
                            @foreach($technology as $row)
                                <option value="{{$row->id}}">{{$row->technology_name}}</option>
                            @endforeach
                        </select>
                        @error('technology_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                    
                <div class="row mb-3">
                    <label for="project_name" class="col-md-4 col-form-label ">{{ __('Project Name') }}
                        <span class="error"> * </span></label>

                    <div class="col-md-6">
                        <input id="project_name" type="text" class="form-control @error('project_name') is-invalid @enderror" value="{{ old('project_name') }}" name="project_name" placeholder="Enter Project Name" >
                        @error('project_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

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

    $("#nameid").select2({
        placeholder: "Select a Technology",
        allowClear: true
    });
</script>


@endsection
