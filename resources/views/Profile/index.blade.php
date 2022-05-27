@extends('layouts.index')
@section('content')
<script src="{{ asset('userpms.js') }}"></script>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
          <li class="breadcrumb-item active"><a href="{{url('myprofile')}}">Profile</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2>{{Auth::user()->name}}</h2>
              <h3>  {{ $datas->roles->name  }}</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                 
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{$datas->name}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{$datas->email}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Mobile Number</div>
                    <div class="col-lg-9 col-md-8">{{$datas->mobile_number}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8">{{$datas->gender == '0' ? 'male': 'female'}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date Of Birth</div>
                    <div class="col-lg-9 col-md-8">{{$datas->dob}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date Of Joining</div>
                    <div class="col-lg-9 col-md-8">{{$datas->joining_date}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Qualifiaction</div>
                    <div class="col-lg-9 col-md-8">{{$datas->qualification}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">address</div>
                    <div class="col-lg-9 col-md-8">{{$datas->address}}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="{{route('updateprofile',$datas->id)}}">
                    @csrf
                   @method('PUT') 
                    <div class="row mb-3">
                      <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="fullName" value="{{$datas->name}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                       @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="text" class="form-control" id="email" value="{{$datas->email}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Mobile Number</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="mobile_number" type="text" class="form-control" id="mobile_number" value="{{$datas->mobile_number}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="gender" class="col-md-4 col-lg-3 col-form-label">{{ __('Gender') }}</label>
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
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Date Of Birth</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="dob" type="date" class="form-control" id="dob" value="{{$datas->dob}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="joining_date" class="col-md-4 col-lg-3 col-form-label">Date Of Joining</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="joining_date" type="date" class="form-control" id="Address" value="{{$datas->joining_date}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="qualification" class="col-md-4 col-lg-3 col-form-label">Qualifiaction</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="qualification" type="text" class="form-control" id="qualification" value="{{$datas->qualification}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror"  name="address">
                          {{$datas->address}}
                          </textarea>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

               

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  {{-- <form method="post" action="{{route('changepassword')}}"> --}}
                       {{-- @csrf --}}

                    <form>
                    <div class="row mb-3">
                      <div class="data_update"></div>
                      <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="current_password" type="password" class="form-control" id="current_password">
                        <h6 style="color:red;" class="err_current_password"> @error('current_password'){{$message}} @enderror</h6>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control"  id="password">
                        <h6 style="color:red;" class="err_password"> @error('password'){{$message}} @enderror</h6>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="confirm_password" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="confirm_password" type="password" class="form-control" id="confirm_password">
                        <h6 style="color:red;" class="err_confirm_password"> @error('confirm_password'){{$message}} @enderror</h6>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary changepassword" >Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>

@endsection

