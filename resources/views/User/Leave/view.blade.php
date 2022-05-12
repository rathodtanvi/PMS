@extends('layouts.frontend.index')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1> Leave</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('leave')}}">leave</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Leave</h5>
        
        <!-- Table with hoverable rows -->
        <table class="table table-hover">
          <tbody>
            <tr><th>Leave Type</th><td>
              @if($datas->leave_type === 1)
               Half Day Leave
               @elseif($datas->leave_type === 2)
              Full Day Leave 
               @elseif($datas->leave_type === 3) 
               Multipal Days Leave 
               @endif
              </td></tr>
            <tr><th>Subject</th><td>{{$datas->subject}}</td></tr>  
            <tr><th>Date</th><td>{{$datas->date_start}} @if($datas->date_end === null) @else  <b>/</b> {{$datas->date_end}} @endif</td></tr>  
            <tr><th>Message</th><td>{!!$datas->message !!}</td></tr>
          </tbody>
        </table>
        <!-- End Table with hoverable rows -->

      </div>
    </div>
  </main>
@endsection
