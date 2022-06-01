@extends('layouts.index')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
<body>
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

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
</body>
@if (Auth::user()->roles_id != 3)
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<link rel="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
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
            {data: 'project_id', name: 'project_id'},
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<link rel="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
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
            {data: 'project_id', name: 'project_id'},
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


</html>
@endsection