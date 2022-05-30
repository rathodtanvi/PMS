@extends('layouts.index')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1> Enter Technology </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{url('Technology')}}">Technology</a></li>
                <li class="breadcrumb-item">Add</li>
            </ol>
        </nav>
    </div>
        
    <div class="card">
        <div class="card-body">

            <h4 class="box-form-header"> Add Technology </h4>
            <form method="post" action="{{url('/')}}/AddTechnology"> 
                @csrf
                Technology Name <span class="error"> * </span>
                <input type='text' name='technm' class="input-tagspace" placeholder="Enter Technology Name" />
                @if($errors->any())
                    <span class="input-tagspace" style="color:red"> {{$errors->first()}}</span>
                @endif
                <br/><br/>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection