@extends('layouts.index')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8|7 Datatables Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
<body>
      <main id="main" class="main">

        <div class="pagetitle">
          <h1>Employee
            <a class="btn btn-info mb-3"  href="{{route('employee.create')}}" >New</a> 
          </h1>
          <nav >
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Employee</li>
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
                  <table class="table yajra-datatable">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Joining Date</th>
                        <th>Qualification</th>
                        <th>Address</th>
                        <th colspan="2">Action</th>
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
      <!-- End #main -->
</body>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<link rel="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>


<script type="text/javascript">
 $(function () {

  var table = $('.yajra-datatable').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    "sScrollX": "300%",
    "bScrollCollapse": true,
    "bAutoWidth": false,
    responsive: true,
        ajax: "{{ route('getdata_employee') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'mobile_number', name: 'mobile_number'},
            {data: 'joining_date', name: 'joining_date'},
            {data: 'qualification', name: 'qualification'},
            {data: 'address', name: 'address'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
          
        ]
       
    });
   
  });

</script>
</html>
@endsection
