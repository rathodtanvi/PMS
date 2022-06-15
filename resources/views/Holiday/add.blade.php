@extends('layouts.index')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Add Holiday</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{url('Holiday')}}">Holiday</a></li>
            <li class="breadcrumb-item">Add</li>
          </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12 p-2">

          <div class="card">
            <div class="card-body">
              
              <!-- General Form Elements -->
              <form method="POST" action="{{ route('Holiday.store') }}" id="holidayadd">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label ">{{ __('Holiday Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class=" holiday_name form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" placeholder="Enter Holiday">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>     
                <div class="row mb-3">
                    <label for="start_date" class="col-md-4 col-form-label ">{{ __('Start Date') }}</label>
                    <div class="col-md-6">
                        <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror"  value="{{date('Y-m-d', time())}}" name="start_date" >

                        @error('start_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="end_date" class="col-md-4 col-form-label ">{{ __('End Date') }}</label>
                    <div class="col-md-6">
                        <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror"   value="{{date('Y-m-d', time())}}" name="end_date" >

                        @error('end_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('submit') }}
                        </button>
                    </div>
                </div>
            </form><!-- End General Form Elements -->

            </div>
        </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
@endsection