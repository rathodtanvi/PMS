@extends('layouts.index')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Edit Elements</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{url('employee')}}">Employee</a></li>
            <li class="breadcrumb-item">Edit</li>
          </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12 p-2">

          <div class="card">
            <div class="card-body">
          

              <!-- General Form Elements -->
              <form method="POST" action="{{route('employee.update',$datas->id)}}" id="employeeadd">
                @csrf
                @method("PUT")

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label ">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $datas->name }}"  autocomplete="name">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label ">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{  $datas->email }}"  autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="mobilenumber" class="col-md-4 col-form-label ">{{ __('MobileNumber') }}</label>

                    <div class="col-md-6">
                        <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ $datas->mobile_number}}" name="mobile_number" >

                        @error('mobile_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
                </div>
                <div class="row mb-3">
                    <label for="dob" class="col-md-4 col-form-label ">{{ __('Birth Date') }}</label>

                    <div class="col-md-6">
                        <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" value="{{ $datas->dob}}" name="dob" >

                        @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="joining_date" class="col-md-4 col-form-label ">{{ __('Joining Date') }}</label>

                    <div class="col-md-6">
                        <input id="joining_date" type="date" class="form-control @error('joining_date') is-invalid @enderror" value="{{ $datas->joining_date}}" name="joining_date" >

                        @error('joining_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gender" class="col-md-4 col-form-label ">{{ __('Gender') }}</label>
                    <div class="col-md-2 form-check-inline pl-5">
                        <input id="gender" type="radio" value="0" class=" @error('gender') is-invalid @enderror" {{$datas->gender == "0" ? 'checked' : ''}} name="gender" >
                        <label class="pl-2">Male</label>
                    </div>
                    <div class="col-md-2 form-check-inline">
                        <input id="gender" type="radio" value="1" class=" @error('gender') is-invalid @enderror" {{$datas->gender == "1" ? 'checked' : ''}} name="gender" >
                      <label class="pl-2">Female</label>
                    </div>
                    @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="row mb-3">
                    <label for="qualification" class="col-md-4 col-form-label ">{{ __('Qualification') }}</label>

                    <div class="col-md-6">
                        <input id="qualification" type="text" class="form-control @error('qualification') is-invalid @enderror" value="{{ $datas->qualification}}" name="qualification" >

                        @error('qualification')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="address" class="col-md-4 col-form-label ">{{ __('address') }}</label>

                    <div class="col-md-6">
                        <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror"  value="" name="address"  >
                            {{ $datas->address}}
                        </textarea>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>
            </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection