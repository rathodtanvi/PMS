@extends('layouts.frontend.index')
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
      <h1>Leave</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('userhome')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('leave')}}">Leave</a></li>
          <li class="breadcrumb-item active"><a href="{{url('addleave')}}">AddWork</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Leave</h5>
              <a class="btn btn-info mb-3"  href="{{route('addleave')}}" style="float:right">New</a> 

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

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<link rel="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
 <script type="text/javascript">
 $(function () {

  var table = $('.yajra-datatable').DataTable({
    responsive: true,
        ajax: "{{ route('leavelist') }}",
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
</html>
@endsection