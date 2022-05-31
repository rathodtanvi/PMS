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

            <form method="post" action="{{url('/')}}/AddTechnology"> 
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label ">{{ __('Technology Name') }}
                        <span class="error"> * </span></label>

                    <div class="col-md-6">

                        <input type='text' name='technm' class="form-control" placeholder="Enter Technology Name" />
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

@endsection