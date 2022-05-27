@extends('layouts.index')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Add Employee</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{url('employee')}}">Employee</a></li>
            <li class="breadcrumb-item"><a href="{{url('addemployee')}}">Add</a></li>

          </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12 p-5">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Employee </h5>

              <!-- General Form Elements -->
              <form method="POST" action="{{ route('add') }}">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"   value="{{ old('password') }}" autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  value="{{ old('password_confirmation') }}" autocomplete="new-password">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="mobilenumber" class="col-md-4 col-form-label text-md-end">{{ __('MobileNumber') }}</label>

                    <div class="col-md-6">
                        <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number') }}" name="mobile_number" >

                        @error('mobile_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
                </div>
                <div class="row mb-3">
                    <label for="dob" class="col-md-4 col-form-label text-md-end">{{ __('Birth Date') }}</label>

                    <div class="col-md-6">
                        <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}" name="dob" >

                        @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="joining_date" class="col-md-4 col-form-label text-md-end">{{ __('Joining Date') }}</label>

                    <div class="col-md-6">
                        <input id="joining_date" type="date" class="form-control @error('joining_date') is-invalid @enderror"  value="{{ old('joining_date') }}" name="joining_date" >

                        @error('joining_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                    <div class="col-md-2 form-check-inline pl-5">
                        <input id="gender" type="radio" value="0" class=" @error('gender') is-invalid @enderror" value="{{ old('gender') == '0' ? 'checked' : ''}}" name="gender" >
                        <label class="pl-2">Male</label>
                    </div>
                    <div class="col-md-2 form-check-inline">
                        <input id="gender" type="radio" value="1" class=" @error('gender') is-invalid @enderror" value="{{ old('gender') == '1' ? 'checked' : ''}}" name="gender" >
                      <label class="pl-2">Female</label>
                    </div>
                    @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="row mb-3">
                    <label for="qualification" class="col-md-4 col-form-label text-md-end">{{ __('Qualification') }}</label>

                    <div class="col-md-6">
                        <input id="qualification" type="text" class="form-control @error('qualification') is-invalid @enderror" value="{{ old('qualification') }}" name="qualification" >

                        @error('qualification')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('address') }}</label>

                    <div class="col-md-6">
                        <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror"  name="address"  >
                        {{ old('address') }}
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
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
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