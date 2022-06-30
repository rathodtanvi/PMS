@extends('layouts.index')
@section('content')

<script type="text/javascript">
  
  function itemDataTable(fdate,tdate)
    {
        $('#data').show();
        var dataTable = $('.table').DataTable({
            processing: true,
            serverSide: true,
            "destroy": true,
            "bScrollCollapse": true,
            "bAutoWidth": false,
            responsive: true,
            
            ajax: {
                url: "{{ route('report_attendancelist') }}",
                type: 'get',
                data: {fdate ,tdate},
            },
            
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'Attendance_Date', name: 'Attendance_Date'},
                {data: 'mergeColumn', name: 'mergeColumn'},
                {data: 'attendance_duration', name: 'attendance_duration'}, 
            ]
        });
    }

    function getTotal(fdate,tdate,empnm)
    {
      if(typeof(empnm) === "undefined")
      {
        $.ajax({
            url: "{{ route('report_attendancetotal') }}",
            type: 'GET',
            datatype: 'JSON',
            data: {fdate : fdate ,tdate : tdate},
            success: function(res)
            {
              $responseData = JSON.parse(res);
              //Required Hours & Day
              $(".AHours").html($responseData.countday_h);
              $(".ADays").html($responseData.countday);

              //Actual Hours & Day
              $(".ActualHours").html($responseData.attendance);
              $(".ActualDay").html($responseData.ActualDay);

              //Work Hours & Day
              $(".WorkHour").html($responseData.workduration);
              $(".WorkDay").html($responseData.ActualDay);
            }
        });
      }
      else
      {
        // $.ajax({
        //     url: "{{ route('report_attendancelist') }}",
        //     type: 'GET',
        //     datatype: 'JSON',
        //     data: {empnm : empnm ,fdate : fdate ,tdate : tdate},
        //     success: function(res)
        //     {
            
             // $responseData = JSON.parse(res);
              // //Required Hours & Day
              // $(".AHours").html($responseData.countday_h);
              // $(".ADays").html($responseData.countday);

              // //Actual Hours & Day
              // $(".ActualHours").html($responseData.attendance);
              // $(".ActualDay").html($responseData.ActualDay);

              // //Work Hours & Day
              // $(".WorkHour").html($responseData.workduration);
              // $(".WorkDay").html($responseData.ActualDay);
           // }
       // });
      }
    }

    $(document).ready(function(){
      $('#getdata').click(function()
      {
        var empnm = $('.empnm').val();
        
        var fdate = $('.fromdate').val();
        var tdate = $('.todate').val();
        
        
        if(typeof(empnm) === 'undefined')
        {
           itemDataTable(fdate,tdate)
           getTotal(fdate,tdate)
        }
        else
        {
          $('.new_data').empty();
          getTotal(fdate,tdate,empnm)
          $.ajax
          ({
              url: "{{ route('report_attendancelist') }}",
              type: "GET",
              data: {
                empnm : empnm ,
                fdate : fdate ,
                tdate : tdate,

              },
              success: function(response)
              {
                $('.new_data').append(response); 
              //  $('.info_data').append(respose);
              
              }
          }); 
        }    

        
      });
    });

  </script>

    <main id="main" class="main"> 
    <div class="pagetitle">
      <h1>Attendance Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Attendance</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              <!-- Table with stripped rows -->
            @if (Auth::user()->roles_id == '1')     
              
              <div class="col-4">    
                <label class="col-form-label">Employee</label>
                  <div> 
                    <select name="technology_name" class="form-control empnm">
                      <option>select</option>
                        <option value="all"> All </option>
                        @foreach($employee as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
            @endif
              <div class="col-4">    
                <label class="col-form-label">From Date</label>
                  <div> 
                    <input type="date" class="form-control fromdate" name="date_start" value="{{ date("Y-m-d", strtotime( '-1 days' ) )}}">
                  </div>
              </div>

              <div class="col-4">    
                <label class="col-form-label">To Date</label>
                  <div> 
                    <input type="date" class="form-control todate" name="date_end" value="{{date('Y-m-d', time())}}" >
                  </div>
              </div>
              
              <div class="col-4">    
                <div class="pt-3"> 
                  <button type="submit" class="btn btn-sm btn-info" id="getdata" style="float:left">Get Data</button>
                </div>
              </div>
                        
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
       
      @if(Auth::user()->roles_id == 1)
      <div class="new_data"></div>

      @else
       <div class="card" id="data" style="display:none">
        <div class="card-header text-white usernm" style="background-color: #00AA9E;"> 
          {{Auth::user()->name}}</div>
        <div class="card-body">
      
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Attendance Timing</th>
                    <th>Attendance Duration</th>
                </tr>
                </thead>
                <tbody >
                
                </tbody>
            </table>
    
        </div>
        <div class="card-footer  text-black">
            <div class="row">
            <div class="col-4">
                    <div class="row">
                    <div class="col-10">Required Attendance Hours</div>
                    <div class="col-2 badge bg-warning text-black AHours" style="font-size: 15px;">8</div>
                    </div>
            </div>
            <div class="col-4">
                <div class="row">
                <div class="col-10">Actual Attendance Hours</div>
                <div class="col-2 badge bg-danger ActualHours" style="font-size: 15px;">00:00</div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                <div class="col-10">Work Duration Hours</div>
                <div class="col-2 badge bg-secondary text-white WorkHour" style="font-size: 15px;">00:00</div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-4">
                <div class="row pt-2">
                <div class="col-10">Required Attendance Days</div>
                <div class="col-2 badge bg-warning text-black ADays" style="font-size: 15px;">1</div>
                </div>
            </div>
            <div class="col-4">
                <div class="row pt-2">
                <div class="col-10">Actual Attendance Days</div>
                <div class="col-2 badge bg-danger ActualDay" style="font-size: 15px;">0</div>
                </div>
            </div>
            <div class="col-4">
                <div class="row pt-2">
                <div class="col-10">Work Duration Days</div>
                <div class="col-2 badge bg-secondary text-white WorkDay" style="font-size: 15px;">0</div>
                </div>
            </div>
            </div>
    
        </div>
    </div>
     @endif


  <!-- Card with header and footer -->
 



    </section>

  </main>

@endsection
