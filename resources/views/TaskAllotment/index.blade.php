@extends('layouts.index')
@section('content')
<!-- <!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head> 
<body> -->
  <style>

    .modal {
      display: none; 
      position: fixed; 
      z-index: 1; 
      padding-top: 100px; 
      left:30%;
      top:20%;
      width:50%;
      height: 100%; 
      overflow: auto;
    }
    .modal-content 
    {
      background-color: #fefefe;
      margin: auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }
    .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
  @if (Auth::user()->roles_id != 3)

  <script type="text/javascript">
  $(function () {

  var table = $('.yajra-datatable').DataTable({
    "sScrollX": "300%",
    "bScrollCollapse": true,
    "bAutoWidth": false,
    responsive: true,
        ajax: "{{ route('task_allotment_list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'employeename', name: 'employeename'},
            {data: 'project_name', name: 'project_name'},
            {data:'tl_id',name:'tl_id'},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            {data: 'days_txt', name: 'days_txt'},
            {data: 'hours_txt', name: 'hours_txt'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
  </script>

@else

  <script type="text/javascript">
  $(function () {

  var table = $('.yajra-datatable').DataTable({
    "sScrollX": "300%",
    "bScrollCollapse": true,
    "bAutoWidth": false,
    responsive: true,
        ajax: "{{ route('task_allotment_list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'project_name', name: 'project_name'},
            {data:'tl_id',name:'tl_id'},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            {data: 'days_txt', name: 'days_txt'},
            {data: 'hours_txt', name: 'hours_txt'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
  </script>
  @endif
  
    <main id="main" class="main"> 
    <div class="pagetitle">
      <h1>Task Allotment
          <a class="btn btn-info"  href="{{route('add_task')}}" style="float:right">New</a> 
      </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Task Allotment</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              <!-- Table with stripped rows -->
              <table class="table  yajra-datatable ">
                  <thead>
                    <tr>
                        <th>No</th>
                        @if (Auth::user()->roles_id != 3)
                        <th>Employee Name</th>
                        @endif
                        <th>Project Name</th>
                        <th>Task Allocate By</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Estimate Days</th>
                        <th>Estimate Hours</th> 
                        <th>Manage</th> 
                    </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

              <div class="modal" id="myModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Modal Heading</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                      Modal body..
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>


@endsection

