@extends('layouts.index')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1> Enter Technology </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{url('Technology')}}">Technology</a></li>
                <li class="breadcrumb-item">Edit</li>
            </ol>
        </nav>
    </div>
        
    <div class="card p-2">
        <div class="card-body">

            <form method="post"   action="{{route('Technology.update',$edits->id)}}"> 
                @csrf
                @method("PUT")
                <div class="row mb-3">
                    <label for="technology_name" class="col-md-4 col-form-label ">{{ __('Technology Name') }}
                        <span style="color:red"> * </span></label>

                    <div class="col-md-6">

                        <input id="technology_name" type='text' name='technology_name' class="form-control @error('technology_name') is-invalid @enderror" placeholder="Enter Technology Name" value="{{ $edits->technology_name }}" />
                        @error('technology_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

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