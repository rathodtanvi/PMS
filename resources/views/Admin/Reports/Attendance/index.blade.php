@extends('layouts.backend.index')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
<body>
 
    <main id="main" class="main"> 
    <div class="pagetitle">
      <h1>Attendance Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('admin_report_attendance')}}">Attendance Report</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Attendance Report</h5>
             
              <!-- Table with stripped rows -->
              <div class="col-4">    
                <label class="col-form-label">Employee</label>
                  <div> 
                    <select class="form-select">
                      <option selected>All</option>
                        @foreach ($employee as $emp)
                        <option value="{{$emp->id}}">{{$emp->name}}</option>
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
      <div id="data" style="display:none">
      @foreach ($employee as $emp)
      <div class="row" >
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header  text-white" style="background-color: #00AA9E;">  {{$emp->name}}</div>
            <div class="card-body">
                <!-- Table with stripped rows -->
                  <table class="table  yajra-datatable " style="width:100%">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Date</th>
                          <th>Attendance Timing</th>
                          <th>Attendance Duration</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->
  
              </div>

              <div class="card-footer  text-black">
                <div class="row">
                  <div class="col-4">
                       <div class="row">
                          <div class="col-10">Required Attendance Hours</div>
                          <div class="col-2 badge bg-warning  text-black">8</div>
                       </div>
                  </div>
                  <div class="col-4">
                    <div class="row">
                      <div class="col-10">Actual Attendance Hours</div>
                      <div class="col-2 badge bg-danger  text-black">Danger</div>
                   </div>
                  </div>
                  <div class="col-4">
                    <div class="row">
                      <div class="col-10">Work Duration Hours</div>
                      <div class="col-2 badge bg-secondary  text-white">Danger</div>
                   </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="row pt-2">
                      <div class="col-10">Required Attendance Days</div>
                      <div class="col-2 badge bg-warning  text-black">1</div>
                   </div>
                  </div>
                  <div class="col-4">
                    <div class="row pt-2">
                      <div class="col-10">Actual Attendance Days</div>
                      <div class="col-2 badge bg-danger  text-black">Danger</div>
                   </div>
                  </div>
                  <div class="col-4">
                    <div class="row pt-2">
                      <div class="col-10">Work Duration Days</div>
                      <div class="col-2 badge bg-secondary  text-white">Danger</div>
                   </div>
                  </div>
                </div>
              </div>
          </div>

        </div>
      </div>
      @endforeach
    </div>
    </section>

  </main>
</body>
<script>
    $(document).ready(()=>{
         $("#getdata").on("click",function(){
            $('#data').show();
         });
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<link rel="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
 <script type="text/javascript">
 $(function () {

  var table = $('.yajra-datatable').DataTable({
    responsive: true,
        ajax: "{{ route('admin_report_attendancelist') }}",
        columns: [ 
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data:'Attendance_Date',name:'Attendance_Date'},
            {data:'In_Entry',name:'In_Entry'},
            {data:'In_Entry',name:'In_Entry'},
        ]
    });
  });

</script>
</html>
@endsection
