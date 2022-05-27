@extends('layouts.backend.index')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Total Hour Spent Report</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
<body>
 
    <main id="main" class="main"> 
    <div class="pagetitle">
      <h1>Total Hour Spent Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('userhome')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('report_project_total_hour')}}">Total Hour Spent Report</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total Hour Spent Report</h5>
            
              <!-- Table with stripped rows -->
                <div class="col-4">    
                  <label class="col-form-label">Project</label>
                    <div> 
                      <select class="form-select">
                        <option selected>---select---</option>
                        @foreach ($projects as $project)
                        <option value="{{$project->id}}">{{$project->Project_Name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
              <div class="col-4">    
                <label class="col-form-label">From Date</label>
                  <div> 
                    <input type="date" class="form-control" name="date_start" value="{{ date("Y-m-d", strtotime( '-1 days' ) )}}">
                  </div>
                </div>
                <div class="col-4">    
                    <label class="col-form-label">To Date</label>
                      <div> 
                        <input type="date" class="form-control" name="date_end" value="{{date('Y-m-d', time())}}" >
                      </div>
                </div>
                <div class="col-4">    
                    <div class="pt-3"> 
                      <button type="submit" class="btn btn-sm btn-info" id="getdata">Get Data</button>
                    </div>
              </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
  
          <!-- Card with header and footer -->
<div class="card" id="data">
  <div class="card-header text-white" style="background-color: #00AA9E;"></div>
  <div class="card-body">
    <h5 class="card-title"></h5>

    <!-- Table with stripped rows -->
    <table class="table  yajra-datatable table table-bordered table-striped">
      <thead>
        <tr>
            <th>Employee</th>
            <th>Productive</th>
            <th>Unproductive</th>
            <th style="color:#FFF; background-color:#099">Total</th>
        </tr>
        @foreach ($employee as $emp)
    
      
        <tr>
          <td><b>Employee :</b>{{$emp->name}}<br>
            <b>Techonogy:</b>{{$project->Project_Name}}
          </td>
          <td>
            Days - 0 <br>
            Duration - 0 Hours 0 Minutes
          </td>
          <td>
            Days - 0 <br>
            Duration - 0 Hours 0 Minutes
          </td>
          <td style="color:#FFF; background-color:#099">
            Days - 0 <br>
            Duration - 0 Hours 0 Minutes
          </td>
        </tr>
        @endforeach
        <tr>
          <td style="color:#FFF; background-color:#099">Total</td>
          <td style="color:#FFF; background-color:#099">
            Days - 0 <br>
            Duration - 0 Hours 0 Minutes
          </td>
          <td style="color:#FFF; background-color:#099">
            Days - 0 <br>
            Duration - 0 Hours 0 Minutes
          </td>
          <td style="color:#FFF; background-color:#066">
            Days - 0 <br>
            Duration - 0 Hours 0 Minutes
          </td>
        </tr>
      
    </thead>
    <tbody>
    </tbody>
  </table>


  <!-- End Table with stripped rows -->
  </div>
</div><!-- End Card with header and footer -->
    </section>

  </main>
</body>
<script>
  $(document).ready(()=>{
      $('#data').hide();
      $("#getdata").on("click",function(){
          $('#data').show();
      });
  });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<link rel="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
{{-- <script type="text/javascript">
$(function () {

var table = $('.yajra-datatable').DataTable({
  responsive: true,
      ajax: "{{ route('attendance') }}",
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

</script> --}}
</html>
@endsection