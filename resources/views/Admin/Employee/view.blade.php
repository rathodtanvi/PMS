@extends('layouts.index')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1> Employee Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('employee')}}">Employee</a></li>
          <li class="breadcrumb-item"><a href="">View</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Employee Detail</h5>
        
        <!-- Table with hoverable rows -->
        <table class="table table-hover">
          <tbody>
            <tr><th>Name</th><td>{{$datas->name}}</td></tr>
            <tr><th>Email</th><td>{{$datas->email}}</td></tr>  
            <tr><th>Mobile Number</th><td>{{$datas->mobile_number}}</td></tr>  
            <tr><th>Gender</th><td>{{$datas->gender == '0' ? 'male': 'female'}}</td></tr>
            <tr><th>Date Of Birth</th><td>{{$datas->dob}}</td></tr>
            <tr><th>Date Of Joining</th><td>{{$datas->joining_date}}</td></tr>
            <tr><th>Qualifiaction</th><td>{{$datas->qualification}}</td></tr>
            <tr><th>address</th><td>{{$datas->address}}</td></tr>
          </tbody>
        </table>
        <!-- End Table with hoverable rows -->

      </div>
    </div>
  </main>
@endsection