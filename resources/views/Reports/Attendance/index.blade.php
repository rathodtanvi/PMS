@extends('layouts.backend.index')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
<body>

  <script>
    
    function itemDataTable(empnm,fdate,tdate)
    {
      var dataTable = $('.table').DataTable({
        processing: true,
        serverSide: true,

        ajax: {
          url: "{{ route('admin_report_attendancelist') }}",
          type: 'get',
          data: {empnm ,fdate ,tdate},
        },
      
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'Attendance_Date', name: 'Attendance_Date'},
          {data: 'mergeColumn', name: 'mergeColumn'},
        ]
      });

      return dataTable;
    }

  $(document).ready(function(){
    $('#getdata').click(function(){
    
        
        var empnm = $('.empnm').val();
        var fdate = $('.fromdate').val();
        var tdate = $('.todate').val();

        /*$.ajax({
          url: "{{ route('admin_report_attendancelist') }}",
          type: 'get',
          data: {empnm ,fdate ,tdate},
          success : function(res)
          {
            $.each(res,function(Index,value)
            {
              $("tbody").append("<tr><td>"+ value.id + "</td><td>" + value.Attendance_Date + "</td><td>" + value.In_Entry + " - " + value.Out_Entry);
            });
          }
        });*/
        itemDataTable(empnm,fdate ,tdate)
    });
  });
  

    /*var table = $('.table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ url('/admin_report_attendancelist') }}",
      columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'Attendance_Date', name: 'Attendance_Date'},
          {data: 'In_Entry', name: 'In_Entry'},
          {data: 'Out_Entry', name: 'Out_Entry'},
          {data: 'action', name: 'action', orderable: true, searchable: true},
      ]
    });*/
  

</script>

    <main id="main" class="main"> 
    <div class="pagetitle">
      <h1>Attendance Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('admin_report_attendance')}}">Attendance Report</a></li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Attendance Report</h5>
                          
              <div class="col-4">    
                <label class="col-form-label">Employee</label>
                  <div> 
                    <select class="form-select empnm" name="empnm">
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
                    <input type="date" class="form-control fromdate" name="fromdate" value="{{ date("Y-m-d", strtotime( '-1 days' ) )}}">
                  </div>
                </div>
                <div class="col-4">    
                    <label class="col-form-label">To Date</label>
                      <div> 
                        <input type="date" class="form-control todate" name="todate" value="{{date('Y-m-d', time())}}" >
                      </div>
                </div>
              
                <div class="col-4">    
                  <div class="pt-3"> 
                    <button type="submit" class="btn btn-sm btn-info" id="getdata">Get Data</button>
                  </div>
                </div>         
            </div>
          </div>
        
        </div>
      </div>
      <div id="data" style="display:none">
      @foreach ($employee as $emp)
      <div class="row" >
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header  text-white" style="background-color: #00AA9E;"> Bhavya </div>
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
                
              </div>
          </div>

        </div>
      </div>
      @endforeach
    </div>
    </section>

  </main>

</body>

</html>
@endsection
