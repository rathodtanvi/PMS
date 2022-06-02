
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
                <li class="breadcrumb-item">Edit</li>
            </ol>
        </nav>
    </div>
        
    <div class="card">
        <div class="card-body">

            <form method="post" action="{{ url('update-project/'.$edits->id) }}"> 
                @csrf
                
                <div class="row mb-3">
                    <label for="technology_name" class="col-md-4 col-form-label ">{{ __('Technology Name') }}
                        <span class="error"> * </span></label>

                    <div class="col-md-6">

                        <select class="form-control @error('technology_name') is-invalid @enderror" value="{{ old('technology_name') }}" id="nameid" name="technology_name[]" multiple>
                            @foreach($technology as $row)
                                @if ($edits->technology_id == $row->id)
                                <option value="{{$row->id}}" selected>{{$row->technology_name}}</option>
                                @else
                                    <option value="{{$row->id}}">{{$row->technology_name}}</option>
                                @endif
                                
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="project_name" class="col-md-4 col-form-label ">{{ __('Project Name') }}
                        <span class="error"> * </span></label>

                    <div class="col-md-6">
                        <input id="project_name" type='text' name='project_name' value="{{$edits->project_name}}" class="form-control @error('project_name') is-invalid @enderror" placeholder="Enter Project Name" />
                        @error('project_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label ">TeamLeader Name</label>
                    <div class="col-md-6">
                        
                        <select id="selecttl" class="form-control" aria-label="Default select example" name="tl_name">
                            <option></option>
                            @foreach ($tls as $tl)
                            @if ($edits->user_id == $tl->id)
                            <option value="{{$tl->id}}" selected> {{$tl->name}}</option>
                            @else
                            <option value="{{$tl->id}}"> {{$tl->name}}</option>
                            @endif
                            @endforeach
                        </select>
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
    $("#selecttl").select2({
        placeholder: "Select a TeamLeader Name",
        allowClear: true
    });
</script>


@endsection
