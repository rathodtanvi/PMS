
@extends('layouts.backend.index')

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
                <li class="breadcrumb-item"><a href="{{url('AdminProject')}}">Project</a></li>
            </ol>
        </nav>
    </div>
        
    <div class="card">
        <div class="card-body">

            <h4 class="box-form-header"> Add Project </h4>
            <form method="post" action="{{url('/')}}/adminAddProject"> 
                @csrf
                
                    Project Name <span class="error"> * </span>
                    <input type='text' name='projectnm' class="input-tagspace" placeholder="Enter Project Name" />
                    @if($errors->any())
                        <span class="input-tagspace" style="color:red"> {{$errors->first()}}</span>
                    @endif
                    <br/><br/><br/>

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
    </div>
</main>

<script type="text/javascript">

    $("#nameid").select2({
        placeholder: "Select a Technology",
        allowClear: true
    });
</script>


@endsection
