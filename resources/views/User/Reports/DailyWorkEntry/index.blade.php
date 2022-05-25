@extends('layouts.frontend.index')
@section('content')
<script src="{{ asset('userpms.js') }}"></script>
<!DOCTYPE html>
<html>
<head>
    <title>Daily Work Entry Report</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
<body>
 
    <main id="main" class="main"> 
    <div class="pagetitle">
      <h1>Daily Work Entry Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('userhome')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('report_daily_work_entry')}}">DailyWorkEntry Report</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"> Daily Work Entry Report</h5>
             
              <!-- Table with stripped rows -->
              <div class="col-4">    
                <label class="col-form-label">Project comp/InComp</label>
                  <div> 
                    <select class="form-select project_time">
                      <option selected>---select---</option>
                        <option value="1">Both</option>
                        <option value="2">Complete</option>
                        <option value="3">InComplete</option>
                    </select>
                  </div>
                </div>
                <div class="col-4">    
                  <label class="col-form-label">Project</label>
                    <div> 
                      <select class="form-select project_name">
                        <option selected>---select---</option>
                        
                        @foreach ($projects as $project)
                        <option value="{{$project->id}}">{{$project->Project_Name}}</option>
                        @endforeach
                         
                      </select>
                    </div>
                  </div>
                  <div class="col-4">    
                    <label class="col-form-label">Techology</label>
                      <div> 
                        <select class="form-select techology">
                          <option selected>---select---</option>
                          @foreach ($projects as $project)
                          <option value="{{$project->id}}">{{$project->Technology_Name}}</option>
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
 <div class="card" id="data" style="display:none">
  <div class="card-header">
  <div class="row">
    <div class="col-6">
      <button class="btn btn-sm btn-secondary btn-outline">CSV</button>
      <button class="btn btn-sm btn-secondary btn-outline">Excel</button>
      <button class="btn btn-sm btn-secondary btn-outline">PDF</button>
      <button class="btn btn-sm btn-secondary btn-outline">Print</button>
    </div>
    <div class="col-6"></div>
  </div>
  </div>
  <div class="card-body">
    <h5 class="card-title"></h5>
     <!-- Table with stripped rows -->
     <table class="table  yajra-datatable" style="width:100%">
      <thead>
        <tr>
            <th>No</th>
            <th>Technology</th>
            <th>Project</th>
            <th>Employee</th>
            <th>Date</th>
            <th>Work Information</th>
            <th>Work Detail</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  <!-- End Table with stripped rows -->
  </div>
  <div class="card-footer">
    <div class="row">
      <div class="col-6"></div>
      <div class="col-6">
        <div class=" pr-3" style="color:#FFF; font-size:18px; border:1;">
          <table class="table-responsive" style="background-color:#066;">
            <thead>
            <tr>
              <td>Total Timing</td>
            </tr>
          </thead>
            <tbody>
              <tr><td>Days:0</td></tr>
              <tr><td>Duration:0 Hours 0 Minutes</td></tr>
              </tr>
            </tbody>
          </table>
         
        </div>
      </div>
    </div>
  
 
  </div>
</div><!-- End Card with header and footer -->
    </section>

  </main>
</body>
<script>
  $(document).ready(()=>{
      //$('#data').hide();
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