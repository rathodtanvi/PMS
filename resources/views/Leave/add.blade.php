@extends('layouts.index')
@section('content')
<link href="{{ asset('validation-error-style.css') }}" rel="stylesheet">

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Leave</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('leave')}}">Leave</a></li>
          <li class="breadcrumb-item">Add</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
          <div class="p-2">
        <div class="col-lg-12 col-sm-12 col-sm-12">

          <div class="card p-2">
            <div class="card-body">

              <!-- General Form Elements -->
              <form method="post" action="{{route('leave.store')}}"  id="leaveadd">
                @csrf
              <div class="row mb-3">
                <div class="col-6">
                        <label class="col-form-label">Leave Type</label>
                        <div> 
                        <select class="form-select leave_type" aria-label="Default select example" name="leave_type">
                        <option disabled selected value>---select---</option>
                        <option {{ old('leave_type') == '1' ? 'selected' : ''}} value="1">Half Day Leave</option>
                        <option {{ old('leave_type') == '2' ? 'selected' : ''}} value="2">Full Day Leave</option>
                        <option  {{ old('leave_type') == '3' ? 'selected' : ''}} value="3">Multipal Days Leave</option>
                      </select>
                      @error('leave_type')
                      <span style="color:red"> {{$message }} </span>
                      @enderror
                    </div>
                </div>

                <div class="col-6 halfday" style="display: none">
                <label class="col-form-label">Half Leave Type</label>
                    <div class="col">
                        <select class="form-select" aria-label="Default select example" name="half_leave_type" value="{{ old('half_leave_type') }}">
                            <option value="1">First Half</option>
                            <option value="2">Second Half</option>
                          </select>
                    </div>
                  </div>
            </div>
            <div class="row mt-3">
                <div class="col-4">
                    <div class="row">
                    <div class="col-12"> <label class="col-form-label">Subject</label>
                        <div class="">
                            <input type="text" class="form-control" value="{{Auth::user()->name}}-Leave Application" name="subject" value="{{ old('subject') }}" >
                          </div></div>
                    </div>
                </div>
                    <div class="col-4">    
                  <label class="col-form-label">Date</label>
                    <div> 
                     <input type="date" class="form-control" name="date_start" value="{{ old('date_start') }}" >
                     @error('date_start')
                     <span style="color:red"> {{$message }} </span>
                     @enderror
                    </div>
                    </div>
                    <div class="col-4  todate" style="display:none">
                        <label class="col-form-label">To</label>
                        <div> 
                         <input type="date" class="form-control"  name="date_end" value="{{ old('date_end') }}">
                        </div>
                        </div>
                    
                    </div>

                <div class="row mt-3 pb-2 display_ck_edior_error">
                  <div class="col-12 container">
                 <div> <label for="inputPassword" class="col-sm-2 col-form-label">Message</label></div>
                     <textarea class="form-control textarea ckeditor"  name="message" id="message">{{ old('message') }}</textarea>   
                </div>
                @error('message')
                <span style="color:red"> {{$message }} </span>
                @enderror
                <div class="row mt-5">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </div>
            </div>
              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
    </div>
      </div>
    </section>

  </main>
@endsection