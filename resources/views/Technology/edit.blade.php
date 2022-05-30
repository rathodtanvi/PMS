@extends('layouts.index')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1> Enter Technology </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{url('AdminTechnology')}}">Technology</a></li>
                <li class="breadcrumb-item">Edit</li>
            </ol>
        </nav>
    </div>
        
    <div class="card">
        <div class="card-body">

            <h4 class="box-form-header"> Technology </h4>
            <form method="post" action="{{ url('update-technology/'.$edits->id) }}"> 
                @csrf
                Technology Name <span class="error"> * </span>
                <input type='text' name='technm' class="input-tagspace" placeholder="Enter Technology Name" value="{{$edits->technology_name}}"/>
                <br/><br/>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="submit" class="btn btn-primary"> Update </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection