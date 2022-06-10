@extends('layouts.index')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Leave</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
<body>
    
    <main id="main" class="main"> 
    <div class="pagetitle">
      <h1>Leave
        @if (Auth::user()->roles_id != 1)
        <a class="btn btn-info"  href="{{route('leave.create')}}" style="float:right">New</a>     
        @endif
    </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Leave</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    @if (session('status'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
          {{ session('status') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
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
                        <th>Date</th>
                        <th>Employee Name</th>
                        <th>Leave Type</th>
                        <th>Day</th>
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
@if (Auth::user()->roles_id == 3)
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
          ajax: "{{ route('getdata_leave') }}",
          columns: [ 
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data:'created_at',name:'created_at'},
              {data:'name',name:'name'},
              {data: 'leave_type', name: 'leave_type'},
              {data:'fdate_start',name:'fdate_start'},
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
      responsive: true,
          ajax: "{{ route('all_leavelist') }}",
          columns: [ 
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data:'created_at',name:'created_at'},
              {data:'name',name:'name'},
              {data: 'leave_type', name: 'leave_type'},
              {data:'fdate_start',name:'fdate_start'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
    });

  </script>

@endif

</html>
@endsection